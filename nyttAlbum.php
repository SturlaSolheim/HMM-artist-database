<?php
include("start.php");
?>

<form method="POST" action="registrerSanger.php" name="nyttAlbumForm" enctype="multipart/form-data">
        Artist<select name="valgtArtist">
        <?php
    include("dbTilkobling.php");


    $sqlSELECT="SELECT * FROM Artist"; 

    $sqlResultat=mysqli_query($db, $sqlSELECT);

    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++) {
        $rad=mysqli_fetch_array($sqlResultat);
    $artistNavn=$rad["Artistnavn"]; 

        print ("<option value=$artistNavn>$artistNavn</option>");
    }
?>

        </select> <br>
        Tittel på albumet<input type="text" name="albumNavn" required> <br>
        Albumcover<input type="file" name="albumBilde" required> <br>
        Antall sanger <input type="number" name="antallSanger" min="1" step="1" required> <br>
        Albumnummer <input type="number" name="albumnummer" required> <br>
        <input type="submit" name="submit" value="Videre">

</form>

<?php
include("slutt.php");
?>