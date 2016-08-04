<?php
/**
 * Created by PhpStorm.
 * User: bduhamel
 * Date: 01/08/2016
 * Time: 08:50
 */
?>

<style type="text/css">
    h1 {
    color: #ef4527;
    margin-top: 40px;
        margin-bottom: 60px;
    }

    input{
    color: #888888;
}

    label {
    font-size: 2.5vh;
        color: #ef4527;
        text-align: center;
    }

    h1 {
    font-size: 4.5vh;
        text-align: center;
    }

    .form-group, .btn{
    margin-bottom: 5vh;
    }

    .ERR {
    margin-bottom: 2vh;
        text-align: center;
        color: red;
        font-size: 2vh;
    }

    .log {
    vertical-align: middle;
        border: 1px black solid;
    }

    .blanc {
    height: 20vh;
    }
</style>

<div class="container">
    <div class="col-sm-12 blanc"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-6 log" style="text-align: center;">
        <h1>Fin du test</h1>
        <span>Félicitation, vous avez terminé le test, veuillez remettre le support utilisé au RH afin qu'il puisse consulter le résultat.</span>
        </br></br>
        <form class="form-horizontal" role="form" method="post" action="controleur.php">

            <div class="form-group">
                <label class="col-sm-12">Code RH:</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="mdp" placeholder="Mot de passe">
                </div>
            </div>

            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'empty') {
                    ?>

                    <div class="col-sm-12 ERR">Erreur : Veuillez saisir tous les champs</div>

                    <?php
                }if ($_GET['ERR'] == 'false') {
                    ?>

                    <div class="col-sm-12 ERR">Erreur : Code incorrect</div>

                    <?php
                }
            }
            ?>

            <div class="form-group" style="display: none;">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="result" value="<?php echo $_GET['id']; ?>">
                </div>
            </div>

<div class="form-actions">
    <div class="col-sm-12" style="text-align: center;">
        <button type="submit" class="btn btn-default" name="action" value="valider_rh">Connexion</button>
    </div>
</div>

</form>
</div>
</div>