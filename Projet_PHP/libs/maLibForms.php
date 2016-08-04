<?php


/*
Ce fichier d�finit diverses fonctions permettant de faciliter la production de mises en formes complexes : 
tableaux, formulaires, ...
*/

function mkLigneEntete($tabAsso,$listeChamps=false)
{
	// Fonction appel�e dans mkTable, produit une ligne d'ent�te
	// contenant les noms des champs � afficher dans mkTable
	// Les champs � afficher sont d�finis � partir de la liste listeChamps 
	// si elle est fournie ou du tableau tabAsso

	echo "<tr>";
	if ($listeChamps) {
		// certains champs sont demand�s
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
	// Fonction appel�e dans mkTable, produit une ligne 
	// contenant les valeurs des champs � afficher dans mkTable
	// Les champs � afficher sont d�finis � partir de la liste listeChamps 
	// si elle est fournie ou du tableau tabAsso

	echo "<tr>";
	if ($listeChamps) {
		// certains champs sont demand�s
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
	// Produit un tableau affichant les donn�es pass�es en param�tre
	// Si listeChamps est vide, on affiche toutes les donn�es de $tabData
	// S'il est d�fini, on affiche uniquement les champs list�s dans ce tableau, 
	// dans l'ordre du tableau

	// Cette fonction est appel�e apr�s une r�cup�ration de 
	// donn�es depuis la BDD, et un appel � parcoursRs
	// Lorsqu'il n'y a pas de donn�es, $tabData est vide

	if (count($tabData) ==0) {	
		// SI TABLEAU VIDE 
		echo "Pas de donnees !";
		return ; 
	}

	echo '<table border="1">';

	// Afficher une ligne d'ent�te 
	// On passe � la fonction mkLigneEntete($tabAsso,$listeChamps=false)
	// la premi�re ligne du tableau : $tabData[0]
	// On sait qu'elle existe car sinon on aurait d�j� quitt� la fonction 
	mkLigneEntete($tabData[0],$listeChamps);
	// mkLigne($tabData[0]);
	// Parcourir les donn�es, pour chaque enregistrement
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
	// Produit un menu d�roulant portant l'attribut name = $nomChampSelect
	// TNE: Si cette variable se termine par '[]', il faudra affecter l'attribut multiple � la balise select

	// Produire les options d'un menu d�roulant � partir des donn�es pass�es en premier param�tre
	// $champValue est le nom des cases contenant la valeur � envoyer au serveur
	// $champLabel est le nom des cases contenant les labels � afficher dans les options
	// $selected contient l'identifiant de l'option � s�lectionner par d�faut
	// si $champLabel2 est d�fini, il indique le nom d'une autre case du tableau 
	// servant � produire les labels des options

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
	// Produit une balise de formulaire NB : penser � la balise fermante !!
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
	// Et s�lectionne cet �l�ment si le quatri�me argument est vrai
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

















