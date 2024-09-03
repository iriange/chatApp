<?php
    session_start();

    if (isset($_SESSION['unique_id'])) {

        include_once "config.php";
        
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = '';

        $sql ="SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}') 
                OR (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id }') ORDER BY setTime";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query)>0) {

        function formatTime(int $timestamp){
            $jours = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
            $Listmois = ['Jan', 'Fev', 'Mar', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];
            $time = time();
            $currentDate = date('d-m-y');
            $msgDate = date('d-m-y',$timestamp);
            $date = getdate($timestamp);
            $jr = date('j',$timestamp);
            if ($msgDate == $currentDate) {
                $sec = $time - $timestamp;
                $h = (floor($sec/3600))%24;
                $m = (floor($sec/60))%60;
                $s = (floor($sec%60));
                
                $h_m = date('H:i',$timestamp);
                if ($h == 0 && $m <= 0 && $s <= 60) {
                    return' Maintenant';
                }else if($h == 0 && $s > 60){
                    return $m<10 ? '0'.$m.' min':$m.' min';
                }else{
                    return $h_m;
                }
            }else{
                $msgDate = $Listmois[date('n',$timestamp)-1].' '.date('Y',$timestamp);
                return $jours[$date['wday']].' '.$jr.' '.$msgDate;
            }
            

            
        }    
            while ($row = mysqli_fetch_assoc($query) ) {


                if ($row['outgoing_msg_id'] === $outgoing_id) {
                    
                    $a = ($row['msg_img'] != '' ?
                     ' <div class="imgBox">
                            <img src="php/img/'.$row['msg_img'].'" alt="">
                        </div>' : '');

                    $output .= '<div class="chat outgoing">
                                    <div class="modal" id='.$row['setTime'].'>
                                        <p>Vous voulez vraiment supprimer ce message?</p>
                                        <div class="btn-container">
                                            <a href="#" id="del" data-user='.$incoming_id.'>Oui</a>
                                            <a href="#" id="cancel">Non</a>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <div class="msgFormat">
                                            <div class="del-content">
                                                <div class="del-chevron">
                                                    <i class="fas fa-chevron-down" id='.$row['setTime'].'></i>     
                                                </div>
                                            </div>
                                            <div class="msgBox" > <p>'.$row['msg'].'</p>
                                               '.$a.'
                                            </div>
                                        </div>
                                        <span class="last-connection">'.formatTime($row['setTime']).'</</span>
                                     </div>
                                </div>';
                }else{

                    $b = ($row['msg_img'] != '' ?
                     ' <div class="imgBox">
                            <img src="php/img/'.$row['msg_img'].'" alt="">
                        </div>' : '');

                    $output .= '<div class="chat incoming">
                                    <img src="php/img/'.$row['img'].'" alt="">
                                    <div class="details">
                                        <div class="msgFormat">
                                            <div class="msgBox" >
                                                <p>'.$row['msg'].'</p>
                                                '.$b.'
                                            </div>
                                            <div class="del-content">
                                                <div class="del-chevron">
                                                    <i class="fas fa-chevron-down" id='.$row['setTime'].'></i>     
                                                </div>
                                            </div>
                                        </div>
                                        <span class="last-connection">'.formatTime($row['setTime']).'</</span>
                                    </div>
                                    <div class="modal" id='.$row['setTime'].'>
                                        <p>Vous voulez vraiment supprimer ce message?</p>
                                        <div class="btn-container">
                                            <a href="#" id="del" data-user='.$outgoing_id.'>Oui</a>
                                            <a href="#" id="cancel">Non</a>
                                        </div>
                                    </div>
                                </div>';

                }

            }
            echo $output;
        }
    }else{
        header('location: ../login.php');
        exit();

    }

?>