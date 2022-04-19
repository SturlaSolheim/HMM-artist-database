<?php
//Denne filen inneholder funksjoner som brukes

function kunFiltype($filtype){
    
}



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
//WAV fil<input type='file' name='fil$r'><br>


//Denne functionen lar deg pushe assosiativt til et array
function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
    }







?>

