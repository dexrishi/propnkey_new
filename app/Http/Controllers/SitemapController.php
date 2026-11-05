<?php

namespace App\Http\Controllers;

use App\Services\SitemapBuilder;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(SitemapBuilder $builder): Response
    {
        // Prefer freshly generated public file when present; otherwise build live.
        $path = public_path('sitemap.xml');

        if (is_file($path) && filesize($path) > 0) {
            return response(file_get_contents($path), 200, [
                'Content-Type' => 'application/xml; charset=UTF-8',
            ]);
        }

        return response($builder->toXml(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
