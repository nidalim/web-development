<?php
$errors = array();

function ime_polja_kao_tekst($ime_polja)
{
    $ime_polja = str_replace("_", " ", $ime_polja);
    $ime_polja = ucfirst($ime_polja);
    return $ime_polja;
}

//Presence
//koristiti trim() da se ne bi racunala prazna polja
//koristiti === da izbegnemo false positive
//koristiti empty() kada smatramo "0" kao prazno
function ima_prisustvo($value)
{
    return isset ($value) && $value !== "";
}

//validacija prisustva
function validacija_prisustva($neophodna_polja)
{
    global $errors;
    foreach ($neophodna_polja as $polje) {
        $value = trim($_POST[$polje]);
        if (!ima_prisustvo($value)) {
            $errors[$polje] = ime_polja_kao_tekst($polje) . " polje ne moze biti prazno";
        }
    }
}

//duzina string
//maksimalna duzina
function maksimalna_duzina($value, $max)
{
    return strlen($value) <= $max;
}

//validacija maksimalne duzine
function validacija_maksimalne_duzine($polja_sa_maksimalnog_duzinom)
{
    global $errors;
    //ocekuje asocijativni niz
    foreach ($polja_sa_maksimalnog_duzinom as $polje => $max) {
        $value = trim($_POST[$polje]);
        if (!maksimalna_duzina($value, $max)) {
            $errors[$polje] = ime_polja_kao_tekst($polje) . " polje je predugo";
        }
    }
}

//ukljucivanje u podesavanjima
function ukljucuje_u($value, $set)
{
    return in_array($value, $set);
}

?>
