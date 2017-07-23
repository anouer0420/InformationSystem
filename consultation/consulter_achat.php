<?php
/**
 * Created by PhpStorm.
 * User: Rouissi
 * Date: 13/03/15
 * Time: 11:02
 */

include('../connexion.php');
session_start ();

// On récupère nos variables de session
if (isset($_SESSION['login']) && isset( $_SESSION['type'])  ) {
	$l=$_SESSION['login'];
	$b=$_SESSION['type'];
	
}
else {
	header('location: ../index.html');
}
if($b != 'admin')
		if($b == 'responsable vente'){
		header('location: ../HOME/accueil.php.php5');}
		else if ($b == 'user'){
		header('location: ../HOME/accueil.php.php5');}
else{

$reponse1 = $bdd->query("SELECT `login` FROM `utilisateur` WHERE `type` LIKE 'responsable achat' OR `type` LIKE 'responsable vente'");


?>
<style type="text/css">
select {
    padding:3px;
    margin: 0;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: #f8f8f8;
    color:#888;
    border:none;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;
}

/* Targetting Webkit browsers only. FF will show the dropdown arrow with so much padding. */
@media screen and (-webkit-min-device-pixel-ratio:0) {
    select {padding-right:250px}
}

label {position:relative}
label:after {
    content:'<>';
    font:11px "Consolas", monospace;
    color:#aaa;
    -webkit-transform:rotate(90deg);
    -moz-transform:rotate(90deg);
    -ms-transform:rotate(90deg);
    transform:rotate(90deg);
    right:8px; top:0px;
    padding:-25 0 2px;
    border-bottom:1px solid #ddd;
    position:absolute;
    pointer-events:none;
}
label:before {
    content:'';
    right:6px; top:0px;
    width:20px; height:20px;
    background:#f8f8f8;
    position:absolute;
    pointer-events:none;
    display:block;
}
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 8px solid #36752D; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; }.datagrid table td, .datagrid table th { padding: 13px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #36752D), color-stop(1, #275420) );background:-moz-linear-gradient( center top, #36752D 5%, #275420 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#36752D', endColorstr='#275420');background-color:#36752D; color:#FFFFFF; font-size: 17px; font-weight: bold; border-left: 5px solid #36752D; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #275420; border-left: 5px solid #C6FFC2;font-size: 16px;font-weight: normal; }.datagrid table tbody .alt td { background: #DFFFDE; color: #275420; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }
.consult {
	text-align: center;
}
.consult {
	text-align: right;
}
.consul {
	font-weight: bold;
}
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>GIL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../administrateur/images/front/logo.png" rel="shortcut icon"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="../mos-css/mos-style.css"> <!--pemanggilan file css-->

     <div class="quoteOfDay" style="color: #000"><?php echo('Bienvenue  '.$l); ?>&nbsp;&nbsp;&nbsp;&nbsp;|<a href="../deconnexion.php">Quitter</a></div>
</head>
<body id="page1" onLoad="new ElementMaxHeight();">
<!-- START PAGE SOURCE -->
<div style="-moz-border-bottom-colors: gray; border:1px solid black; color:darkgreen; font-size:150%; padding:1em;">
<center><img src="../administrateur/images/front/logo.png" width="260" height="110"></center>
</div><h1>Rapport</h1>
<?php $reponse=$bdd->query("SELECT * FROM `facture_achat` WHERE `responsable` LIKE '".$l."'");
$reponse2=$bdd->query("SELECT count(*) as nbre FROM `facture_achat` WHERE `responsable` LIKE '".$l."'");
$req=$reponse2->fetch();
$a=$req['nbre'];
?>
<form action="consulter_achat_a.php" method="post">
<div class="datagrid"><table>
<thead><tr>
<th>ID</th>
  <th>Nom</th>
  <th>Prenom</th>
  <th>CIN</th>
  <th>Centre</th>
  <th>Ville</th>
  <th>Gouvernat</th>
  <th>Quantité</th>
  <th>PrixU</th>
  <th>Date</th>
  <th>Heure</th>
  <th>Pdf</th>
  <th>Edit</th>
  </tr></thead>

<tbody><?php $m=1; while($donnees = $reponse->fetch()){
	echo('<input type="hidden" value="'.$donnees['id'].'" name="iid'.$m.'"');
	
if(!empty($donnees)){
	echo('<input type="hidden" value="'.$m.'" name="nbre"');
	echo('<tr><td>'.$donnees['id'].'</td><td>'.$donnees['nom'].'</td><td>'.$donnees['prenom'].'</td><td>'.$donnees['cin'].'</td><td>'.$donnees['centre'].'</td><td>'.$donnees['ville'].'</td><td>'.$donnees['gouvernat'].'</td><td>'.$donnees['quantité'].'</td><td>'.$donnees['prixUnitaire'].'</td><td>'.$donnees['date'].'</td><td>'.$donnees['heure'].'</td><td><a href="../documents/facture.pdf"><img src="../img/téléchargement.png"></a></td><td><input value="A" type="checkbox" onclick="Change('.$a.')" class="checkboxlist" name="choix_'.$m.'" id="'.$a.'" /></tr>');$a=$a-1;}
	}?>
</tbody>
</table>

</div>

<div id="madiv"  style="display:none"><p><input type="submit" value="valider"></p></div>
<script type="text/javascript">
function Change(a) {
	for(var i=0;i<=a;i++){
		
if ((document.getElementById(a).checked)) {
document.getElementById('madiv').style.display="block";
}
else {
document.getElementById('madiv').style.display="none";
}
}}
</script>
</form>


<hr>
<?php if($b=='responsable achat'){
		echo('<table align="center"><tr><td><div class="shortcutHome">
		<p><a href="../HOME/Accueil.php.php5"><img src="../administrateur/images/home.jpg" width="64" height="64"><br>
		  Accueil</a>		</p>
    </div></td></tr></table>');
		} }?>
		