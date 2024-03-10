<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        # code...
        header('location: login.php');
    }
?>
<?php
    include_once 'php/head.php';
?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php
            include_once 'php/config.php';

            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);  
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql)>0) {
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>

            <div class="content">
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/img/<?=$row['img']; ?>" alt="<?=$row['nom']; ?>">
                <div class="details">
                    <span class="profilname"><?=$row['nom']." ".$row['prenoms']; ?></span>
                    <p><?=$row['status']; ?></p>
                </div>
            </div>
            </header>
            <div class="chat-box">
                
                
            </div>
            <form action="#" class="typing-area" autocomplete='off'>
                 <input type="text" name="outgoing_id" value="<?=$_SESSION['unique_id']; ?>" hidden>
                 <input type="text" name="incoming_id" value="<?=$user_id;?>" hidden>
                 <input type="text" name="message" class="input-field" placeholder="Tapez votre message ici...">
                 <button><i class="fab fa-telegram-plane"></i></button>
            </form>

        </section>
    </div>
    <script src="javascript/chat.js"></script>
</body>
</html>