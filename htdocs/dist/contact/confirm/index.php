<?php
// Start Session.
session_start();

if (empty($_SESSION['contact-form'])) {
  header('Location: ../index.php'); // Redirect back to input page if user directly access confirmation page.
  die();
}

// Generate CSRF token.
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['token'];
$input = $_SESSION['contact-form']['input'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Confirmation Page</title>
    </head>
    <body>
        <div class="container">
            <h1>Confirmation page</h1>

            <form action="../thanks/index.php" method="POST">
                <input type="hidden" name="_token" value="<?= $token ?>" />
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" class="form-control-plaintext" readonly type="text" value="<?= htmlspecialchars($input['email']) ?>">
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input id="fullname" class="form-control-plaintext" readonly type="text" value="<?= htmlspecialchars($input['name']) ?>">
                </div>
                <div class="form-group">
                    <label for="details">Contact Details</label>
                    <div class="card">
                        <div class="card-body"><?= nl2br(htmlspecialchars($input['details'])) ?></div>
                    </div>
                </div>
                <div class="form-check">
                    <label for="radio">Radio Item Select</label>
                    <input id="radio" class="form-control-plaintext" type="text" value="<?= htmlspecialchars($input['item-radio']) ?>">
                </div>
                <!-- Submit button should be always <button type="submit"> or <input type="submit"> for the form to react. -->
                <button class="btn bnt-secondary" type="button" onclick="location.href='../index.php'">Go Back</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>