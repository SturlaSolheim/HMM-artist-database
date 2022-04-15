<?php
//Denne filen blir 'includet' i alle nye artister

include("start.php");

$artistMedPHP=str_replace("_", " ", basename($_SERVER['PHP_SELF']));  //Finner artistnavnet via linken og tar vekk understreker
$artistMedMappe=str_replace(".php", "", $artistMedPHP);//Tar vekk .php
$artist=str_replace("artister/", "", $artistMedMappe);//Tar vekk mappevisningen, altså /artister. Så står man igjen med bare artistnavnet

?>


<h2> <a href="index.php">Tilbake</a></h2>

<!-- 'form' blir igjen brukt over hele containeren for å kunne slette album til slutt-->
<form method="POST" action="index.php">
    <div class="container-forside">
        
        <div class="item-overskrift item"><p>Albumene til <?php print $artist;?> </p></div>

    <?php
    include("artistDynamiskTemplate.php"); //En fil som lager en boks til alle album til denne artisten som er lagret i databasen
    ?>

    <div class="item"><p><a href="nyttAlbum.php">NYTT ALBUM</a><br>
             
        
        
    </div>

    </div>


     <input type="submit" name="submit" value="SLETT">


     <div id="test"></div>

</form>

<button id="slettArtister">Slett artister</button> <br> <!--Viser frem checkbokser til sletting når trykkes på -->








<?php
//Alt under her er kode for å slette album som har blitt checket
if(isset($_POST["submit"])){
    $valgteAlbum=$_POST["albumCheckbox"]; //Et array med alle checked checkbokser

//----------------------------------------------------------------------------
//En loop for å lage et  array som inneholder albumnummer
$albumNummer = [];
    foreach($valgteAlbum as $alb){
        include("dbTilkobling.php");
        include("functions.php");
            $sqlAlbumNummer="SELECT * FROM Album WHERE Album.AlbumNavn='$alb';";
            $resultat=mysqli_query($db, $sqlAlbumNummer);
            $array=mysqli_fetch_array($resultat); //Array med alle kolonnene til det første valgte albumet
            $dbAlbumNummer=$array[$alb];//Variabel med albumnummeret til det lavgte albumet eks. 77

            array_push($albumNummer, $dbAlbumNummer);//Pusher albumnummer til array
    }
//-------------------------------------------------------------------------------------------------------




 //----------------------------------------------------------------------
    foreach($albumNummer as $num){ //Loop for å slette spor fra database 
        //Slette spor fra databasen
        include("dbTilkobling.php");
                $sqlDELETEspor="DELETE FROM Spor WHERE Album.AlbumNr='$num';";
                mysqli_query($db, $sqlDELETEspor);
    }
 //----------------------------------------------------------------------





 //----------------------------------------------------------------------
    foreach($valgteAlbum as $arts){ //Loop for å slette album fra database
       //Sletter album fra databasen
       include("dbTilkobling.php");

                $sqlDELETE="DELETE FROM Album WHERE Album.AlbumNavn='$arts';";
                mysqli_query($db, $sqlDELETE); //sletter filer fra databasen
    }
 //----------------------------------------------------------------------


 


 //------------------------------------------------------------------------

    foreach ($valgteAlbum as $arts){

                $bildelink="/bilder" ."/" . $arts . "jpeg";
                $artistlink=$arts . ".php";
                $artistDynamiskLink=$arts . "Dynamisk.php";

                unlink($bildelink);
                unlink($artistlink);
                unlink($artistDynamiskLink);   //sletter filer fra serveren

    }
 //---------------------------------------------------------------------


print("<meta http-equiv='refresh' content='0;url=index.php'>"); //returnerer til index
    
}
?>





<?php
include("slutt.php");
?>