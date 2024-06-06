<?php 
    include('function.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php 
            include ('header.php');
        ?>

        <?php
        $mysqli;
        
        if ($mysqli->connect_error)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        ?>
        
        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
                $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                while ($tag = $lesInformations->fetch_assoc())
                {
                ?>
                
                <article>
                    <h3>#<?php echo $tag['label'] ?></h3>
                    <nav>
                        <?php 
                        $id_du_tags = $tag['id'];
                        echo'<a href="tags.php?tag_id='.$id_du_tags.'">Messages</a>';
                        ?>
                    </nav>
                </article>
                        <?php 
                        } ?>
            </aside>
            
            <main>
                <h2>Utilisatrices</h2>
                    <?php
                    $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                    $lesInformations = $mysqli->query($laQuestionEnSql);
                
                    if ( ! $lesInformations)
                    {
                        echo("Échec de la requete : " . $mysqli->error);
                        exit();
                    }

                
                    while ($tag = $lesInformations->fetch_assoc())
                    {
                    ?>
                    
                <article>
                    <h3><?php echo $tag['alias']?></h3>
                    <p><?php echo $tag['id']?></p>
                    <nav>
                        <?php
                        $id_du_tags = $tag['id'];
                        echo'<a href="wall.php?user_id='.$id_du_tags.'"> Mur </a>';
                        echo'<a href="feed.php?user_id='.$id_du_tags.'"> Flux </a>';
                        echo'<a href="settings.php?user_id='.$id_du_tags.'"> Paramètres </a>';
                        echo'<a href="followers.php?user_id='.$id_du_tags.'"> Suiveurs </a>';
                        echo'<a href="subscriptions.php?user_id='.$id_du_tags.'"> Abonnements </a>';?>
                    </nav>
                </article>
                        <?php 
                        } ?>
            </main>
        </div>
    </body>
</html>
