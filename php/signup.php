<?php
    session_start();
    
    include_once "config.php";
    

    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $pnom = mysqli_real_escape_string($conn, $_POST['pnom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwd = password_hash(mysqli_real_escape_string($conn, $_POST['pwd']), PASSWORD_DEFAULT);

    if (!empty($nom) && !empty($pnom) && !empty($email) && !empty($pwd)) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $sql = mysqli_query($conn,"SELECT email FROM users WHERE email = '{$email}'");

            if (mysqli_num_rows($sql)>0) {
    
                echo "$email - Cet email existe déjà, veuillez le modifier svp";
            }else{
                $files = $_FILES['img'];

                if (isset($files)) {
        
                    $img_name = $files['name'];
                    $img_type = $files['type'];
                    $tmp_name = $files['tmp_name'];
                    
                    $explode_ext = explode('.', $img_name);
            
                    $img_ext = end($explode_ext);
            
                    $accept_ext = ['png', 'jpeg', 'jpg'];
            
                    if (in_array(strtolower($img_ext),$accept_ext)) {
                        # code...
                        $time = time();
                
                        $new_img_name = $time.$img_name;
                        if (move_uploaded_file($tmp_name, 'img/'.$new_img_name)) {
                
                            $status = 'En ligne';
                            $random_id = rand(time(), 10000000);
                
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, nom, prenoms, email, pwd, img, status)
                            VALUES('{$random_id}','{$nom}','{$pnom}','{$email}','{$pwd}','{$new_img_name}','{$status}')");
                            if ($sql2) {
                                $sql3 = mysqli_query($conn,"SELECT * FROM users WHERE email = '{$email}'");
                                if (mysqli_num_rows($sql3)){
                
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo"OK";
                                }else{
                                    echo"Quelque chose s'est mal passé";
                                }
                            }
                        }
                    }else{
                        echo "S'il vous plaît, veuillez ajouter une image au format PNG, JPEG ou JPG.";
                    }
                }else{
                    echo "S'il vous plaît, veuillez ajouter une image.";
                }
            }
        }else{   
            echo "Format d'email invalide, renseignez un autre email." ;
        }
    }else{
        echo"Tous les champs sont obligatoires";
    }
