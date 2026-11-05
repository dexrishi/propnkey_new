<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Rebuild sitemap every 12 hours so new properties/blogs appear in sitemap.xml
Schedule::command('sitemap:generate')->cron('0 */12 * * *');
