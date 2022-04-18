<?php
//Denne filen blir 'includet' i alle nye album

include("start.php");

$artistMedPHP=str_replace("_", " ", basename($_SERVER['PHP_SELF']));  //Finner artistnavnet via linken og tar vekk understreker
$artistMedMappe=str_replace(".php", "", $artistMedPHP);//Tar vekk .php
$album=str_replace("artister/", "", $artistMedMappe);//Tar vekk mappevisningen, altså /artister. Så står man igjen med bare artistnavnet

print ($artist);
?>

<h1>Dette albumet heter <?php print ($album);?> Denne siden vises på ipaden</h1> <br>

<?php include("functions.php"); genererSpor($album);?> <br>

<form action="endreAlbumTemplate.php">
    <input type="submit" name="submit" value="NYTT SPOR">
</form>

<?php
include("slutt.php");
?>

