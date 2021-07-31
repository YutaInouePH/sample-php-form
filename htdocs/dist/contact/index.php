<?php
// Start Session.
session_start();

$input = [];
$errors = [];
if (!empty($_SESSION['contact-form'])) {
    $input = $_SESSION['contact-form']['input'];
    unset($_SESSION['contact-form']);
}

// Generate CSRF token.
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['token'];

if (isset($_SESSION['flash'])) {
    $input = $_SESSION['flash']['input'];
    $errors = $_SESSION['flash']['errors'];
    unset($_SESSION['flash']);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Contact Input Page</title>
    </head>
    <body>
        <div class="container">
            <h1>Input page</h1>

            <form action="./confirm/index.php" method="POST">
                <input type="hidden" name="_token" value="<?= $token ?>" />
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input name="name" type="text" class="form-control" id="fullname" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="details">Contact Details</label>
                    <textarea name="details" class="form-control" id="details" rows="3"></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="item-radio" id="radio1" value="Item 1">
                    <label class="form-check-label" for="radio1">Item 1</label>
                </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="item-radio" id="radio2" value="Item 2">
                    <label class="form-check-label" for="radio2">Item 2</label>
                </div>
                    <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="item-radio" id="radio3" value="Item 3">
                    <label class="form-check-label" for="radio3">Item 3</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>