<?php 
session_start();
include('function.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnés </title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php 
        include ('header.php');
        ?>
        
        <div id="wrapper">          
            <aside>
                <?php
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                ?>
                <img src = "user.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice 
                        <?php
                        echo $user['alias'];
                        ?>
                    </p>
                </section>
            </aside>
            
            <main class='contacts'>
                <?php
                $userId;
                $mysqli;
                
                $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                
                $lesInformations = $mysqli->query($laQuestionEnSql);
               
                while ($userId = $lesInformations->fetch_assoc()){
                ?>
                    <article>
                        <img src="user.jpg" alt="blason"/>
                        <h3><?php echo $userId['alias']?></h3>
                        <p><?php echo $userId['id']?></p>                    
                    </article>
                <?php
                }
                ?>
            </main>
        </div>
    </body>
</html>
