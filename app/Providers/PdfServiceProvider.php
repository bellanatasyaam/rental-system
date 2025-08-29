<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PdfGeneratorInterface;
use App\Services\ContractPdfService;

class PdfServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PdfGeneratorInterface::class, function ($app) {
            return new ContractPdfService();
        });
    }

    public function boot()
    {
        //
    }
}