<?php
declare(strict_types=1);

use App\Entity\Contact;
use App\Services\FpdfContactDecorator;

require 'bootstrap.php';

$id = (int)filter_input(INPUT_GET, 'id');

$contact = $entityManager->getRepository(Contact::class)->findOneBy(['id' => $id]);
/* @var $contact Contact */

$pdf = new FpdfContactDecorator($contact->getEan());

$pdf->draw(true);

unset($pdf);