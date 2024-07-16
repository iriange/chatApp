<?php
session_start();

if (isset($_SESSION['unique_id'])) {
        
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users");
    $output = '';
    
    if (mysqli_num_rows($sql) == 1) {
    
        $output .= "Aucun utilisateur disponible";
    
    }elseif(mysqli_num_rows($sql) > 1) {
    
       include "data.php";
    }
    
    echo $output;
}


?>