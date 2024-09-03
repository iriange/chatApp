<?php
    session_start();
    
    include "config.php";

    if (isset($_SESSION['unique_id'])) {

        $msg_id = mysqli_real_escape_string($conn, $_POST['msg_id']);
    
        $output = '';
        if (isset($msg_id) ) {
            $sql2 = mysqli_query($conn, "DELETE FROM messages WHERE setTime = $msg_id"); 
            $output .= 'Messsage supprimé avec succès !';             
        }
    }
    echo $output

?>