# Laravel Email Channel

Laravel 13 patterns for queued mail notifications, Markdown templates, per-message metadata, queue selection, retries, and testing with `Notification::fake()`.

`WelcomeNotification` implements `ShouldQueue`, uses the `emails` queue, and builds a standard `MailMessage` without embedding credentials or transport settings.

```bash
composer install
composer test
```
