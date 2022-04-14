<?php

//Denne filen henter antall artister og lager bokser for hver artist.

include("dbTilkobling.php");


$sqlSELECT="SELECT * FROM Album WHERE Album.Artistnavn='$artist';"; 

$sqlResultat=mysqli_query($db, $sqlSELECT);

$antallRader=mysqli_num_rows($sqlResultat); //Henter antall artister

//SQL spørringene--------------------------------------------------








//Lager <div> boksene for hver artist i en loop
for ($r=1;$r<=$antallRader;$r++) {
    $rad=mysqli_fetch_array($sqlResultat);
$albumNavn=$rad["AlbumNavn"]; 

$albumLink=str_replace(" ", "", $albumNavn) . ".php";
$albumVistNavn=str_replace("_", " ", $albumNavn);

//printen for hver artist
    print ("<div class='item-$r item'> <p><a href='$albumLink'> <img src='bilder/$albumNavn.jpeg' style='width:auto;max-height:200px;'> </a><br> $albumVistNavn</p> <br> <input id='gjem' type='checkbox' name='$albumNavn' value='$albumNavn'> </div>");
}


?>
