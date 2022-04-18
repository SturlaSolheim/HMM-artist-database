<?php

/*Dette er index siden til applikasjonen */

include("start.php");
?>


<!-- Hele nettsiden er i en <form> fordi det gir muligheten til å slette med en submit knapp til slutt-->
<form method="POST" action="index.php" name="slettForm">

    <div class="container-forside">
        
        <div class="item-overskrift item"><p>Våre artister branch</p></div>

    <?php
    include("dynamiskArtist.php"); //Denne filer lager en boks til hver artist i databasen
    ?>

    <div class="item"><p><a href="nyArtist.php">NY ARTIST</a><br>
               </p></div>
        
        
    </div>


     <input type="submit" name="submit" value="SLETT">


     <div id="test"></div>

</form>

    <button id="slettArtister">Slett artister</button> <br> <!--Denne knappen er linket til jquery og den unhider
        checkbocksene til hver artist-->


<?php
//Alt under her er kode for å slette artister som har blitt checket

if(isset($_POST["submit"])){
    $valgteArtister=$_POST["artistCheckbox"]; //Et array med alle checked checkbokser
    foreach($valgteArtister as $arts){
        
        include("dbTilkobling.php");

        $sqlSELECT="SELECT * FROM Album WHERE Album.Artistnavn='$arts';";
        $resultat=mysqli_query($db, $sqlSELECT);
        $antallRader=mysqli_num_rows($resultat);
        //Skjekker om artisten har album fra før av

        if($antallRader!=0){
            print("Du må slette albumene til artisten først");
        }

            else{
                $sqlDELETE="DELETE FROM Artist WHERE Artist.Artistnavn='$arts';";
                mysqli_query($db, $sqlDELETE); //sletter filer fra databasen

                $bildelink="bilder" ."/" . $arts . ".jpeg";
                $artistlink=$arts . ".php";
                $artistDynamiskLink=$arts . "Dynamisk.php";

                unlink($bildelink);
                unlink($artistlink);
                unlink($artistDynamiskLink);   //sletter filer fra serveren

                print("<meta http-equiv='refresh' content='0;url=index.php'>"); //returnerer til index



                
            }
    }
}
?>




    

<?php
include("slutt.php");
?>