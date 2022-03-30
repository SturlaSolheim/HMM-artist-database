<?php
include("start.php");

$artistMedPHP=str_replace("_", " ", basename($_SERVER['PHP_SELF']));  //Finner artistnavnet via linken og tar vekk understreker
$artistMedMappe=str_replace(".php", "", $artistMedPHP);//Tar vekk .php
$artist=str_replace("artister/", "", $artistMedMappe);//Tar vekk mappevisningen, altså /artister. Så står man igjen med bare artistnavnet

?>




<form method="POST" action="index.php">
    <div class="container-forside">
        
        <div class="item-overskrift item"><p>Albumene til <?php print $artist;?> </p></div>

    <?php
    include("artistDynamiskTemplate.php");
    ?>

    <div class="item"><p><a href="nyttAlbum.php">NYTT ALBUM</a><br>
                <button id="slettArtister">Slett artister</button></p></div>
        
        
    </div>

    <input name="submit" id="submit" type="submit" onclick="slettArtister()">

</form>




<?php
include("slutt.php");
?>