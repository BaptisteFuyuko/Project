<?php
    include("Navbar.php"); 
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 40px;
        margin-bottom: 60px;
    }

    thead{
        color: #888888;
    }

    table {
        font-size: 2.5vh;
        color: #ef4527;
        text-align: center;
    }

    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
        padding: 2vh;
    }

    button {
        color: #ef4527;
        font-size: 1.7vh;
    }

    #button {
        margin-top:1vh;
        text-align: center;
    }

    h1 {
        font-size: 4.5vh;
    }

    .tabcontent {
        max-height: 70vh !important;
        overflow: auto;
    }
</style>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <h1>Gestion des RH</h1>
        <div class="tabcontent">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>BU d'origine</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $p = ListRH();
                    //Affiche tous les RH de la base de données
                    foreach ($p as $dataP)
                    {
                        echo '<tr>';
                        echo '<td><span class="glyphicon glyphicon-user"></span></td>';
                        echo '<td>' . $dataP['Nom'] .'</td>';
                        echo '<td>' . $dataP['Prenom'] .'</td>';
                        echo '<td>' . $dataP['BU_origine'] .'</td>';
                        echo '<td><a href="index.php?page=MRH&id=' . $dataP['id'] .'"><button class="modifier" value="' . $dataP['id'] . '"> Modifier </button> </a></td>';
                        echo '<td><a href="controleur.php?action=deluser&id=' . $dataP['id'] . '"><button class="supprimer" value="' . $dataP['id'] . '"> Supprimer </button></a></td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-10" id="button">
        <a href="index.php?page=ARH"> <button class="ajouter"> Ajouter un RH</button></a>
    </div>
</div>