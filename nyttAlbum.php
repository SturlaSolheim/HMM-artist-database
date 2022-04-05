<?php
include("start.php");
?>

<form method="POST" action="nyttAlbum.php" name="nyttAlbumForm" enctype="multipart/form-data">
    <div id="albumForm">
        Tittel på albumet<input type="text" name="albumNavn">
        Albumcover<input type="file" name="albumBilde">
    </div>

    <div id="sanger">
        
    </div>




</form>

<?php
include("slutt.php");
?>