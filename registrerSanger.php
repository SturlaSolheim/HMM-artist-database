<?php
//I denne filen registrerer man sanger om album.
//Albuminformasjonen tas videre fra nyttAlbum.php via session
include("start.php");
?>




<?php
//-------------------------------------------
//Lager nye variabler fra $_SESSION["]
session_start();
$antallSanger=$_SESSION["antallSanger"];
$albumTittel=$_SESSION["albumNavn"];
$artistnavn=$_SESSION["valgtArtist"];
$albumNr=$_SESSION["albumnummer"];
//----------------------------------------
?>





<form action="registrerSanger.php" method="POST" name="sangerForm" enctype="multipart/form-data">
    <?php
    include("functions.php");
    lagSangForm($antallSanger); //Lager 'form' for hver sang i albumet
    ?>
    <input type="submit" name="submit" value="Registrer">
</form>




<?php
if (isset($_POST["submit"])){

    include("dbTilkobling.php");
    $sqlINSERTalbum="INSERT INTO Album (AlbumNavn, AlbumNr, ArtistNavn) VALUES ('$albumTittel', '$albumNr', '$artistnavn');";
//Legger inn albuminformasjon i databasen


/*
//--------------------------------------------------------------------------
//Behandler opplastede WAV filer

    $s=1;
    while ($s<=$antallSanger){

$filnavn=$_FILES["fil$s"]["name"];  // filnavn på opplastet fil  
$filtype=$_FILES["fil$s"]["type"];  // filtype på opplastet fil 
$filstorrelse=$_FILES["fil$s"]["size"];  // filstørrelse på opplastet fil  
$tmpnavn=$_FILES["fil$s"]["tmp_name"];    // midlertidig navn på opplastet fil 
$nyttnavn="lydfiler/" .$albumNr . "spor". $s . ".wav";  // mappe- og filnavn på opplastet fil 

move_uploaded_file($tmpnavn,$nyttnavn); //Flytter filen til ny mappe

include("dbTilkobling.php");
$sqlSporLenke="INSERT INTO Spor (sporLenke) VALUES ('$nyttnavn');";
mysqli_query($db, $sqlSporLenke);
//Laster opp sporlenke inn i databasen
$s++;

    }

//-------------------------------------------------------------------------

*/





//--------------------------------------------------------------------
//legger inn informasjon om spor
    if(mysqli_query($db, $sqlINSERTalbum)){

            $r=1;
            while($r<=$antallSanger){
                
                $tittel=$_POST["tittel$r"];
                $lengde=$_POST["lengde$r"];
                $isrc=$_POST["isrc$r"];

/*
                $filnavn=$_FILES["fil$r"]["name"];  // filnavn på opplastet fil  
                $filtype=$_FILES["fil$r"]["type"];  // filtype på opplastet fil 
                $filstorrelse=$_FILES["fil$r"]["size"];  // filstørrelse på opplastet fil  
                $tmpnavn=$_FILES["fil$r"]["tmp_name"];    // midlertidig navn på opplastet fil 
                $nyttnavn="lydfiler/" .$albumNr . "spor". $s . ".wav";  // mappe- og filnavn på opplastet fil 

                move_uploaded_file($tmpnavn,$nyttnavn); //Flytter filen til ny mappe

*/



                $sqlINSERT="INSERT INTO Spor (SporNr, SporNavn, Lengde, ISRC, AlbumNr) VALUES ('$r', '$tittel', '$lengde', '$isrc', $albumNr);";
                mysqli_query($db, $sqlINSERT);
                $r++;
            }
}
//--------------------------------------------------------------------------

   print("<meta http-equiv='refresh' content='0;url=index.php'>"); //Tar oss tilbake til index.php
}
?>


<?php
include("slutt.php");
?>