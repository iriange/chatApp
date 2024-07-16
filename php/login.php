<?php
    session_start();

    if (!isset($_SESSION['unique_id'])) {
        # code...
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if (!empty($email) && !empty($pwd)) {
        # code...

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            # code...
            $sql = mysqli_query($conn,"SELECT * FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql)>0 ) {
                
                $row = mysqli_fetch_assoc($sql);
                if (password_verify($pwd, $row['pwd'])) {
                    $status = 'En ligne';
                    
                    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                    
                    if ($sql2) {
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo"OK";
                    }
                }
            }else{
                echo"Email ou Mot de passe est incorrect!";
            }
        }else{
            echo "Format d'email invalide, renseignez un autre email." ;
        }

    }else{
        echo"Tous les champs sont obligatoires";
    }
    }else{

            header('location: ../login.php');
    }
    
    ?>