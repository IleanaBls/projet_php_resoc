<?php
include('function.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Inscription</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
        include('header.php');
        ?>

        <div id="wrapper" >
            <aside>
                <h2>Présentation</h2>
                <p>Bienvenu sur notre réseau social.</p>
            </aside>
                
            <main>
                <article>
                    <h2>Inscription</h2>
                        <?php
                        $enCoursDeTraitement = isset($_POST['email']);
                        if ($enCoursDeTraitement)
                        {
                            $new_email = $_POST['email'];
                            $new_alias = $_POST['pseudo'];
                            $new_passwd = $_POST['motpasse'];

                            $mysqli;
                            // pour éviter les injection sql 
                            $new_email = $mysqli->real_escape_string($new_email);
                            $new_alias = $mysqli->real_escape_string($new_alias);
                            $new_passwd = $mysqli->real_escape_string($new_passwd);
                            //cryptage mdp
                            $new_passwd = md5($new_passwd);
                        
                            $lInstructionSql = "INSERT INTO users (id, email, password, alias) "
                                    . "VALUES (NULL, "
                                    . "'" . $new_email . "', "
                                    . "'" . $new_passwd . "', "
                                    . "'" . $new_alias . "'"
                                    . ");";
                        
                            $ok = $mysqli->query($lInstructionSql);
                            if ( ! $ok)
                            {
                                echo "L'inscription a échouée : " . $mysqli->error;
                            } else
                            {
                                echo "Votre inscription est un succès : " . $new_alias;
                                echo " <a href='login.php'>Connectez-vous.</a>";
                            }
                        }
                        ?>                     
                    <form action="registration.php" method="post">
                        <input type='hidden'name='???' value='achanger'>
                        <dl>
                            <dt><label for='pseudo'>Pseudo</label></dt>
                            <dd><input type='text'name='pseudo'></dd>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input type='email'name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password'name='motpasse'></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                </article>
            </main>
        </div>
    </body>
</html>
