<?php
include("start.php");
?>

<?php
$antallSanger=$_POST["antallSanger"];
$albumTittel=$_POST["albumNavn"];
$artistnavn=$_POST["valgtArtist"];
$albumNr=$_POST["albumnummer"];


//Filbehandling av albumcover---------------------------------------------------------------
$filnavn=$_FILES ["albumBilde"]["name"];  // filnavn på opplastet fil  
$filtype=$_FILES ["albumBilde"]["type"];  // filtype på opplastet fil 
$filstorrelse=$_FILES ["albumBilde"]["size"];  // filstørrelse på opplastet fil  
$tmpnavn=$_FILES ["albumBilde"]["tmp_name"];    // midlertidig navn på opplastet fil 
$nyttnavn="bilder/" .$albumTittel ."." . substr($filtype, 6);  // mappe- og filnavn på opplastet fil 
//--------------------------------------------------------------------------------------------

?>

<form action="registrerSanger.php" method="POST" name="sangerForm">
    <?php
    include("functions.php");
    lagSangForm($antallSanger);
    ?>
    <input type="submit" name="submit" value="Registrer">
</form>

<?php
if (isset($_POST["submit"])){
    move_uploaded_file($tmpnavn,$nyttnavn);
    include("dbTilkobling.php");
    $sqlINSERTalbum="INSERT INTO Album (AlbumNavn, AlbumNr, ArtistNavn) VALUES ('$albumTittel', '$albumNr', '$artistnavn');";

    if(mysqli_query($db, $sqlINSERTalbum)){

            $r=1;
            while($r<=$antallSanger){
                $tittel=$_POST["tittel$r"];
                $lengde=$_POST["lengde$r"];
                $isrc=$_POST["isrc$r"];

                $sqlINSERT="INSERT INTO Spor (SporNr, SporNavn, Lengde, ISRC, AlbumNr) VALUES ('$r', '$tittel', '$lengde', '$isrc', $albumNr);";
                mysqli_query($db, $sqlINSERT);
                $r++;

                print ($tittel . $lengde . $isrc . $albumNr);

            }
}
   print("<meta http-equiv='refresh' content='0;url=index.php'>"); 
}
?>


<?php
include("slutt.php");
?>