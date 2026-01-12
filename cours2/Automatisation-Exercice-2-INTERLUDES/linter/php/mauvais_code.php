<?php



 class MauvaisCode{
public $message;

function __construct($message) {
    if ($message) {
        $this->message = $message;
    } else {
        $this->message = 'Mauvais code';
    }
}

function setMessage($message) {
    $this->message = $message;
}
function mauvaisCode($inUpperCase) {
    if ($inUpperCase) {
        echo ucfirst('mauvais code');
    } else {
        echo 'mauvais code';
    }
}
 }