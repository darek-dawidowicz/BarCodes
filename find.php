<?php
declare(strict_types=1);

use Noodlehaus\Config;
use App\Entity\Contact;
use App\Services\BarcodeGenerator;

require 'bootstrap.php';

$tmp = filter_input(INPUT_GET, 'ean');
$config = Config::load('config/config.yml');
$ean = substr($tmp, 0, $config->get('length') - 1);

$contact = $entityManager->getRepository(Contact::class)->findOneBy(['ean' => $ean]);
/* @var $contact Contact */

$barcodeGenerator = new BarcodeGenerator($config);
$barcode = $barcodeGenerator->generate($ean);

if ($tmp === $barcode) {
    echo json_encode($contact);
}