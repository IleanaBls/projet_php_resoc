<?php
session_start();
include('function.php');

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Connexion</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <img src="resoc.jpg" alt="Logo de notre réseau social"/>
        <nav id="menu">  
            <a href="news.php?user_id=<?php echo $iddesession?>">Actualités</a>
            <a href="wall.php?user_id=<?php echo $iddesession?>">Mur</a>
            <a href="feed.php?user_id=<?php echo $iddesession?>">Flux</a>
         </nav>
        <nav id="user">
                <a href="#">Profil</a>
            <ul>
                <li><a href="settings.php?user_id=<?php echo $iddesession?>">Paramètres</a></li>
                <li><a href="followers.php?user_id=<?php echo $iddesession?>">Mes suiveurs</a></li>
                <li><a href="subscriptions.php?user_id=<?php echo $iddesession?>">Mes abonnements</a></li>
                </ul>
            </nav>
        </header>

        <div id="wrapper" >
            <aside>
                <h2>Présentation</h2>
                <p>Bienvenu sur notre réseau social.</p>
            </aside>
            <main>
                <article>
                    <h2>Connexion</h2>
                    <?php
                    $enCoursDeTraitement = isset($_POST['email']);
                    if ($enCoursDeTraitement)
                    {
                        $emailAVerifier = $_POST['email'];
                        $passwdAVerifier = $_POST['motpasse'];
                        $mysqli;
                        
                        $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                        $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                        //cryptage du mdp
                        $passwdAVerifier = md5($passwdAVerifier);
                        
                        $lInstructionSql = "SELECT * "
                                . "FROM users "
                                . "WHERE "
                                . "email LIKE '" . $emailAVerifier . "'"
                                ;
                       
                        $res = $mysqli->query($lInstructionSql);
                        $user = $res->fetch_assoc();
                        if (!$user OR $user["password"] != $passwdAVerifier)
                        {
                            echo "La connexion a échouée. ";
                            
                        } else
                        {
                            echo "Votre connexion est un succès : " . $user['alias'] . ".";
                            $_SESSION['connected_id']=$user['id'];
                            // var_dump($_SESSION);
                        }
                    }
                    ?>                     
                    <form action="news.php" method="post">
                        <input type='hidden'name='alias' value='user'>
                        <dl>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input type='email'name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password'name='motpasse'></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                    <p>
                        Pas de compte?
                        <a href='registration.php'>Inscrivez-vous.</a>
                    </p>
                </article>
            </main>
        </div>
    </body>
</html>
