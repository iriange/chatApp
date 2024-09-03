<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {

        header('location: login.php');
        exit();
    }
?>
<?php
    include_once 'php/head.php';
?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
            <?php
            
            include_once 'php/config.php';

                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if (mysqli_num_rows($sql)>0) {

                    $row = mysqli_fetch_assoc($sql);
                }else{
                    header('location: login.php');
                    exit();
                }
            ?>

                <div class="content">
                    <img src="php/img/<?=$row['img']; ?>" alt="<?=$row['nom']; ?>">
                    <div class="details">
                        <span class="profilname"><?=$row['nom']." ".$row['prenoms']; ?></span>
                        <p><?=$row['status']; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?=$_SESSION['unique_id'];?>" class="logout">Déconnexion</a>
            </header>
            <div class="search">
                <input type="text" placeholder="Recherchez un ami(e) pour Chattez...">
            </div>
            <div class="users-list">
                
            </div>   
        </section>
    </div>
    <script src="javascript/users.js"></script>
</body>
</html>