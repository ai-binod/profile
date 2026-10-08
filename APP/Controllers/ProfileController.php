<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\ContactMailer;
use App\Libraries\ContactMailerInterface;
use System\Config\Controller;

require_once APPPATH . 'Helpers/profile_helper.php';
require_once APPPATH . 'Helpers/csrf_helper.php';

/**
 * Class ProfileController
 *
 * Coordinates request handling for the Binod Sthapit personal profile pages
 * and server-side consultation inquiry validation and delivery.
 */
class ProfileController extends Controller
{
    private ContactMailerInterface $mailer;

    /**
     * Constructor allows injection of the delivery dependency.
     *
     * In ICTM Framework 4.5.1, the framework bootstrap controller factory
     * instantiates controllers without arguments ($controller = new $controllerClassName()).
     * We support constructor injection for testing/DI containers and provide a safe fallback.
     */
    public function __construct(?ContactMailerInterface $mailer = null)
    {
        $this->mailer = $mailer ?? new ContactMailer();
    }

    /**
     * Profile Homepage
     */
    public function index(): void
    {
        $articles = profile_articles();
        echo $this->view('profile/home', [
            'pageTitle' => 'Binod Sthapit | AI Marketing Expert for Small & Medium Businesses',
            'metaDesc'  => 'Scale your business with AI-driven digital marketing solutions. Binod Sthapit helps small and medium business owners attract customers, generate qualified leads, and increase sales.',
            'activeTab' => 'home',
            'articles'  => $articles,
        ]);
    }

    /**
     * About Page
     */
    public function about(): void
    {
        echo $this->view('profile/about', [
            'pageTitle' => 'About Binod Sthapit | AI Marketing Expert & Consultant',
            'metaDesc'  => 'Learn about Binod Sthapit, AI Marketing Expert based in Kathmandu, Nepal. Mission, 4-pillar methodology, core values, and background.',
            'activeTab' => 'about',
        ]);
    }

    /**
     * Services Page
     */
    public function services(): void
    {
        echo $this->view('profile/services', [
            'pageTitle' => 'AI Marketing Services | Strategy, SEO, Automation & Ads | Binod Sthapit',
            'metaDesc'  => 'Explore comprehensive AI marketing services for SMEs: AI strategy, paid ads, SEO & content, marketing automation, AI consulting, and lead conversion funnels.',
            'activeTab' => 'services',
        ]);
    }

    /**
     * Blog Listing Page
     */
    public function blog(): void
    {
        $articles = profile_articles();
        echo $this->view('profile/blog', [
            'pageTitle' => 'AI Marketing Blog & Insights | Practical Guides for Small Business | Binod Sthapit',
            'metaDesc'  => 'Actionable guides on AI marketing, digital strategy, social media automation, and paid advertising for small and medium business owners.',
            'activeTab' => 'blog',
            'articles'  => $articles,
        ]);
    }

    /**
     * Single Article Reader Page
     */
    public function article(string $slug = ''): void
    {
        $article = profile_article_by_slug($slug);
        if ($article === null) {
            header('HTTP/1.1 404 Not Found', true, 404);
            echo $this->view('profile/404', [
                'pageTitle' => 'Article Not Found | Binod Sthapit',
                'activeTab' => 'blog',
            ]);
            return;
        }

        echo $this->view('profile/article', [
            'pageTitle'    => $article['title'] . ' | Binod Sthapit',
            'metaDesc'     => $article['excerpt'],
            'canonicalUrl' => pathto('blog/' . $article['slug']),
            'activeTab'    => 'blog',
            'article'      => $article,
        ]);
    }

    /**
     * Contact Page
     */
    public function contact(): void
    {
        echo $this->view('profile/contact', [
            'pageTitle' => 'Book a Consultation | Contact Binod Sthapit | AI Marketing Expert',
            'metaDesc'  => 'Get in touch with Binod Sthapit. Book a free consultation call to discuss your business\'s digital marketing plan and AI adoption roadmap.',
            'activeTab' => 'contact',
        ]);
    }

    /**
     * Handles consultation inquiry submission with strict server-side validation,
     * CSRF check, anti-abuse controls, and delivery delegation.
     */
    public function submitContact(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($requestMethod !== 'POST') {
            if (!headers_sent()) {
                header('Allow: POST');
            }
            $this->respond([
                'success' => false,
                'status'  => 'failed',
                'message' => 'Method not allowed. Use POST.',
            ], 405);
            return;
        }

        // Support both JSON body and standard form urlencoded
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJsonRequest = str_contains($contentType, 'application/json');

        $input = [];
        if ($isJsonRequest) {
            $rawBody = (string) file_get_contents('php://input');
            $decoded = json_decode($rawBody, true);
            if (is_array($decoded)) {
                $input = $decoded;
            }
        } else {
            $input = $_POST;
        }

        // 1. Anti-abuse Honeypot Check
        $honeypot = trim((string) ($input['_hp_website'] ?? ''));
        if ($honeypot !== '') {
            // Silently discard bot submission
            $this->respond([
                'success' => true,
                'status'  => 'delivered',
                'message' => 'Thank you for your message.',
            ], 200);
            return;
        }

        // 2. Anti-abuse Rate Limiting (Session-based)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $now = time();
        $lastSubmit = (int) ($_SESSION['_contact_last_ts'] ?? 0);
        if ($lastSubmit > 0 && ($now - $lastSubmit) < 5) {
            $this->respond([
                'success' => false,
                'status'  => 'rate_limited',
                'message' => 'Please wait a few seconds before submitting another inquiry.',
            ], 429);
            return;
        }

        // Check rolling hourly limit (max 5 submissions per hour)
        $history = $_SESSION['_contact_submit_history'] ?? [];
        if (is_array($history)) {
            $history = array_filter($history, static function ($ts) use ($now) {
                return is_int($ts) && ($now - $ts) < 3600;
            });
        } else {
            $history = [];
        }

        if (count($history) >= 5) {
            $this->respond([
                'success' => false,
                'status'  => 'rate_limited',
                'message' => 'Submission rate limit reached for this session. Please reach out directly via email or Google Calendar.',
            ], 429);
            return;
        }

        // 3. CSRF Verification
        $csrfToken = (string) ($input['_csrf_token'] ?? $input['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        if (!csrf_validate($csrfToken)) {
            $this->respond([
                'success' => false,
                'status'  => 'forbidden',
                'message' => 'Security token invalid or expired. Please refresh the page and try again.',
            ], 403);
            return;
        }

        // 4. Input Shape & Validation
        $errors = [];

        // Check scalar types
        foreach (['name', 'email', 'businessName', 'websiteUrl', 'service', 'message'] as $field) {
            if (isset($input[$field]) && !is_scalar($input[$field])) {
                $errors[$field] = 'Field must be a valid text string.';
            }
        }

        $name = trim((string) ($input['name'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $businessName = trim((string) ($input['businessName'] ?? ''));
        $websiteUrl = trim((string) ($input['websiteUrl'] ?? ''));
        $service = trim((string) ($input['service'] ?? ''));
        $message = trim((string) ($input['message'] ?? ''));

        // Name
        if ($name === '') {
            $errors['name'] = 'Please provide your full name.';
        } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $errors['name'] = 'Name must be between 2 and 100 characters.';
        } elseif (preg_match('/[\r\n]/', $name)) {
            $errors['name'] = 'Name cannot contain line break characters.';
        }

        // Email
        if ($email === '') {
            $errors['email'] = 'Work email address is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
            $errors['email'] = 'Please enter a valid work email address.';
        } elseif (preg_match('/[\r\n]/', $email)) {
            $errors['email'] = 'Email cannot contain line break characters.';
        }

        // Business Name
        if ($businessName === '') {
            $errors['businessName'] = 'Business or brand name is required.';
        } elseif (mb_strlen($businessName) < 2 || mb_strlen($businessName) > 150) {
            $errors['businessName'] = 'Business name must be between 2 and 150 characters.';
        } elseif (preg_match('/[\r\n]/', $businessName)) {
            $errors['businessName'] = 'Business name cannot contain line break characters.';
        }

        // Website URL (Optional)
        if ($websiteUrl !== '') {
            if (mb_strlen($websiteUrl) > 255) {
                $errors['websiteUrl'] = 'Website URL must be under 255 characters.';
            } elseif (!filter_var($websiteUrl, FILTER_VALIDATE_URL) || !preg_match('#^https?://#i', $websiteUrl)) {
                $errors['websiteUrl'] = 'Please enter a valid website URL starting with http:// or https://';
            } elseif (preg_match('/[\r\n]/', $websiteUrl)) {
                $errors['websiteUrl'] = 'URL cannot contain line break characters.';
            }
        }

        // Service Whitelist
        $allowedServices = [
            'General Discovery & Growth Strategy',
            'AI-Powered Digital Marketing Strategy',
            'Social Media Marketing & Content Creation',
            'Search Engine Optimization & AI Content',
            'Paid Advertising Campaign Management',
            'Email Marketing & Marketing Automation',
            'Lead Generation & Conversion Optimization',
            'AI Tools Consulting & Implementation',
        ];
        if ($service === '' || !in_array($service, $allowedServices, true)) {
            $errors['service'] = 'Please select a valid consultation service of interest.';
        } elseif (preg_match('/[\r\n]/', $service)) {
            $errors['service'] = 'Service cannot contain line break characters.';
        }

        // Message
        if ($message === '') {
            $errors['message'] = 'Please describe your business goal or marketing challenge.';
        } elseif (mb_strlen($message) < 10) {
            $errors['message'] = 'Please provide at least 10 characters to describe your inquiry.';
        } elseif (mb_strlen($message) > 3000) {
            $errors['message'] = 'Message exceeds the maximum limit of 3,000 characters.';
        }

        if (!empty($errors)) {
            $this->respond([
                'success' => false,
                'status'  => 'validation_failed',
                'message' => 'Please correct the highlighted errors and try again.',
                'errors'  => $errors,
            ], 422);
            return;
        }

        // 5. Update Rate Limit History
        $history[] = $now;
        $_SESSION['_contact_submit_history'] = $history;
        $_SESSION['_contact_last_ts'] = $now;

        // 6. Delegate Delivery to Injected Mailer Dependency
        $inquiry = [
            'name'         => $name,
            'email'        => $email,
            'businessName' => $businessName,
            'websiteUrl'   => $websiteUrl,
            'service'      => $service,
            'message'      => $message,
        ];

        $result = $this->mailer->send($inquiry);

        $httpStatus = $result['success'] ? 200 : ($result['status'] === 'unconfigured' ? 200 : 502);

        $this->respond($result, $httpStatus);
    }

    /**
     * Helper to output JSON or HTML response depending on client Accept header.
     *
     * @param array<string, mixed> $payload
     */
    private function respond(array $payload, int $statusCode = 200): void
    {
        if (!headers_sent()) {
            http_response_code($statusCode);
        }
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        $isJsonExpected = str_contains($accept, 'application/json')
            || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

        if ($isJsonExpected) {
            if (!headers_sent()) {
                header('Content-Type: application/json; charset=UTF-8');
            }
            echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        // For traditional non-AJAX POST, render the contact page with status payload
        echo $this->view('profile/contact', [
            'pageTitle'     => 'Book a Consultation | Contact Binod Sthapit | AI Marketing Expert',
            'metaDesc'      => 'Get in touch with Binod Sthapit. Book a free consultation call to discuss your business\'s digital marketing plan and AI adoption roadmap.',
            'activeTab'     => 'contact',
            'contactStatus' => $payload,
        ]);
    }
}
