<?php
declare(strict_types=1);

use Noodlehaus\Config;
use App\Entity\Contact;
use App\Services\RandomGenerator;
use App\Services\BarcodeGenerator;

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ('POST' === $method) {
    require_once "bootstrap.php";

    $config = Config::load('config/config.yml');
    $randomGenerator = new RandomGenerator($config);

    $contact = new Contact();
    $contact->setFirstName(filter_input(INPUT_POST, 'first_name'));
    $contact->setLastName(filter_input(INPUT_POST, 'last_name'));
    $contact->setEmail(filter_input(INPUT_POST, 'email'));
    $contact->setPhoneNumber(filter_input(INPUT_POST, 'phone_number'));
    $contact->setEan($randomGenerator->generate());

    $entityManager->persist($contact);
    $entityManager->flush();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Create form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="web/css/main.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 order-md-1">
            <h4>Contact form</h4>
            <form name="create_form" method="post" class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="" value=""
                               required="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="" value=""
                               required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com"
                           required="">
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber">Address</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phone_number"
                           placeholder="+48 000 000 000" required="">
                    <div class="invalid-feedback">
                        Please enter your phone number.
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="continue">Continue</button>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="web/js/validate.js"></script>
</body>
</html>