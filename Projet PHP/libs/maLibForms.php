<?php


/*
Ce fichier définit diverses fonctions permettant de faciliter la production de mises en formes complexes : 
tableaux, formulaires, ...
*/

function mkLigneEntete($tabAsso,$listeChamps=false)
{
	// Fonction appelée dans mkTable, produit une ligne d'entête
	// contenant les noms des champs à afficher dans mkTable
	// Les champs à afficher sont définis à partir de la liste listeChamps 
	// si elle est fournie ou du tableau tabAsso

	echo "<tr>";
	if ($listeChamps) {
		// certains champs sont demandés
		foreach ($listeChamps as $champ) {
			echo "<th>$champ</th>\n";
		}
	}
	else {
		// on affiche tous les champs 
		foreach ($tabAsso as $cle => $val) {
			echo "<th>$cle</th>\n";
		}
	}	
	echo "</tr>\n";

}

function mkLigne($tabAsso,$listeChamps=false)
{
	// Fonction appelée dans mkTable, produit une ligne 
	// contenant les valeurs des champs à afficher dans mkTable
	// Les champs à afficher sont définis à partir de la liste listeChamps 
	// si elle est fournie ou du tableau tabAsso

	echo "<tr>";
	if ($listeChamps) {
		// certains champs sont demandés
		foreach ($listeChamps as $champ) {
			echo "<td>"; 
			echo $tabAsso[$champ];
			echo "</td>\n";
		}
	}
	else {
		// on affiche tous les champs 
		foreach ($tabAsso as $cle => $val) {
			echo "<td>$val</td>\n";
		}
	}
	echo "</tr>\n";
}


/* appel avec 
mkTable(
	$users,
	array('pseudo','couleur','connecte')
);	
*/
function mkTable($tabData,$listeChamps=false)
{
	// Produit un tableau affichant les données passées en paramètre
	// Si listeChamps est vide, on affiche toutes les données de $tabData
	// S'il est défini, on affiche uniquement les champs listés dans ce tableau, 
	// dans l'ordre du tableau

	// Cette fonction est appelée après une récupération de 
	// données depuis la BDD, et un appel à parcoursRs
	// Lorsqu'il n'y a pas de données, $tabData est vide

	if (count($tabData) ==0) {	
		// SI TABLEAU VIDE 
		echo "Pas de donnees !";
		return ; 
	}

	echo '<table border="1">';

	// Afficher une ligne d'entête 
	// On passe à la fonction mkLigneEntete($tabAsso,$listeChamps=false)
	// la première ligne du tableau : $tabData[0]
	// On sait qu'elle existe car sinon on aurait déjà quitté la fonction 
	mkLigneEntete($tabData[0],$listeChamps);
	// mkLigne($tabData[0]);
	// Parcourir les données, pour chaque enregistrement
	// Afficher une ligne dans un tableau HTML

for ($i=0;$i<count($tabData);$i++){
	$data = $tabData[$i];
	mkLigne($data,$listeChamps);
}
// possible aussi foreach ($tabData as $data)

	echo "</table>";	
}

function mkSelect($nomChampSelect, $tabData,$champValue, $champLabel,$selected=false,$champLabel2=false)
{
	// Produit un menu déroulant portant l'attribut name = $nomChampSelect
	// TNE: Si cette variable se termine par '[]', il faudra affecter l'attribut multiple à la balise select

	// Produire les options d'un menu déroulant à partir des données passées en premier paramètre
	// $champValue est le nom des cases contenant la valeur à envoyer au serveur
	// $champLabel est le nom des cases contenant les labels à afficher dans les options
	// $selected contient l'identifiant de l'option à sélectionner par défaut
	// si $champLabel2 est défini, il indique le nom d'une autre case du tableau 
	// servant à produire les labels des options

echo "<select name=\"$nomChampSelect\">";
foreach ($tabData as $data)
{
	echo "<option value=\"$data[$champValue]\" ";
	if (($selected) && ($data[$champValue] == $selected)) echo " selected ";
	echo " >";
	echo $data[$champLabel];
	if ($champLabel2) 	echo "-" . $data[$champLabel2];
	echo "</option>\n"; 
}
echo "</select>";
}

function mkForm($action="",$method="get")
{
	// Produit une balise de formulaire NB : penser à la balise fermante !!
	echo "<form action=\"$action\" method=\"$method\"	>\n";
}
function endForm()
{
	// produit la balise fermante
	echo "</form>\n";
}

function mkInput($type,$name,$value="")
{
	// Produit un champ formulaire
	echo "<input type=\"$type\"	name=\"$name\" value=\"$value\" />\n";
}


function mkRadioCb($type,$name,$value,$checked=false)
{
	// Produit un champ formulaire de type radio ou checkbox
	// Et sélectionne cet élément si le quatrième argument est vrai
	$selectionne = "";	
	if ($checked) 
		$selectionne = "checked=\"checked\"";
	echo "<input type=\"$type\" name=\"$name\" value=\"$value\"  $selectionne />";
}

function mkLien($url,$label, $qs="")
{
	echo "<a href=\"$url?$qs\">$label</a>";
}

function br()
{
	echo "<br />\n"; 
}
?>

















