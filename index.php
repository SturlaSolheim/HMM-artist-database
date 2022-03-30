<?php
include("start.php");
?>

<form method="POST" action="index.php">
    <div class="container-forside">
        
        <div class="item-overskrift item"><p>Våre artister</p></div>

    <?php
    include("dynamiskArtist.php");
    ?>

    <div class="item"><p><a href="nyArtist.php">NY ARTIST</a><br>
                <button id="slettArtister">Slett artister</button></p></div>
        
        
    </div>

    <input name="submit" id="submit" type="submit" onclick="slettArtister()">

</form>
    

<?php
include("slutt.php");
?>