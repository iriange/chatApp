<?php
    session_start();
    
    include "config.php";

    if (isset($_SESSION['unique_id'])) {

        $outgoing_id = $_SESSION['unique_id'];
        $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    
        $output = "";
        
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id <> $outgoing_id AND (nom LIKE '%{$searchTerm}%' OR prenoms LIKE  '%{$searchTerm}%')");
    
        if (mysqli_num_rows($sql)>0) {

            include "data.php";
        }else{
            $output .= "Aucun utilisateur trouvé avec - ". $searchTerm;
        }
        echo $output;
    }else{
        header('location: ../login.php');
    }

?>