<?php
$connection = new mysqli('localhost', 'root', '', 'deneme', '3306');
if ($connection) {
    echo 'Connection was established.';
} else {
    echo 'Connection could not.';
}
?>