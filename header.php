<?php 
$iddesession = $_SESSION["connected_id"];
?>

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
            <li><a href="login.php">Connexion</a></li>
        </ul>
    </nav>
</header>