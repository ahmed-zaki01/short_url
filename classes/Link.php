<?php

class Link
{

    public function addUrl($url, $shortUrl)
    {
        global $conn;

        $sql = "SELECT `url` FROM links WHERE short_url = '$shortUrl' AND `url` = '$url'";
        $result = $conn->query($sql);

        if ($result->num_rows !== 0) {
            return false;
        } else {

            $sql = "INSERT INTO links (`url`, `short_url`) VALUES ('$url', '$shortUrl')";
            if ($conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function getUrl($shortUrl)
    {
        global $conn;
        $sql = "SELECT `url` FROM links WHERE short_url = '$shortUrl'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return $row['url'];
        } else {
            return false;
        }
    }

}
