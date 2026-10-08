<?php declare(strict_types=1);

namespace App\Libraries;

/**
 * Class ContactMailer
 *
 * Implements ContactMailerInterface with support for configuration inspection,
 * email header injection defense, and clear delivery state reporting.
 */
class ContactMailer implements ContactMailerInterface
{
    private string $host;
    private string $fromEmail;
    private string $fromName;
    private int $port;
    private string $password;
    private string $recipientEmail;

    /**
     * @param array<string, mixed> $config Optional custom configuration array.
     */
    public function __construct(array $config = [])
    {
        $this->host = (string) ($config['host'] ?? (defined('E_HOST') ? E_HOST : ''));
        $this->fromEmail = (string) ($config['from_email'] ?? (defined('E_MAIL') ? E_MAIL : ''));
        $this->fromName = (string) ($config['from_name'] ?? (defined('E_NAME') ? E_NAME : 'Binod Sthapit Portfolio'));
        $this->port = (int) ($config['port'] ?? (defined('E_PORT') ? (int) E_PORT : 465));
        $this->password = (string) ($config['password'] ?? (defined('E_PASS') ? E_PASS : ''));
        $this->recipientEmail = (string) ($config['recipient_email'] ?? 'connect@binodsthapit.com');
    }

    /**
     * Inspects whether a valid, non-placeholder mail transport is available.
     */
    public function isConfigured(): bool
    {
        $placeholderHosts = ['mail.domain.com', 'localhost', '127.0.0.1', ''];
        $placeholderEmails = ['user@domain.com', 'youremail@example.com', ''];

        if (in_array(strtolower(trim($this->host)), $placeholderHosts, true)) {
            return false;
        }

        if (in_array(strtolower(trim($this->fromEmail)), $placeholderEmails, true)) {
            return false;
        }

        if ($this->password === '' || $this->password === 'password') {
            return false;
        }

        return true;
    }

    /**
     * Attempts delivery of consultation inquiry.
     *
     * @param array<string, string> $inquiry
     * @return array{success: bool, status: string, message: string}
     */
    public function send(array $inquiry): array
    {
        if (!$this->isConfigured()) {
            // Transport is unconfigured; return honest unconfigured state without pretending success
            return [
                'success' => false,
                'status'  => 'unconfigured',
                'message' => 'Direct email transport is not configured on this server environment.',
            ];
        }

        // Header injection protection: verify no newline characters in header components
        $cleanName = preg_replace('/[\r\n]+/', ' ', (string) ($inquiry['name'] ?? ''));
        $cleanEmail = preg_replace('/[\r\n]+/', '', (string) ($inquiry['email'] ?? ''));
        $cleanService = preg_replace('/[\r\n]+/', ' ', (string) ($inquiry['service'] ?? ''));
        $cleanBusiness = preg_replace('/[\r\n]+/', ' ', (string) ($inquiry['businessName'] ?? ''));

        if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'status'  => 'failed',
                'message' => 'Sender email format is invalid.',
            ];
        }

        $subject = "Consultation Inquiry: {$cleanService} - {$cleanBusiness} ({$cleanName})";
        $subject = preg_replace('/[\r\n]+/', ' ', $subject);

        // Build email body, preserving legitimate message content safely
        $rawMessage = (string) ($inquiry['message'] ?? '');
        $websiteUrl = (string) ($inquiry['websiteUrl'] ?? 'Not provided');

        $body = "New consultation inquiry submitted via binodsthapit.com.np\n\n";
        $body .= "Name: {$cleanName}\n";
        $body .= "Email: {$cleanEmail}\n";
        $body .= "Business: {$cleanBusiness}\n";
        $body .= "Website: {$websiteUrl}\n";
        $body .= "Service: {$cleanService}\n\n";
        $body .= "Inquiry Details:\n{$rawMessage}\n\n";
        $body .= "---\nSubmitted at: " . gmdate('Y-m-d H:i:s') . " UTC\n";

        $headers = [];
        $headers[] = 'From: ' . $this->fromName . ' <' . $this->fromEmail . '>';
        $headers[] = 'Reply-To: ' . $cleanName . ' <' . $cleanEmail . '>';
        $headers[] = 'X-Mailer: ICTM-Mailer/1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';

        $headerString = implode("\r\n", $headers);

        $sent = @mail($this->recipientEmail, $subject, $body, $headerString);

        if ($sent) {
            return [
                'success' => true,
                'status'  => 'delivered',
                'message' => 'Your consultation inquiry has been successfully sent. Binod will review and reply within 24–48 hours.',
            ];
        }

        return [
            'success' => false,
            'status'  => 'failed',
            'message' => 'Delivery failed due to a mail server connection error. Please try direct email or Google Calendar.',
        ];
    }
}
