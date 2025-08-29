<?php

namespace App\Services;

use App\Models\Contract;
use App\Contracts\PdfGeneratorInterface;
use Exception;
use DOMpdf\Canvas;

class ContractPdfService implements PdfGeneratorInterface
{
    protected $contract;
    protected $pdf;
    protected $headerImage;
    protected $footerImage;

    public function __construct()
    {
        $this->headerImage = public_path('assets/img/header-logo.jpeg');
        $this->footerImage = public_path('assets/img/footer-logo.jpeg');
    }

    public function generatePdf($contractId)
    {
        try {
            $this->loadContract($contractId);
            $this->initializePdf();
            return $this->streamPdf();
        } catch (Exception $e) {
            throw new Exception('Failed to generate PDF: ' . $e->getMessage());
        }
    }

    public function downloadPdf($contractId)
    {
        try {
            $this->loadContract($contractId);
            $this->initializePdf();
            return $this->pdf->download('contract-'.$this->contract->id.'.pdf');
        } catch (Exception $e) {
            throw new Exception('Failed to download PDF: ' . $e->getMessage());
        }
    }

    public function savePdf($contractId, $path)
    {
        try {
            $this->loadContract($contractId);
            $this->initializePdf();
            return $this->pdf->save($path);
        } catch (Exception $e) {
            throw new Exception('Failed to save PDF: ' . $e->getMessage());
        }
    }

    protected function loadContract($contractId)
    {
        $this->contract = Contract::with(['tenant', 'propertyUnit'])->findOrFail($contractId);
    }

    protected function initializePdf()
    {
        $html = view('contracts.print_one', ['contract' => $this->contract])->render();
        // $html .= '<div style="page-break-before: always;">';
        // $html .= view('contracts.terms_conditions', ['contract' => $this->contract])->render();
        $html .= '</div>';

        $this->pdf = \PDF::loadHTML($html)->setPaper('A4', 'portrait');
        $this->addHeaderFooter();
    }

    protected function addHeaderFooter()
    {
        $dompdf = $this->pdf->getDomPDF();
        $dompdf->render();
        
        $canvas = $dompdf->getCanvas();
        $fontMetrics = $dompdf->getFontMetrics();

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $this->renderHeader($canvas);
            $this->renderFooter($canvas, $fontMetrics, $pageNumber, $pageCount);
        });
    }

    protected function renderHeader(Canvas $canvas)
    {
        if (file_exists($this->headerImage)) {
            $canvas->image(
                $this->headerImage,
                30,
                0,
                $canvas->get_width() - 32,
                80
            );
        }
    }

    protected function renderFooter(Canvas $canvas, $fontMetrics, $pageNumber, $pageCount)
    {
        if (file_exists($this->footerImage)) {
            $canvas->image(
                $this->footerImage,
                0,
                $canvas->get_height() - 70,
                $canvas->get_width(),
                70
            );
        }

        $this->renderFooterContent($canvas, $fontMetrics, $pageNumber, $pageCount);
    }

    protected function renderFooterContent(Canvas $canvas, $fontMetrics, $pageNumber, $pageCount)
    {
        $font = $fontMetrics->get_font("Helvetica", "normal");
        $fontSize = 8;
        $footerY = $canvas->get_height() - 55;

        $this->drawFooterLine($canvas, $footerY);
        $this->renderDateTime($canvas, $font, $fontSize, $footerY);
        $this->renderPageNumber($canvas, $fontMetrics, $font, $fontSize, $pageNumber, $pageCount, $footerY);
    }

    protected function drawFooterLine(Canvas $canvas, $footerY)
    {
        $lineY = $footerY - 5;
        $canvas->line(
            10, $lineY,
            $canvas->get_width() - 10, $lineY,
            [0, 0, 0], 1
        );
    }

    protected function renderDateTime(Canvas $canvas, $font, $fontSize, $footerY)
    {
        $dateTime = date('H:i:s') . ' | ' . date('l, d F Y');
        $canvas->text(
            10,
            $footerY,
            $dateTime,
            $font,
            $fontSize,
            [0, 0, 0]
        );
    }

    protected function renderPageNumber(Canvas $canvas, $fontMetrics, $font, $fontSize, $pageNumber, $pageCount, $footerY)
    {
        $pageText = "Page $pageNumber of $pageCount";
        $textWidth = $fontMetrics->getTextWidth($pageText, $font, $fontSize);
        $canvas->text(
            $canvas->get_width() - 10 - $textWidth,
            $footerY,
            $pageText,
            $font,
            $fontSize,
            [0.3, 0.3, 0.3]
        );
    }

    protected function streamPdf()
    {
        return $this->pdf->stream('contract-'.$this->contract->id.'.pdf');
    }
}