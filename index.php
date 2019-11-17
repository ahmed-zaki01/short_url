
<?php

include "classes/Db.php";
include "classes/Link.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $link = new Link();
    $url = $link->getUrl($id);
  
    if ($url) {
        header('location:'.$url);
    } else {
        echo "You entered an invalid short link!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shorten App</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body>

    <div class=" container py-5">
        <form action="handle_form.php" method="post" class="w-100 text-center">
            <div class="form-group d-block w-100">
                <label for="url" class="col-md-12 font-weight-bold" style=" padding: 0 !important;font-size: 1.5rem;">Website URL:</label>
                <input type="text" name="url" id="url" class="form-control col-md-8 mx-auto">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Get Shorten One!</button>
        </form>
    </div>


    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
