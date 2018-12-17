<?php
declare(strict_types=1);

use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Entity\Contact;

require 'bootstrap.php';

$id = (int)filter_input(INPUT_GET, 'id');

$contact = $entityManager->getRepository(Contact::class)->findOneBy(['id' => $id]);
/* @var $contact Contact */

$generator = new BarcodeGeneratorPNG();

echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($contact->getEan(), $generator::TYPE_EAN_13)) . '">';