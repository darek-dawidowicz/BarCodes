<?php

declare(strict_types=1);

namespace App\Services;

use Noodlehaus\Config;

/**
 * Generator losowego ciągu n-znakowego
 *
 * @package App\Services
 */
class RandomGenerator
{

    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     *
     *
     * @return string
     */
    public function generate(): string
    {
        $result = "";

        $length = (int)$this->config->get('barcode.length') - 1;

        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }
}