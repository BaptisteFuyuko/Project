<script>
    $(document).ready(function(){
        $("#btn_cat1").click(function(){
            $("#cat2").collapse('hide');
            $("#cat3").collapse('hide');
        });

        $("#btn_cat2").click(function(){
            $("#cat1").collapse('hide');
            $("#cat3").collapse('hide');
        });

        $("#btn_cat3").click(function(){
            $("#cat1").collapse('hide');
            $("#cat2").collapse('hide');
        });

        $("#btn_bycat").click(function(){
            $("#bytest").collapse('hide');
            $("#bycand").collapse('hide');
        });

        $("#btn_bytest").click(function(){
            $("#bycat").collapse('hide');
            $("#bycand").collapse('hide');
        });

        $("#btn_bycand").click(function(){
            $("#bycat").collapse('hide');
            $("#bytest").collapse('hide');
        });

        $("#input_bycat").on("input",function(){
            var $input = $(this),
                val = $input.val();
            var list = $input.attr('list'),
            match = $('#'+list+' option').filter(function() {
                    return ($(this).val() === val);
                });
            if(match.length > 0)
            document.location = "controleur.php?action=listbycat&value=" + this.value;
        });

        $("#input_bytest").on("input",function(){
            var $input = $(this),
                val = $input.val();
            var list = $input.attr('list'),
                match = $('#'+list+' option').filter(function() {
                    return ($(this).val() === val);
                });
            if(match.length > 0) {
                var id = this.value.split(" - ")[2];
                document.location = "controleur.php?action=listbytest&id=" + id;
            }
        });

        $("#input_bycand").on("input",function(){
            var $input = $(this),
                val = $input.val();
            var list = $input.attr('list'),
                match = $('#'+list+' option').filter(function() {
                    return ($(this).val() === val);
                });
            if(match.length > 0) {
                var id = this.value.split(" - ")[2];
                document.location = "controleur.php?action=listbycand&id=" + id;
            }
        });
        
        /*$("#input_bycat").on("input",function(){
            var valeur = $(this).val();
            alert(valeur);
            $.getJSON( "controleur.php",
                {
                    "action" : "listbycat",
                    "value" : valeur
                },
                function(obPars){
                    alert(obPars.feedback);
                    alert(valeur);
                }
            );
        });*/
    });
</script>

<style type="text/css">
    .sidenav {
        padding-top: 20px;
        background-color: #888888;
        height: 95%;
        color: white;
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        overflow: auto;
    }

    .nav > li > a:hover{
        background-color: #ef4527;
        color: white;
    }

    .nav-pills .open > a, .nav-pills .open > a:active, .nav-pills .open > a:focus{
        background-color: #ef4527;
        color: white;
    }

    .nav > li > a {
        color: white;
        font-size: 2vh;
    }

    .nav > li > .GestRH:hover{
        background-color: #ef4527;
        color: white;
    }

    .nav-pills .open > .GestRH, .nav-pills .open > .GestRH:active, .nav-pills .open > .GestRH:focus{
        background-color: #ef4527;
        color: white;
    }

    .nav > li > .GestRH, h3 {
        color: white;
        font-size: 3vh;
    }
</style>

<div class="col-sm-2 sidenav">
    <ul class="nav nav-pills nav-stacked">
        <li><a href="controleur.php?action=logout" class="GestRH">Déconnexion</a></li>
        <li><a href="index.php?page=LT" class="GestRH">Accueil</a></li>
    </ul><br>
    <h3> Rechercher un test : </h3>
    <ul class="nav nav-pills nav-stacked">
        <li>
            <a data-toggle="collapse" href="#bycat" id="btn_bycat"> Par Catégorie </a>
            <ul class="nav nav-pills nav-stacked collapse" id="bycat">
                <li>
                        <input list="cat" type="text" id="input_bycat" class="form-control" name="cat" placeholder="Catégorie" autocomplete="off">
                        <datalist id="cat">
                            <?php
                            $p = Listcat();
                            foreach ($p as $dataP){
                                echo '<option class="listcat" value="' . $dataP['Categorie'] . '">';
                            }
                            ?>
                        </datalist>
                </li>
             </ul>
        </li>

        <li>
            <a data-toggle="collapse" href="#bytest" id="btn_bytest"> Par Test </a>
            <ul class="nav nav-pills nav-stacked collapse" id="bytest">
                <li>
                        <input list="nomtest" type="text" id="input_bytest" class="form-control" name="nomtest" placeholder="Nom du test - Catégorie" autocomplete="off">
                        <datalist id="nomtest">
                            <?php
                            $p = Listnomtest();
                            foreach ($p as $dataP){
                                echo '<option class="list" value="' . $dataP['Nom'] . ' - ' . $dataP['Categorie'] . ' - ' . $dataP['id_test'] . '">';
                            }
                            ?>
                        </datalist>
                </li>
            </ul>
        </li>

        <li>
            <a data-toggle="collapse" href="#bycand" id="btn_bycand"> Par Candidat </a>
            <ul class="nav nav-pills nav-stacked collapse" id="bycand">
                <li>
                        <input list="nomcand" type="text" id="input_bycand" class="form-control" name="nomcand" placeholder="Nom - Prénom" autocomplete="off">
                        <datalist id="nomcand">
                            <?php
                            $p = Listcand();
                            foreach ($p as $dataP){
                                 echo '<option class="list" value="' . $dataP['Nom'] . ' - ' . $dataP['Prenom'] . ' - ' . $dataP['id_candidat'] . '">';
                            }
                            ?>
                        </datalist>
                </li>
            </ul>
        </li>
    </ul><br>
    <h3> Gestion des tests : </h3>
    <ul class="nav nav-pills nav-stacked">
        <li>
            <a data-toggle="collapse" href="#cat1" id="btn_cat1"> Catégorie 1 <span class="caret"> </span></a>
            <ul class="nav nav-pills nav-stacked collapse" id="cat1">
                <li><a href="#">Test 1</a></li>
                <li><a href="#">Test 2</a></li>
                <li><a href="#">Test 3</a></li>
            </ul>
        </li>
        <li>
            <a data-toggle="collapse" href="#cat2" id="btn_cat2"> Catégorie 2 <span class="caret"> </span></a>
            <ul class="nav nav-pills nav-stacked collapse" id="cat2">
                <li><a href="#">Test 1</a></li>
                <li><a href="#">Test 2</a></li>
                <li><a href="#">Test 3</a></li>
            </ul>
        </li>
        <li>
            <a data-toggle="collapse" href="#cat3" id="btn_cat3"> Catégorie 3 <span class="caret"> </span></a>
            <ul class="nav nav-pills nav-stacked collapse" id="cat3">
                <li><a href="#">Test 1</a></li>
                <li><a href="#">Test 2</a></li>
                <li><a href="#">Test 3</a></li>
            </ul>
        </li>
    </ul><br>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php?page=LRH" class="GestRH">Gestion des RH</a></li>
    </ul><br>
</div>