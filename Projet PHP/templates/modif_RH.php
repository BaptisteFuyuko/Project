<?php
    include("Navbar.php");
    //Récupère les information du user sélectionné
    $req = $bdd->prepare('SELECT * FROM user WHERE id= :idRH');
    $req->execute(array('idRH' => $_GET['id']));
    $donnees = $req->fetch();
    $_SESSION['idmodif'] = $_GET['id'];
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 5vh;
        margin-bottom: 10vh;
    }

    input{
        margin-top: 1vh;
        color: #888888;
    }

    label {
        font-size: 2.5vh;
        color: #ef4527;
    }

    h1 {
        font-size: 4.5vh;
    }

    .form-group{
        margin-bottom: 5vh;
    }

    .ERR {
        margin-bottom: 2vh;
        text-align: center;
        color: red;
        font-size: 2vh;
    }

    .HELP {
        margin-bottom: 2vh;
        text-align: center;
    }
</style>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <h1>Modification de <?php echo $donnees['Prenom'];?> <?php echo $donnees['Nom']; ?></h1>
        <form class="form-horizontal" role="form" method="post" action="controleur.php" style="
        max-height: 70vh !important;
        overflow: auto;
        overflow-x: hidden;
        ">


            <div class="form-group 
            <?php
            if (isset($_GET['nom'])) {
                if ($_GET['nom'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="nom">*Nom:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $donnees['Nom'] ?>">
                </div>
            </div>


            <div class="form-group 
            <?php
            if (isset($_GET['prenom'])) {
                if ($_GET['prenom'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="prenom">*Prénom:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $donnees['Prenom'] ?>">
                </div>
            </div>


            <div class="form-group 
            <?php
            if (isset($_GET['BU'])) {
                if ($_GET['BU'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="bu">*BU d'origine:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="BU" id="bu" value="<?php echo $donnees['BU_origine'] ?>">
                </div>
            </div>


            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'double') {
                    ?>

                    <div class="col-sm-10 ERR">Erreur : Login déjà utilisé</div>

                    <?php
                }
            }
            ?>
            <div class="form-group 
            <?php
            if (isset($_GET['login'])) {
                if ($_GET['login'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="email">*Login:</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="login" id="email" value="<?php echo $donnees['Login'] ?>">
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-4" for="pwd">Nouveau Mot de passe:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Entrez le nouveau mot de passe">
                </div>
            </div>

            
            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'empty') {
                    ?>

                    <div class="col-sm-10 ERR">Erreur : Veuillez saisir tous les champs obligatoires</div>

                    <?php
                }
            }
            ?>

            <div class="col-sm-10 HELP">Tous les champs présentant le symbole * sont obligatoires</div>

            <div class="form-actions">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-default" style="color: #ef4527; border: 1px #888888 solid;" name="action" value="modifRH">Valider</button>
                    <a href="index.php?page=LRH"><button type="button" class="btn" style="color: #ef4527; background-color: white; border: 1px #888888 solid;"> Annuler </button></a>
                </div>
            </div>
            
        </form>
    </div>
</div>