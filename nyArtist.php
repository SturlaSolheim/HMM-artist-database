<?php
//Denne filen brukes for å lage nye artister

include("start.php");
?>

<nav><a href="index.php">Tilbake</a></nav>

<!--HTML form for å registrere artistnavn og bilde -->
<form method="POST" action="nyArtist.php" name="artistForm" enctype="multipart/form-data">
    Artistnavn <input type="text" name="artistnavn"><br>
    Bilde <input type="file" name="fil"> <br>
    <input type="submit" name="submit" value="Lagre">
</form>
<!---------------------------------------------------------->


<?php
if (isset($_POST["submit"])){

    include("dbTilkobling.php");

    $artistNavn=str_replace(" ", "_", $_POST["artistnavn"]);

    //Ser om artisten allerede er registrert
    $sqlSELECTSjekk="SELECT * FROM Artist WHERE Artist.Artistnavn=$artistNavn;";
    $resultatSjekk=mysqli_query($db, $sqlSELECTSjekk);

    $antallRader=mysqli_num_rows($resultatSjekk);

    if ($antallRader!=0){
        print "Denne artisten er allerede lagret";
    }
    //-----------------------------------------------------




    else{

    $filnavn=$_FILES ["fil"]["name"];  // filnavn på opplastet fil  
    $filtype=$_FILES ["fil"]["type"];  // filtype på opplastet fil 
    $filstorrelse=$_FILES ["fil"]["size"];  // filstørrelse på opplastet fil  
    $tmpnavn=$_FILES ["fil"]["tmp_name"];    // midlertidig navn på opplastet fil 
    $nyttnavn="bilder/" .$artistNavn ."." . substr($filtype, 6);  // mappe- og filnavn på opplastet fil 

    if (($filtype != "image/gif" && $filtype != "image/jpeg" && $filtype != "image/png") ){
        print "Du kan kun laste opp bilder";
    }

//Etter alle testene, det er her alt det gode skjer
    else{
        move_uploaded_file($tmpnavn,$nyttnavn) or die ("ikke mulig &aring; laste opp fil"); //Flytter filen til ny mappe

        print substr($filtype, 6);

        $nyPHP=fopen($artistNavn. ".php", "a"); //Lager ny artist php fil

        fwrite($nyPHP, "<?php include('nyArtistTemplate.php');?>");
 


       

        $nyPHPAlbum=fopen($artistNavn. "Dynamisk". ".php", "a"); //Lager ny dynamisk artist php fil som lister opp albumene til artisten
        fclose($nyPHPAlbum);

        //INSERT artist inn i databasen
        $sqlINSERT="INSERT INTO Artist (Artistnavn) VALUES ('$artistNavn');";
        mysqli_query($db, $sqlINSERT);
    }
       
    }

}
?>








<?php
include("slutt.php");
?>