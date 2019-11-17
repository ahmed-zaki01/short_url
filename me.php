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
        <form action="index.php" method="post" class="w-100 text-center">
            <div class="form-group d-block w-100">
                <label for="price" class="col-md-12 font-weight-bold" style=" padding: 0 !important;font-size: 1.5rem;">Website URL:</label>
                <input type="text" name="url" id="price" class="form-control col-md-8 mx-auto">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Get Shorten One!</button>
        </form>
    </div>


    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>


<?php

function checkURLInDB($url, $result)
{

    if ($result->num_rows > 0) {
        $shortUrl = '';
        while ($row = $result->fetch_assoc()) {

            if ($row['url'] == $url) {
        
                $shortUrl = $row['short_url'];
            }
        }
        //var_dump($shortUrl);
        return $shortUrl;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST['url'];
    $prefix = 'shorten/?id=';
    if ($url == '') {
        echo "<div style='text-align: center;'>Please enter valid data</div>";
    } else {

        $servername = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $dbname = "short_url_db";

        $conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $query = "SELECT `short_url` FROM `url` ";
            $result = $conn->query($query);
            var_dump($result);
            echo "<br>";
            if (checkURLInDB($url, $result)) {
                var_dump($result);
                $shortUrl = checkURLInDB($url, $result);
                
                printf("<br>The shorten URL for " . $url . " is ( <a href=" . $url . ">" . $prefix . $shortUrl . "</a> )");
            } else {

                $shortenURL = uniqid();
                $query = "INSERT INTO url (url, short_url) VALUES ('" . $url . "','" . $shortenURL . "')";

                // echo $query . '<br>';
                if ($conn->query($query) === TRUE) {
                    echo "New record created successfully<br>";
                    //echo $shortenURL . "<br>";
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }

            $conn->close();
            //echo "<div style='text-align: center;'>" . $shortenURL . "</div>";
        }
    }
}

// printf("<br>The shorten URL for " . $url . " is ( <a href=" .$url. ">" . $prefix . $shortenURL . "</a> )");



// Class-Based

class URL
{
    var $url = '';
    var $short_url = '';

    function __construct($url)
    {
        $this->url = $url;
    }

    function addUrl()
    {
        $prefix = 'shorten/?id=';
        $servername = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $dbname = "short_url_db";

        $conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $query = "SELECT url, shorten_url FROM url";
            $result = $conn->query($query);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    print_r($row);
                    if ($row['url'] == $this->url) {
                        return $row['short_url'];
                    }
                }
            }

            if (checkURLInDB($this->url, $result)) {
                $shortUrl = checkURLInDB($this->url, $result);
                printf("<br>The shorten URL for " . $this->url . " is ( <a href=" . $this->url . ">" . $prefix . $shortUrl . "</a> )");
            } else {

                $shortenURL = uniqid();
                $query = "INSERT INTO url (url, short_url) VALUES ('" . $this->url . "','" . $shortenURL . "')";

                // echo $query . '<br>';
                if ($conn->query($query) === TRUE) {
                    echo "New record created successfully<br>";
                    //echo $shortenURL . "<br>";
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }

            $conn->close();
        }
    }
}
?>