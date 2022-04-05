<?php
include("start.php");
?>

<form method="POST" action="index.php" name="slettForm">

    <div class="container-forside">
        
        <div class="item-overskrift item"><p>Våre artister</p></div>

    <?php
    include("dynamiskArtist.php");
    ?>

    <div class="item"><p><a href="nyArtist.php">NY ARTIST</a><br>
               </p></div>
        
        
    </div>


     <input type="submit" name="submit" value="SLETT">


     <div id="test"></div>

    </form>

    <button id="slettArtister">Slett artister</button> <br>


<?php
if(isset($_POST["submit"])){
    $valgteArtister=$_POST["artistCheckbox"];
    foreach($valgteArtister as $arts){
        
        include("dbTilkobling.php");

        $sqlSELECT="SELECT * FROM Album WHERE Album.Artistnavn='$arts';";
        $resultat=mysqli_query($db, $sqlSELECT);
        $antallRader=mysqli_num_rows($resultat);

        if($antallRader!=0){
            print("Du må slette albumene til artisten først");
        }

        else{
            $sqlDELETE="DELETE FROM Artist WHERE Artist.Artistnavn='$arts';";
            mysqli_query($db, $sqlDELETE);

            $bildelink="/bilder" ."/" . $arts . "jpeg";
            $artistlink=$arts . ".php";
            $artistDynamiskLink=$arts . "Dynamisk.php";

            unlink($bildelink);
            unlink($artistlink);
            unlink($artistDynamiskLink);

            print("<meta http-equiv='refresh' content='0;url=index.php'>"); 



            
        }





    }
}
?>




    

<?php
include("slutt.php");
?>