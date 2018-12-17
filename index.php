<?php
declare(strict_types=1);

use App\Entity\Contact;

require 'bootstrap.php';

$contacts = $entityManager->getRepository(Contact::class)->findAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Bar Codes POC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <a href="/create" role="button" class="btn btn-primary btn-lg btn-block">Create</a>
        </div>
        <div class="col-lg-4">
            <a href="/search" role="button" class="btn btn-secondary btn-lg btn-block">Search</a>
        </div>
    </div>
    <hr class="my-4">
    <?php if (is_array($contacts) && !empty($contacts)): ?>
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td scope="row"><?php echo $contact->getId() ?></td>
                    <td><?php echo $contact->getFirstName() ?></td>
                    <td><?php echo $contact->getLastName() ?></td>
                    <td><?php echo $contact->getEmail() ?></td>
                    <td><?php echo $contact->getPhoneNumber() ?></td>
                    <td>
                        <button type="button" class="btn btn-secondary printPDF"
                                data-cid="<?php echo $contact->getId() ?>">Print PDF
                        </button>
                        <button type="button" class="btn btn-secondary printImage"
                                data-cid="<?php echo $contact->getId() ?>">Print Image
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="web/js/print.js"></script>
</body>
</html>
