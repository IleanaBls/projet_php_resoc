<?php 
session_start();

include('function.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mur</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php 
        include ('header.php');
        ?>
        <div id="wrapper">
            <?php
            $userId;
            $mysqli;
            ?>
            <aside>
                <?php
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                ?>

                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les messages de l'utilisatrice : 
                        <?php echo $user['alias'];?>
                    </p>

                    <?php 
                    
                    $requete = "SELECT * FROM followers WHERE followed_user_id = '$userId' AND following_user_id = '$iddesession'";
                    
                    $lesInformations = $mysqli->query($requete);
                    
                    if($lesInformations->num_rows==0){
                        if ($user['id'] != $iddesession ){ 
                            ?>
                            <form action="wall.php?user_id=<?php echo $user['id']?>" method="post">
                                <input type='submit' name='abonnement' value="s'abonner">
                            </form>
                            
                            <?php
                            $id_followed = $user['id'];
                            if(isset($_POST['abonnement'])){
                                
                                $larequeteSql ="INSERT INTO followers "
                                . "(id, followed_user_id, following_user_id) "
                                    . "VALUES (NULL, "
                                    . $id_followed . ", "
                                    . "'" . $iddesession . "') "
                                    ;

                                $ok = $mysqli->query($larequeteSql);
                                
                                
                                if(! $ok){
                                    echo "echec de l'abonnement";
                                }else{
                                    echo "tu es abonné à ". $user['alias'];
                                }
                            }
                        }
                    } else
                    {
                ?>  
                        <form action="wall.php?user_id=<?php echo $user['id']?>" method="post">
                            <input type='submit' name='desabonnement' value="se désabonner">
                        </form>
                        <?php
                        if(isset($_POST['desabonnement'])){
                            $larequeteSql="DELETE FROM followers WHERE followed_user_id = '$userId' AND following_user_id = '$iddesession' ";
                            $ok = $mysqli->query($larequeteSql);
                                if(!$ok){
                                    echo "echec du désabonnement";
                                }else{
                                    echo "tu es désabonné de ". $user['alias'];
                                    
                                }
                        }
                    }
                    ?>
                </section>
            </aside>
            
            <main>
                <?php
                if ($user['id'] == $iddesession){
                ?>
                    <article>
                    <h2>Poster un message</h2>
                    <?php 
                    $enCoursDeTraitement = isset($_POST['auteur']);
                    if ($enCoursDeTraitement)
                    {
                        $authorId = $user['id'];
                        $postContent = $_POST['message'];
                        $authorId = intval($mysqli->real_escape_string($authorId));
                        $postContent = $mysqli->real_escape_string($postContent);
                        
                        $lInstructionSql = "INSERT INTO posts "
                                . "(id, user_id, content, created) "
                                . "VALUES (NULL, "
                                . $authorId . ", "
                                . "'" . $postContent . "', "
                                . "NOW());"
                                ;

                        $ok = $mysqli->query($lInstructionSql);
                        
                        if ( ! $ok)
                        {
                            echo "Impossible d'ajouter le message: " . $mysqli->error;
                        } else
                        {
                            echo "Message posté en tant que :" . $user['alias'];
                        }
                    } ?>                     
                    
                    <form action="wall.php?user_id=<?php echo $user['id']?>" method="post">
                        <input type='hidden' name='auteur' value='message'>
                        <dl>
                            <dt><label for='auteur'><?php $authorId ?></label></dt>
                            <dd>
                                <select name='auteur'></select>
                            </dd>
                            <dt>
                                <label for='message'>Message</label>
                            </dt>
                            <dd>
                                <textarea name='message'></textarea>
                            </dd>
                        </dl>
                        <input type='submit'>
                    </form>    
                <?php
                } ?>   
                    
                </article>
                <?php
                
                $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, 
                    posts.user_id, posts.id,
                    posts_tags.tag_id as tag_id,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                
                $lesInformations = $mysqli->query($laQuestionEnSql);
                
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }

                while ($post = $lesInformations->fetch_assoc())
                {
                   include('message.php');
                } ?>
            </main>
        </div>
    </body>
</html>
