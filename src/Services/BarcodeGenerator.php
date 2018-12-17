<?php

declare(strict_types=1);

namespace App\Services;

use Noodlehaus\Config;

/**
 * Genrator kodów kreskowych
 *
 * @package App\Services
 * @author Dariusz Dawidowicz <d.dawidowicz@rusin.info>
 */
class BarcodeGenerator
{

    /**
     * Value of barcode
     *
     * @var string
     */
    private $barcode;

    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Genearte barcode
     *
     * @param string $text
     * @return string
     * @throws \Exception
     */
    public function generate(string $text): string
    {
        $length = (int)$this->config->get('barcode.length');

        //Padding
        $this->barcode = str_pad($text, $length - 1, '0', STR_PAD_LEFT);

        if ($length == 12) {
            $this->barcode = '0' . $this->barcode;
        }

        //Add or control the check digit
        if (strlen($this->barcode) == 12) {
            $this->barcode .= self::getCheckDigit();
        } elseif (!self::testCheckDigit()) {
            throw new \Exception('Incorrect check digit');
        }

        return $this->barcode;
    }

    /**
     * Compute the check digit
     *
     * @return int
     */
    private function getCheckDigit(): int
    {
        $sum = 0;

        for ($i = 1; $i <= 11; $i += 2) {
            $sum += 3 * $this->barcode[$i];
        }

        for ($i = 0; $i <= 10; $i += 2) {
            $sum += $this->barcode[$i];
        }

        $r = $sum % 10;

        if ($r > 0) {
            $r = 10 - $r;
        }

        return $r;
    }

    /**
     * Test validity of check digit
     *
     * @return bool
     */
    private function testCheckDigit(): bool
    {
        $sum = 0;

        for ($i = 1; $i <= 11; $i += 2) {
            $sum += 3 * $this->barcode[$i];
        }

        for ($i = 0; $i <= 10; $i += 2) {
            $sum += $this->barcode[$i];
        }

        return ($sum + $this->barcode[12]) % 10 == 0;
    }
}