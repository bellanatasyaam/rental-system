<?php

namespace App\Contracts;

interface PdfGeneratorInterface
{
    public function generatePdf($contractId);
    public function downloadPdf($contractId);
    public function savePdf($contractId, $path);
}