<?php
$conn = mysqli_connect('localhost', 'root', '', 'chatapp');

if (!$conn) {
    # code...
    echo "Database not connected" .mysqli_connect_error();
}