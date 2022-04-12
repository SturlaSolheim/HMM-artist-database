<?php
include("start.php");
?>
<?php
session_start();

$antallSanger=$_SESSION["antallSanger"];
$albumTittel=$_SESSION["albumNavn"];
$artistnavn=$_SESSION["valgtArtist"];
$albumNr=$_SESSION["albumnummer"];


//Filbehandling av albumcover---------------------------------------------------------------
$filnavn=$_SESSION["filnavn"];  // filnavn på opplastet fil  
$filtype=$_SESSION["filtype"];  // filtype på opplastet fil 
$filstorrelse=$_SESSION["filstorrelse"];  // filstørrelse på opplastet fil  
$tmpnavn=$_SESSION["tmpNavn"];    // midlertidig navn på opplastet fil 
$nyttnavn=$_SESSION["nyttnavn"];  // mappe- og filnavn på opplastet fil 
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
                

        

            }
            
}
   print("<meta http-equiv='refresh' content='0;url=index.php'>"); 
}
?>


<?php
include("slutt.php");
?>