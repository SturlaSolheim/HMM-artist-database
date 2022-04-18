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
        Albumnummer <input type="number" name="albumnummer" required> <br>
        <input type="submit" name="submit" value="Videre">

</form>







<?php

if (isset($_POST["submit"])){
//-------------------------------------------------
//Åpner session for å ta med informasjon om albumet videre inn i registrerSanger.php

$albumTittel=$_POST["albumNavn"];
$albumNr=$_POST["albumnummer"];
$artistnavn=$_POST["valgtArtist"];
//--------------------------------------------------



//Filbehandling av albumcover---------------------------------------------------------------
$filnavn=$_FILES["albumBilde"]["name"];  // filnavn på opplastet fil  
$filtype=$_FILES["albumBilde"]["type"];  // filtype på opplastet fil 
$filstorrelse=$_FILES["albumBilde"]["size"];  // filstørrelse på opplastet fil  
$tmpnavn=$_FILES["albumBilde"]["tmp_name"];    // midlertidig navn på opplastet fil 
$nyttnavn="bilder/" .$albumTittel ."." . substr($filtype, 6);  // mappe- og filnavn på opplastet fil 
//--------------------------------------------------------------------------------------------

move_uploaded_file($tmpnavn,$nyttnavn); //flytter bildefil med nytt navn inn i /bilder mappe

include("dbTilkobling.php");
$sqlINSERTalbum="INSERT INTO Album (AlbumNavn, AlbumNr, ArtistNavn, AntallSpor) VALUES ('$albumTittel', '$albumNr', '$artistnavn', 0);";
mysqli_query($db, $sqlINSERTalbum);


$nyPHP=fopen($albumTittel. ".php", "a"); //Lager ny artist php fil

fwrite($nyPHP, "<?php include('endreAlbumTemplate.php');?>");

fclose($ntPHP);


print("<meta http-equiv='refresh' content='0;url=$artistnavn.php'>");  //Flytter oss videre til registrerSanger.php

}

?>

<?php
include("slutt.php");
?>