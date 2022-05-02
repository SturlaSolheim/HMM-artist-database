<?php

//Denne filen henter antall album og lager bokser for hvert album til en artist.

include("dbTilkobling.php");


$sqlSELECT="SELECT * FROM Album WHERE Album.Artistnavn='$artist';"; 

$sqlResultat=mysqli_query($db, $sqlSELECT);

$antallRader=mysqli_num_rows($sqlResultat); //Henter antall album

//SQL spørringene--------------------------------------------------








//Lager <div> boksene for hvert album i en loop
for ($r=1;$r<=$antallRader;$r++) {
    $rad=mysqli_fetch_array($sqlResultat);
$albumNavn=$rad["AlbumNavn"]; 
$albumNr=$rad["AlbumNr"];

$albumLink=str_replace(" ", "", $albumNavn) . ".php";
$albumVistNavn=str_replace("_", " ", $albumNavn);

//printen for hvert album
    print ("<div class='item-$r item'> <p><a href='$albumLink'> <img src='bilder/$albumNavn.jpeg' style='width:200px;max-height:auto;'> </a>
    <br> $albumVistNavn</p> <br>
     <input class='check' type='checkbox' style='display: none;' name='albumCheckbox[]' value='$albumNr'> </div>");
}


?>
