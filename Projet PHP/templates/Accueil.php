<?php
include("Navbar.php");
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 3vh;
        margin-bottom: 5vh;
        font-size: 4.5vh;
        text-align: center;
    }

    input{
        margin-top: 1vh;
        color: #888888;
    }

    label {
        font-size: 2.5vh;
        color: #ef4527;
        text-align: center;
    }

    .form-group, .launch{
        margin-bottom: 3vh;
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
</style>

<div class="container" style="padding-top: 12vh;">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 log">
        <h1>Lancer un Test</h1>
        <form class="form-horizontal" role="form" method="post" action="controleur.php">

            <div class="form-group">
                <label class="col-sm-12">Nom:</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" placeholder="Nom">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-12">Prénom:</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" placeholder="Prénom">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-12">E-mail:</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" placeholder="Addresse mail">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-12">Quel test ?</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input list="test" type="text" class="form-control" name="test" placeholder="Nom du test - Catégorie">
                    <datalist id="test">
                        <?php
                        $p = Listnomtest();
                        foreach ($p as $dataP){
                            echo '<option value="' . $dataP['Nom'] . ' - ' . $dataP['Categorie'] . '">';
                        }
                        ?>
                    </datalist>
                </div>
            </div>

            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'empty') {
                    ?>

                    <div class="col-sm-10 ERR">Erreur : Veuillez saisir tous les champs</div>

                    <?php
                }
            }
            ?>

            <div class="form-actions">
                <div class="col-sm-12" style="text-align: center;">
                    <button type="submit" class="btn btn-default launch" name="action" value="lancertest">Lancer le test</button>
                </div>
            </div>

        </form>
    </div>
</div>