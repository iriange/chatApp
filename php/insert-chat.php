<?php
    session_start();

    if (isset($_SESSION['unique_id'])) {

        include_once "config.php";
        
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $msg = mysqli_real_escape_string($conn, $_POST['message']);

        $files = $_FILES['p_joint'];


        $img_name = $files['name'];
        $img_type = $files['type'];
        $tmp_name = $files['tmp_name'];
        
        $explode_ext = explode('.', $img_name);

        $img_ext = end($explode_ext);

        $accept_ext = ['png', 'jpeg', 'jpg'];

        $time = time();
        $img_verif = in_array(strtolower($img_ext),$accept_ext);
            $time = time();
                
            $new_img_name = $time.$outgoing_id.'.'.$img_ext;
            if ($img_verif && (!empty($files) && move_uploaded_file($tmp_name, 'img/'.$new_img_name)) ) {
    
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_img, setTime)
                                VALUES({$incoming_id},{$outgoing_id},'{$msg}','{$new_img_name}', '{$time}')") or die();
            }else{
                $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, setTime)
                                VALUES({$incoming_id},{$outgoing_id},'{$msg}', '{$time}')") or die();
            }

    }else{
        header('location: ../login.php');
        exit();

    }

?>