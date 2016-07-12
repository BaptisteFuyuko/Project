<?php
include("Navbar.php");
$nom = getnomprenom($_GET['id']);
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 40px;
        margin-bottom: 60px;
        font-size: 4.5vh;
    }

    input{
        margin-top: 1vh;
        color: #888888;
    }

    .tabcontent {
        max-height: 70vh !important;
        overflow: auto;
    }

    thead{
        color: #888888;
    }

    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
        padding: 2vh;
    }

    table {
        font-size: 2.5vh;
        color: #ef4527;
        text-align: center;
    }

    .table-striped>tbody>tr:nth-child(even)>td,
    .table-striped>tbody>tr:nth-child(even)>th {
        background-color: #888888;
        color: black;
    }

    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #ef4527;
        color: black;
    }

</style>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <h1>Liste des tests réalisés par <?php echo $nom[0]['Nom'] . ' ' . $nom[0]['Prenom'] ?> </h1>
        <div class="tabcontent">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom du test</th>
                    <th>Date</th>
                    <th>Score</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $p = Listingbycand($_GET['id']);
                //Affiche tous les RH de la base de données
                foreach ($p as $dataP)
                {
                    echo '<tr value="' . $dataP['id'] . '">';
                    echo '<td>' . $dataP['Nom_Test'] . '</td>';
                    echo '<td>' . $dataP['Date_exe'] . '</td>';
                    echo '<td>' . $dataP['Score'] . '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
