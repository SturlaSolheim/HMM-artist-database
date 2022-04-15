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





<form action="registrerSanger.php" method="POST" name="sangerForm">
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


//--------------------------------------------------------------------
//legger inn informasjon om spor
    if(mysqli_query($db, $sqlINSERTalbum)){

            $r=1;
            while($r<=$antallSanger){
                
                $tittel=$_POST["tittel$r"];
                $lengde=$_POST["lengde$r"];
                $isrc=$_POST["isrc$r"];

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