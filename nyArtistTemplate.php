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
include("slutt.php");
?>