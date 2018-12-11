<ul class="menu">
    <li class="bouton_gauche"><a href="../../index.php" class="a_menu">Accueil</a></li>
    
    <?php 
    if (isset($_SESSION['email']) == false){
        echo '<li class="bouton_droite"><a href="../../Pages/Connection/login.php" class="a_menu">Se connecter</a></li>';
        echo '<li class="bouton_droite"><a href="../../Pages/Connection/registerUtil.php" class="a_menu">S\'enregistrer</a></li>';
    }else{
        if($_SESSION['role'] == "utilisateur"){
            echo '<li class="bouton_gauche"><a href="../../Pages/Bordereau/listeBordereaux.php" class="a_menu">Liste bordereaux</a></li>';
            echo '<li class="bouton_gauche"><a href="../../Pages/Bordereau/bordereau.php" class="a_menu">Bordereau actuel</a></li>';
        }elseif($_SESSION['role'] == "tresorier"){
            echo '<li class="bouton_gauche"><a href="../../Pages/Tresorier/pageTresorier.php" class="a_menu">Trésorier</a></li>';
            echo '<li class="bouton_gauche"><a href="../../Pages/Bordereau/listeBordereaux.php" class="a_menu">Liste bordereaux</a></li>';
            echo '<li class="bouton_gauche"><a href="../../Pages/Bordereau/bordereau.php" class="a_menu">Bordereau actuel</a></li>';
        }elseif($_SESSION['role'] == "resp_crib"){
            echo '<li class="bouton_gauche"><a href="../../Pages/ResponsableCrib/page_resp_crib.php" class="a_menu">ResponsableCRIB</a></li>';
        }
        echo '<li class="bouton_droite"><a href="../../Pages/Connection/disconnect.php" class="a_menu">Se déconnecter</a></li>';    
    }
    ?>
</ul>    