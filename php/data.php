<?php
    // if (!isset($_SESSION['unique_id'])) {
    //     # code...
    //     header('location: ../login.php');
    // }
?>
<?php

while ($row = mysqli_fetch_assoc($sql)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
             OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
             OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    
    if (mysqli_num_rows($query2)>0) {
        $result = $row2['msg'];
        ($outgoing_id == $row2['outgoing_msg_id']) ? $vous = 'Vous: ' : $vous = '';
    }else{
        $result = "Aucun message disponible.";
        $vous='';
    }
    
    
    (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
    
    

    ($row["status"] == "Hors ligne") ? $horsligne = 'offline' : $horsligne = '';

    if ($row['unique_id'] != $outgoing_id) {

        $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
            <div class="content">
            <img src="php/img/'. $row['img'] .' "alt="#">
                <div class="details">
                <span class="profilname">'. $row['nom'] ." ". $row['prenoms'] .'</span>
                <p>'. $vous . $msg . '</p>
                </div>
            </div>
            <button class="status-dots '. $horsligne .'"><i class="fas fa-circle"></i></button>
        </a>';
    }
}

?>