<?php

namespace App\Console\Commands;

use App\Services\SitemapBuilder;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate public/sitemap.xml from current properties, blogs, and listing pages';

    public function handle(SitemapBuilder $builder): int
    {
        $urls = $builder->buildUrls();
        $path = public_path('sitemap.xml');
        file_put_contents($path, view('sitemap.xml', ['urls' => $urls])->render());

        $this->info('Sitemap written to '.$path.' ('.count($urls).' URLs).');

        return self::SUCCESS;
    }
}
