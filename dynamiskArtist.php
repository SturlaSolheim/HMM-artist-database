<?php

//Denne filen henter antall artister og lager bokser for hver artist.

include("dbTilkobling.php");


$sqlSELECT="SELECT * FROM Artist"; 

$sqlResultat=mysqli_query($db, $sqlSELECT);

$antallRader=mysqli_num_rows($sqlResultat); //Henter antall artister

//SQL spørringene--------------------------------------------------








//Lager <div> boksene for hver artist i en loop
for ($r=1;$r<=$antallRader;$r++) {
    $rad=mysqli_fetch_array($sqlResultat);
$artist=$rad["Artistnavn"]; 

$artistLink=str_replace(" ", "", $artist) . ".php";
$artistVistNavn=str_replace("_", " ", $artist);

//printen for hver artist
    print ("<div class='item-$r item'> <p><a href='$artistLink'> <img src='bilder/$artist.jpeg' style='width:200px;height:200px;'> </a><br> $artistVistNavn</p> <br> <input id='gjem' type='checkbox' name='$artist' value='$artist'> </div>");
}


?>
