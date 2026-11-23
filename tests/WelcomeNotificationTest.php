<?php

namespace Tests;

use JawadAhmed\EmailChannel\WelcomeNotification;
use Orchestra\Testbench\TestCase;

final class WelcomeNotificationTest extends TestCase
{
    public function test_it_builds_a_queued_mail_message(): void
    {
        $notification = new WelcomeNotification('https://example.test/dashboard');
        $mail = $notification->toMail((object) ['name' => 'Jawad']);
        self::assertSame('Welcome to the application', $mail->subject);
        self::assertSame(['mail'], $notification->via(new \stdClass()));
        self::assertSame(3, $notification->tries);
    }
}
