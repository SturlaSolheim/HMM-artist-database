<?php
//Denne filen blir 'includet' i alle nye album

include("start.php");
include("dbTilkobling.php");

$artistMedPHP=str_replace("_", " ", basename($_SERVER['PHP_SELF']));  //Finner artistnavnet via linken og tar vekk understreker
$artistMedMappe=str_replace(".php", "", $artistMedPHP);//Tar vekk .php
$album=str_replace("artister/", "", $artistMedMappe);//Tar vekk mappevisningen, altså /artister. Så står man igjen med bare artistnavnet

    //Finner albumNr til albumet man er på
    $sqlSELECTalbumnr="SELECT * FROM Album WHERE Album.AlbumNavn='$album';";
    $resultat=mysqli_query($db, $sqlSELECTalbumnr);
    $rad=mysqli_fetch_array($resultat);
    $globalAlbumNr=$rad["AlbumNr"];

print ($artist);
?>

<h2> <a href="index.php">Tilbake</a></h2>

<h1>Dette albumet heter <?php print ($album);?></h1> <br>
<img src="/bilder/<?php print ($album);?>.jpeg"  style='width:200px;height:auto;'>



<form name="sporForm" action="<?php print ($album);?>.php" method="POST" enctype="multipart/form-data">
    <?php include("functions.php"); genererSpor($album);?> <br> <!-- Genererer <input> for hvert spor -->
    <input type="submit" name="submit" value="LAGRE ENDRINGER">
</form>





<form action="<?php print($album);?>.php" method="POST">
    <input type="submit" name="nyttSpor" value="NYTT SPOR">
    <input type="submit" name="slettSpor" value="SLETT SISTE SPOR">
</form>



<?php
//-----------------------------------------------------------------------
//Lager et nytt spor

if (isset($_POST["nyttSpor"])){
    include("dbTilkobling.php");

    //Inkrementerer antall spor i databasen med 1
    $sqlSET="UPDATE Album SET AntallSpor = AntallSpor + 1 WHERE AlbumNavn='$album';";
    mysqli_query($db, $sqlSET);

    //Finner antall spor albumet har
    $sqlAntallSpor="SELECT * FROM Album WHERE Album.AlbumNr='$globalAlbumNr';";
    $resultatAntallSpor=mysqli_query($db, $sqlAntallSpor);
    $radAntallSpor=mysqli_fetch_array($resultatAntallSpor);
    $antallSpor=$radAntallSpor["AntallSpor"];

    //INSERT "tomme" verdier til hver KOLONNE
    $sqlInsertspor="INSERT INTO Spor (SporNr, SporNavn, Lengde, ISRC, AlbumNr, sporLenke) VALUES ('$antallSpor', 'TOMT', 'TOMT', 'TOMT', '$globalAlbumNr', 'TOMT');";
    mysqli_query($db, $sqlInsertspor);

print("<meta http-equiv='refresh' content='0;url=$album.php'>"); //returnerer til albumsiden

}
//-----------------------------------------------------------------------------------------------------------






//-----------------------------------------------------------------------------------------------------------
//Sletter siste spor
if (isset($_POST["slettSpor"])){
    include("dbTilkobling.php");

        //Finner antall spor albumet har
        $sqlAntallSpor="SELECT * FROM Album WHERE Album.AlbumNr='$globalAlbumNr';";
        $resultatAntallSpor=mysqli_query($db, $sqlAntallSpor);
        $radAntallSpor=mysqli_fetch_array($resultatAntallSpor);
        $antallSpor=$radAntallSpor["AntallSpor"];

if ($antallSpor>0){ //passer på at databasen ikke kan vise negative verdier på antall spor
    //Sletter sporet
    $sqlSlett="DELETE FROM Spor WHERE Spor.SporNr='$antallSpor' AND Spor.AlbumNR='$globalAlbumNr';";
    mysqli_query($db, $sqlSlett);

    //Reduserer antall spor med 1 
    $sqlSETned="UPDATE Album SET AntallSpor = AntallSpor - 1 WHERE AlbumNavn='$album';";
    mysqli_query($db, $sqlSETned);
}

print("<meta http-equiv='refresh' content='0;url=$album.php'>"); //returnerer til albumsiden
//--------------------------------------------------------------------------------------------------------

}



//----------------------------------------------------------------------------------------------------------
//Lagrer endringer gjort på spor
if (isset($_POST["submit"])){
    include("dbTilkobling.php");

        $sqlSELECTendring="SELECT * FROM Spor WHERE Spor.AlbumNr='$globalAlbumNr';";
        $resultatEndring=mysqli_query($db, $sqlSELECTendring);
        $antallRaderEndring=mysqli_num_rows($resultatEndring);


        for ($r=1;$r<=$antallRaderEndring;$r++){
            $sportittel=$_POST["tittel$r"];
            $sporlengde=$_POST["lengde$r"];
            $sporisrc=$_POST["isrc$r"];

            $filnavn=$_FILES ["fil$r"]["name"];  // filnavn på opplastet fil  
            $filtype=$_FILES ["fil$r"]["type"];  // filtype på opplastet fil 
            $filstorrelse=$_FILES ["fil$r"]["size"];  // filstørrelse på opplastet fil  
            $tmpnavn=$_FILES ["fil$r"]["tmp_name"];    // midlertidig navn på opplastet fil 
            $nyttnavn="lydfiler/".$r .$sportittel . $globalAlbumNr ."." . "wav";  // mappe- og filnavn på opplastet fil 

            move_uploaded_file($tmpnavn,$nyttnavn);
        }

        for ($r=1;$r<=$antallRaderEndring;$r++){
            $sportittel=$_POST["tittel$r"];
            $sporlengde=$_POST["lengde$r"];
            $sporisrc=$_POST["isrc$r"];

            $sqlENDRE .="UPDATE Spor SET SporNavn = '$sportittel', Lengde = '$sporlengde', ISRC = '$sporisrc' WHERE Spor.AlbumNr='$globalAlbumNr' AND Spor.SporNr='$r';";
        }
        mysqli_multi_query($db, $sqlENDRE);

print("<meta http-equiv='refresh' content='0;url=$album.php'>"); //returnerer til albumsiden

}

//------------------------------------------------------------------------------------------------------------



?>




<?php
include("slutt.php");
?>

