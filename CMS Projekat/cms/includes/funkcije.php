<?php
function redirect_to($nova_lokacija)
{
    header("Location: " . $nova_lokacija);
    exit;
}

function mysql_prep($string)
{
    global $connection;
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

function confirm_query($result_set)
{
    if (!result_set) {
        die("Database query failed.<br />");
    }
}

//funkicja za greske u formama
function form_errors($errors = array())
{
    $rezultat = "";
    if (!empty($errors)) {
        $rezultat = "<div class=\"error\">";
        $rezultat .= "Molimo vas ispravite sledece greske:";
        $rezultat .= "<ul>";
        foreach ($errors as $key => $error) {
            $rezultat .= "<li>";
            $rezultat .= htmlentities($error);
            $rezultat .= "</li>";
        }
        $rezultat .= "<ul>";
        $rezultat .= "</div>";
    }
    return $rezultat;
}

function pronadji_sve_naslove($public = true)
{
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM naslovi ";
    if ($public) {
        $query .= "WHERE vidljivost=1 ";

    }

    $query .= "ORDER BY pozicija ASC ";

    $naslov_podesen = mysqli_query($connection, $query);
    confirm_query($naslov_podesen);
    return $naslov_podesen;
}

function pronadji_stranice_za_naslov($naslov_id, $public = true)
{
    global $connection;

    $safe_naslov_id = mysqli_real_escape_string($connection, $naslov_id);

    $query = "SELECT * ";
    $query .= "FROM stranice ";
    $query .= "WHERE naslov_id = {$safe_naslov_id} ";
    if ($public) {
        $query .= "AND vidljivost=1 ";
    }
    $query .= "ORDER BY pozicija ASC ";

    $stranice_set = mysqli_query($connection, $query);
    confirm_query($stranice_set);
    return $stranice_set;
}

//Navigaciji su potrebna dva argumenta...
//Trenutni niz naslova ili null
//Trenutni niz stranica ili null
function navigation($naslov_niz, $stranice_array)
{
    $rezultat = "<ul class=\"naslovi\"> ";
    $naslov_podesen = pronadji_sve_naslove(false);
    while ($naslov = mysqli_fetch_assoc($naslov_podesen)) {

        $rezultat .= "<li";
        if ($naslov_niz && $naslov["id"] == $naslov_niz["id"]) {
            $rezultat .= " class=\"selected\"";
        }
        $rezultat .= ">";

        $rezultat .= "<a href=\"upravljanje_sadrzajem.php?naslov=";
        $rezultat .= urlencode($naslov["id"]);
        $rezultat .= "\">";
        $rezultat .= htmlentities($naslov["naziv_menija"]);
        $rezultat .= "</a>";
        $stranice_set = pronadji_stranice_za_naslov($naslov["id"], false);
        $rezultat .= "<ul class=\"stranice\">";

        while ($stranice = mysqli_fetch_assoc($stranice_set)) {
            $rezultat .= "<li";
            if ($stranice_array && $stranice["id"] == $stranice_array["id"]) {
                $rezultat .= " class=\"selected\"";
            }
            $rezultat .= ">";

            $rezultat .= "<a href=\"upravljanje_sadrzajem.php?stranice=";
            $rezultat .= urlencode($stranice["id"]);
            $rezultat .= "\">";
            $rezultat .= htmlentities($stranice["naziv_menija"]);
            $rezultat .= "</a></li>";
        }
        mysqli_free_result($stranice_set);

        $rezultat .= "</ul></li>";
    }

    mysqli_free_result($naslov_podesen);
    $rezultat .= "</ul>";
    return $rezultat;
}

function public_navigation($naslov_niz, $stranice_array)
{
    $rezultat = "<ul class=\"naslovi\"> ";
    $naslov_podesen = pronadji_sve_naslove();
    while ($naslov = mysqli_fetch_assoc($naslov_podesen)) {

        $rezultat .= "<li";
        if ($naslov_niz && $naslov["id"] == $naslov_niz["id"]) {
            $rezultat .= " class=\"selected\"";
        }
        $rezultat .= ">";

        $rezultat .= "<a href=\"index.php?naslov=";
        $rezultat .= urlencode($naslov["id"]);
        $rezultat .= "\">";
        $rezultat .= htmlentities($naslov["naziv_menija"]);
        $rezultat .= "</a>";

        if ($naslov_niz["id"] == $naslov["id"] ||
            $stranice_array["naslov_id"] == $naslov["id"]
        ) {


            $stranice_set = pronadji_stranice_za_naslov($naslov["id"]);
            $rezultat .= "<ul class=\"stranice\">";

            while ($stranice = mysqli_fetch_assoc($stranice_set)) {
                $rezultat .= "<li";
                if ($stranice_array && $stranice["id"] == $stranice_array["id"]) {
                    $rezultat .= " class=\"selected\"";
                }
                $rezultat .= ">";

                $rezultat .= "<a href=\"index.php?stranice=";
                $rezultat .= urlencode($stranice["id"]);
                $rezultat .= "\">";
                $rezultat .= htmlentities($stranice["naziv_menija"]);
                $rezultat .= "</a></li>";
            }
            $rezultat .= "</ul>";
            mysqli_free_result($stranice_set);
        }

        $rezultat .= "</li>";//kraj naslova
    }

    mysqli_free_result($naslov_podesen);
    $rezultat .= "</ul>";
    return $rezultat;
}

function pronadji_naslov_by_id($naslov_id, $public = true)
{
    global $connection;

    $safe_naslov_id = mysqli_real_escape_string($connection, $naslov_id);

    $query = "SELECT * ";
    $query .= "FROM naslovi ";
    $query .= "WHERE id={$safe_naslov_id} ";
    if ($public) {
        $query .= "AND vidljivost=1 ";
    }
    $query .= "LIMIT 1 ";

    $naslov_podesen = mysqli_query($connection, $query);
    confirm_query($naslov_podesen);
    if ($naslov = mysqli_fetch_assoc($naslov_podesen)) {
        return $naslov;
    } else {
        return null;
    }

}

function pronadji_stranice_by_id($stranice_id, $public = true)
{
    global $connection;

    $safe_stranice_id = mysqli_real_escape_string($connection, $stranice_id);

    $query = "SELECT * ";
    $query .= "FROM stranice ";
    $query .= "WHERE id={$safe_stranice_id} ";
    if ($public) {
        $query .= "AND vidljivost=1 ";
    }
    $query .= "LIMIT 1 ";

    $stranice_set = mysqli_query($connection, $query);
    confirm_query($stranice_set);
    if ($stranice = mysqli_fetch_assoc($stranice_set)) {
        return $stranice;
    } else {
        return null;
    }

}

function pronadji_default_stranice_za_naslov($naslov_id)
{
    $stranice_set = pronadji_stranice_za_naslov($naslov_id);
    if ($first_stranice = mysqli_fetch_assoc($stranice_set)) {
        return $first_stranice;
    } else {
        return null;
    }
}

function pronadji_odabrane_stranice($public = false)
{
    global $trenutni_stranice;
    global $trenutni_naslov;

    if (isset($_GET["naslov"])) {
        $trenutni_naslov = pronadji_naslov_by_id($_GET["naslov"], $public);
        $trenutni_stranice = pronadji_default_stranice_za_naslov($trenutni_naslov["id"]);

    } elseif (isset($_GET["stranice"])) {
        $trenutni_stranice = pronadji_stranice_by_id($_GET["stranice"], $public);
        $trenutni_naslov = null;
    } else {
        $trenutni_stranice = null;
        $trenutni_naslov = null;
    }
}

function pronadji_sve_administratore()
{
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY username ASC";

    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function pronadji_administratora_by_id($admin_id)
{
    global $connection;

    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);

    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id={$safe_admin_id} ";
    $query .= "LIMIT 1";

    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }

}

function pronadji_administratora_by_username($username)
{
    global $connection;

    $safe_username = mysqli_real_escape_string($connection, $username);

    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username='{$safe_username}' ";
    $query .= "LIMIT 1";

    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }

}

function password_encrypt($password)
{

    $hash_format = "$2y$10$"; //govori PHP-u da koristi Blowfish sa "cost" od 10
    $salt_length = 22;        //Blowfish salt data bi trebalo da bude 22 karaktera ili vise
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash = crypt($password, $format_and_salt);
    return $hash;
}

function generate_salt($length)
{
    //MD5 vraca 32 karaktera
    $unique_random_string = md5(uniqid(mt_rand(), true));

    //validni karakteri za salt su [a-zA-Z0-9./]
    $base64_string = base64_encode($unique_random_string);

    //ali ne i '+' koji je baziran na base64
    $modified_base64_string = str_replace('+', '.', $base64_string);

    //skracuje string na pravilnu duzinu
    $salt = substr($modified_base64_string, 0, $length);

    return $salt;
}

function password_check($password, $existing_hash)
{
    //postojeci hash sadrzi formatiranje i salt sa pocetka
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {
        return true;
    } else {
        return false;
    }
}

/*Za logovanje je potrebno uporIzmenii da li postoji kombinacije unetog imena i sifre u bazi podataka
Prvo cemo proveriti da li postoji korisnicko ime i ako ga nadjemo onda uzimamo $existing_hash i poredimo ga sa unetom sifrom
$existing_hash se nalazi u bazi podataka i predstavlja zasticenu sifru
Ukoliko ne pronadjemo korisnika login je neuspesan ili ukoliko se sifre ne poklapaju login je takodje neuspesan*/
function attempt_login($username, $password)
{
    $admin = pronadji_administratora_by_username($username);
    if ($admin) {
        //admin je pronadjen...sada treba da proverimo sifru
        if (password_check($password, $admin["hashed_password"])) {
            //sifra se poklapa
            return $admin;
        } else {
            //sifra se ne poklapa
            return false;
        }
    } else {
        //admin nije pronadjen i vracamo false
        return false;
    }
}

//funkcija kojom vracamo admin_id iz session ako je korisnik ulogovan
//upotrebljavamo je ispod u confirm_logged_in() funkciji
function logged_in()
{
    return isset($_SESSION['admin_id']);
}

//funkcija kojom potvrdjujemo/proveravamo da lie je korisnik ulogovan
function confirm_logged_in()
{
    //ako nije nista postavljeno za admin_id onda korisnik nije ulogovan
    //ovako proveravamo da li je korisnik ulogovan tj. nije
    if (!logged_in()) {
        //ako korisnik nije ulogovan onda redirekcija
        redirect_to("login.php");
    }
}

?>