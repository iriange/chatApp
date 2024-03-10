<?php
    session_start();
    if (isset($_SESSION['unique_id'])) {
        # code...
        header('location: users.php');
    }
?>
<?php
    include_once 'php/head.php'
?>
<body>
    <div class="wrapper">
        <section class="form signUp">
            <header>Chat App <i class="far fa-message"></i></header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label >Nom</label>
                        <input type="text" placeholder="Entrez votre Nom" name="nom" required>
                    </div>
                    <div class="field input">
                        <label >Prénoms</label>
                        <input type="text" placeholder="Entrez vos Prénoms" name="pnom" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" placeholder="Entrez un Email" name="email" required>
                </div>
                <div class="field input">
                    <label >Mot de passe</label>
                    <input type="password" placeholder="Entrez un Mot de passe" name="pwd" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Choisissez une image</label>
                    <input type="file" name="img" required>
                </div>
                <div class="field sub">
                    <input type="submit" class="sub" value="Continuer dans le Chat">
                </div>
            </form>
            <div class="link">Vous avez déjà un compte? <a href="login.php">Connectez-vous</a></div>
        </section>
    </div>
    <script src="javascript/show-pwd.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>