<?php

declare(strict_types=1);

namespace App\Services;

use Fpdf\Fpdf;

/**
 * Extension of Fpdf class
 *
 * @package App\Services
 * @author Dariusz Dawidowicz <d.dawidowicz@rusin.info>
 */
class ExtFpdf extends Fpdf
{
    /**
     * Get scale factor
     *
     * @return int
     */
    public function getK()
    {
        return $this->k;
    }
}