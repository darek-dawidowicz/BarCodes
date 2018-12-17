<?php

declare(strict_types=1);

namespace App\Services;

use Noodlehaus\Config;
use App\Services\ExtFpdf as Fpdf;

/**
 * Decorator of Fpdf class
 *
 * @package App\Services
 * @author Dariusz Dawidowicz <d.dawidowicz@rusin.info>
 */
class FpdfContactDecorator
{

    /**
     *
     */
    private const CODES = [
        'A' => [
            '0' => '0001101', '1' => '0011001', '2' => '0010011', '3' => '0111101', '4' => '0100011',
            '5' => '0110001', '6' => '0101111', '7' => '0111011', '8' => '0110111', '9' => '0001011'
        ],
        'B' => [
            '0' => '0100111', '1' => '0110011', '2' => '0011011', '3' => '0100001', '4' => '0011101',
            '5' => '0111001', '6' => '0000101', '7' => '0010001', '8' => '0001001', '9' => '0010111'
        ],
        'C' => [
            '0' => '1110010', '1' => '1100110', '2' => '1101100', '3' => '1000010', '4' => '1011100',
            '5' => '1001110', '6' => '1010000', '7' => '1000100', '8' => '1001000', '9' => '1110100'
        ]
    ];

    /**
     *
     */
    private const PARITIES = [
        '0' => ['A', 'A', 'A', 'A', 'A', 'A'],
        '1' => ['A', 'A', 'B', 'A', 'B', 'B'],
        '2' => ['A', 'A', 'B', 'B', 'A', 'B'],
        '3' => ['A', 'A', 'B', 'B', 'B', 'A'],
        '4' => ['A', 'B', 'A', 'A', 'B', 'B'],
        '5' => ['A', 'B', 'B', 'A', 'A', 'B'],
        '6' => ['A', 'B', 'B', 'B', 'A', 'A'],
        '7' => ['A', 'B', 'A', 'B', 'A', 'B'],
        '8' => ['A', 'B', 'A', 'B', 'B', 'A'],
        '9' => ['A', 'B', 'B', 'A', 'B', 'A']
    ];

    /**
     * Abscissa of barcode
     *
     * @var integer
     */
    private $x;

    /**
     * Ordinate of barcode
     *
     * @var integer
     */
    private $y;

    /**
     * Number of digits
     *
     * @var integer
     */
    private $length;

    /**
     * Width of a bar
     *
     * @var float
     */
    private $width;

    /**
     * Height of barcode
     *
     * @var integer
     */
    private $height;

    /**
     * ExtFpdf object
     *
     * @var ExtFpdf
     */
    private $pdf;

    /**
     * EAN code
     *
     * @var string
     */
    private $ean;

    /**
     * @var BarcodeGenerator
     */
    private $barcodeGenerator;

    /**
     * Barcode value
     *
     * @var string
     */
    private $barcode;

    /**
     *
     *
     * @var string
     */
    private $code;

    /**
     * FpdfContactDecorator constructor.
     *
     * @param string $ean
     */
    public function __construct(string $ean)
    {
        $this->pdf = new Fpdf();
        $this->ean = $ean;

        $config = Config::load('config/config.yml');
        $this->barcodeGenerator = new BarcodeGenerator($config);

        $this->x = (int)$config->get('barcode.x');
        $this->y = (int)$config->get('barcode.y');
        $this->length = (int)$config->get('barcode.length');
        $this->width = floatval($config->get('barcode.width'));
        $this->height = (int)$config->get('barcode.height');
    }

    /**
     * Draws page
     *
     * @param bool $printText If print text uder barcode
     */
    public function draw($printText = false): void
    {
        try {
            $this->pdf->AddPage();
            $this->drawBarcode($printText);
            $this->pdf->Output();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Draws bars directly in the PDF (no image is generated)
     *
     * @param boolean $printText Decides if print text uder barcode
     * @throws \Exception
     */
    private function drawBarcode(bool $printText): void
    {
        $this->barcode = $this->barcodeGenerator->generate($this->ean);
        $this->getCode();

        //Draw bars
        for ($i = 0; $i < strlen($this->code); $i++) {
            if ($this->code[$i] == '1') {
                $this->pdf->Rect($this->x + $i * $this->width, $this->y, $this->width, $this->height, 'F');
            }
        }

        if ($printText) {
            $this->pdf->SetFont('Arial', '', 12);
            $this->pdf->Text($this->x, $this->y + $this->height + 11 / $this->pdf->getK(), substr($this->barcode, -$this->length));
        }
    }

    /**
     *
     */
    private function getCode(): void
    {
        $this->code = '101';

        $p = self::PARITIES[$this->barcode[0]];

        for ($i = 1; $i <= 6; $i++) {
            $this->code .= self::CODES[$p[$i - 1]][$this->barcode[$i]];
        }

        $this->code .= '01010';

        for ($i = 7; $i <= 12; $i++) {
            $this->code .= self::CODES['C'][$this->barcode[$i]];
        }

        $this->code .= '101';
    }
}