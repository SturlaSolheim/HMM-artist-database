<?php
//Denne filen brukes for å registrere informasjon om nytt album, informasjon
//om sangene i albumene blir registrert i registrerSanger.php 
include("start.php");
?>






<form method="POST" action="nyttAlbum.php" name="nyttAlbumForm" enctype="multipart/form-data">
        Artist<select name="valgtArtist">
        <?php
//-------------------------------------------------------------
//Denne delen blir brukt for å generere listebokser av hver artist i databasen
    include("dbTilkobling.php");


    $sqlSELECT="SELECT * FROM Artist"; 

    $sqlResultat=mysqli_query($db, $sqlSELECT);

    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++) {
        $rad=mysqli_fetch_array($sqlResultat);
    $artistNavn=$rad["Artistnavn"]; 

        print ("<option value=$artistNavn>$artistNavn</option>");
    }
//---------------------------------------------------------------
?>

        </select> <br>
        Tittel på albumet<input type="text" name="albumNavn" required> <br>
        Albumcover<input type="file" name="albumBilde" required> <br>
        Antall sanger <input type="number" name="antallSanger" min="1" step="1" required> <br>
        Albumnummer <input type="number" name="albumnummer" required> <br>
        <input type="submit" name="submit" value="Videre">

</form>







<?php

if (isset($_POST["submit"])){
//-------------------------------------------------
//Åpner session for å ta med informasjon om albumet videre inn i registrerSanger.php
session_start();
$_SESSION["antallSanger"]=$_POST["antallSanger"];
$_SESSION["albumNavn"]=$_POST["albumNavn"];
$_SESSION["valgtArtist"]=$_POST["valgtArtist"];
$_SESSION["albumnummer"]=$_POST["albumnummer"];
$albumTittel=$_POST["albumNavn"];
//--------------------------------------------------



//Filbehandling av albumcover---------------------------------------------------------------
$filnavn=$_FILES["albumBilde"]["name"];  // filnavn på opplastet fil  
$filtype=$_FILES["albumBilde"]["type"];  // filtype på opplastet fil 
$filstorrelse=$_FILES["albumBilde"]["size"];  // filstørrelse på opplastet fil  
$tmpnavn=$_FILES["albumBilde"]["tmp_name"];    // midlertidig navn på opplastet fil 
$nyttnavn="bilder/" .$albumTittel ."." . substr($filtype, 6);  // mappe- og filnavn på opplastet fil 
//--------------------------------------------------------------------------------------------

move_uploaded_file($tmpnavn,$nyttnavn); //flytter bildefil med nytt navn inn i /bilder mappe


print("<meta http-equiv='refresh' content='0;url=registrerSanger.php'>");  //Flytter oss videre til registrerSanger.php

}

?>

<?php
include("slutt.php");
?>