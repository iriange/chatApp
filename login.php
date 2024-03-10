<?php
    session_start();
    if (isset($_SESSION['unique_id'])) {
        
        header('location: users.php');
    }
?>
<?php
    include_once 'php/head.php'
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat App <i class="far fa-message"></i> </header>
            <form action="#" >
                <div class="error-txt"></div>
               
                <div class="field input">
                    <label>Email</label>
                    <input type="text" placeholder="Entrez votre Email" name="email">
                </div>
                <div class="field input">
                    <label >Mot de passe</label>
                    <input type="password" placeholder="Entrez votre Mot de passe" name="pwd">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field sub">
                    <input type="submit" class="sub" value="Continuer dans le Chat">
                </div>
            </form>
            <div class="link">Vous n'avez pas de compte? <a href="index.php">Inscrivez-vous</a></div>
        </section>
    </div>

    <script src="javascript/show-pwd.js"></script>
    <script src="javascript/login.js"></script>
</body>
</html>