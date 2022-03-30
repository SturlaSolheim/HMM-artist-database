<?php
include("start.php");

$artistMedPHP=str_replace("_", " ", basename($_SERVER['PHP_SELF']));
$artist=str_replace(".php", "", $artistMedPHP);
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