<?php
//Denne filen inneholder funksjoner som brukes


//Denne funksjonen brukes for å lage 'form' i registrerSanger.php
function lagSangForm($antall){
    $r=1;
    while($r<=$antall){
        print("<h2>Spor nr. $r</h2>
        Sangtittel<input type='text' name='tittel$r' value='sang$r'> <br>
        Lengde <input type='text' name='lengde$r' value='lengde$r'> <br>
        ISRC <input type='text' name='isrc$r' value='isrc$r'> <br>");

        $r++;
    }

}

//Denne functionen lar deg pushe assosiativt til et array
function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
    }




//-----------------------------------------------------------------------------------------------------
//Denne funksjonen genererer sporbokser til albumsiden
function genererSpor($album){

    //--------------------Finner informasjon om albumet
    include("dbTilkobling.php");
    $sqlSELECT="SELECT * FROM Album WHERE Album.AlbumNavn='$album';";
    $resultat=mysqli_query($db, $sqlSELECT);
    $rad=mysqli_fetch_array($resultat);

    $antallSpor=$rad["AntallSpor"];
    $albumNr=$rad["AlbumNr"];


    //---------------------Finner informasjon om sporene
    $sqlSpor="SELECT * FROM Spor WHERE Spor.AlbumNr='$albumNr';";
    $resultatSpor=mysqli_query($db, $sqlSpor);



    //-------------------------Loopen som genererer spor
    for ($r=0;$r<$antallSpor;$r++) {
        $radSpor=mysqli_fetch_array($resultatSpor);

        $sporNr=$r+1;
        $sporNavn=$radSpor["SporNavn"];
        $lengde=$radSpor["Lengde"];
        $isrc=$radSpor["ISRC"];

        print   ("<div class='sporboks'><h2>Spor nr.$sporNr</h2> <br>
                Sportittel <input type='text' value='$sporNavn' name='tittel$sporNr'> <br>
                Lengde<input type='text' value='$lengde' name='lengde$sporNr'><br>
                ISRC<input type='text' value='$isrc' name='isrc$sporNr'><br>
                Lydfil <input type='file' name='fil$sporNr'> <br>");
                
                $link="lydfiler/spor" . $sporNr . "album" . $albumNr .".wav";

            print ("<audio controls> <source src='$link' type='audio/wav'></audio></div>");

                

    }
    //--------------------------

}
//--------------------------------------------------------------------------------------------------------




?>

