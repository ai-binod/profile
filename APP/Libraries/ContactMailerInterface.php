<?php declare(strict_types=1);

namespace App\Libraries;

/**
 * Interface ContactMailerInterface
 *
 * Defines the contract for processing and delivering consultation contact inquiries.
 */
interface ContactMailerInterface
{
    /**
     * Attempts to deliver a consultation inquiry.
     *
     * @param array<string, string> $inquiry Sanitized inquiry payload with keys:
     *                                       'name', 'email', 'businessName', 'websiteUrl', 'service', 'message'
     * @return array{success: bool, status: string, message: string}
     *         status can be 'delivered', 'queued', or 'unconfigured'
     */
    public function send(array $inquiry): array;
}
