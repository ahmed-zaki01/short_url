<?php

class Validator {
    var $error = '';

    public function checkUrl($url) {
        if($url == '') {
            $error = 'url can not be empty';
        } else if (!filter_var($url, FILTER_VALIDATE_URL)){
            $error = 'url is not valid';
        } else {
            return $url;
        }

        $this->error = $error;
        return false;
    }
}