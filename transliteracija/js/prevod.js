//Latinica u cirilicu
function prevedi_u_lat(rec) {
    var slovo = {};
    var prevod = '';
    //VELIKA SLOVA
    slovo["А"] = "A";
    slovo["Б"] = "B";
    slovo["В"] = "V";
    slovo["Г"] = "G";
    slovo["Д"] = "D";
    slovo["Ђ"] = "Đ";
    slovo["Е"] = "E";
    slovo["Ж"] = "Ž";
    slovo["З"] = "Z";
    slovo["И"] = "I";
    slovo["Ј"] = "J";
    slovo["К"] = "K";
    slovo["Л"] = "L";
    slovo["Љ"] = "Lj";
    slovo["М"] = "M";
    slovo["Н"] = "N";
    slovo["Њ"] = "Nj";
    slovo["О"] = "O";
    slovo["П"] = "P";
    slovo["Р"] = "R";
    slovo["С"] = "S";
    slovo["Т"] = "T";
    slovo["Ћ"] = "Ć";
    slovo["У"] = "U";
    slovo["Ф"] = "F";
    slovo["Х"] = "H";
    slovo["Ц"] = "C";
    slovo["Ч"] = "Č";
    slovo["Џ"] = "Dž";
    slovo["Ш"] = "Š";
    //mala slova
    slovo["а"] = "a";
    slovo["б"] = "b";
    slovo["в"] = "v";
    slovo["г"] = "g";
    slovo["д"] = "d";
    slovo["ђ"] = "đ";
    slovo["е"] = "e";
    slovo["ж"] = "ž";
    slovo["з"] = "z";
    slovo["и"] = "i";
    slovo["ј"] = "j";
    slovo["к"] = "k";
    slovo["л"] = "l";
    slovo["љ"] = "lj";
    slovo["м"] = "m";
    slovo["н"] = "n";
    slovo["њ"] = "nj";
    slovo["о"] = "o";
    slovo["п"] = "p";
    slovo["р"] = "r";
    slovo["с"] = "s";
    slovo["т"] = "t";
    slovo["ћ"] = "ć";
    slovo["у"] = "u";
    slovo["ф"] = "f";
    slovo["х"] = "h";
    slovo["ц"] = "c";
    slovo["ч"] = "č";
    slovo["џ"] = "dž";
    slovo["ш"] = "š";

    for (var i = 0; i < rec.length; i++) {
        var karakter = rec.charAt(i);
        prevod += slovo[karakter] || karakter;
    }
    return prevod;
}

function zameni_u_lat(tekst) {
    var str = tekst;

    str = str.replace(/Џ/g, "DŽ");
    str = str.replace(/Џ/g, "Dž");
    str = str.replace(/џ/g, "dž");

    str = str.replace(/Љ/g, "Lj");
    str = str.replace(/Љ/g, "LJ");
    str = str.replace(/љ/g, "lj");

    str = str.replace(/Њ/g, "Nj");
    str = str.replace(/Њ/g, "NJ");
    str = str.replace(/њ/g, "nj");

    return str;
}


//Cirilica u latinicu
function prevedi_u_cir(rec) {
    var slovo = {};
    var prevod = '';
    //VELIKA SLOVA
    slovo["А"] = "А";
    slovo["B"] = "Б";
    slovo["V"] = "В";
    slovo["G"] = "Г";
    slovo["D"] = "Д";
    slovo["Đ"] = "Ђ";
    slovo["E"] = "Е";
    slovo["Ž"] = "Ж";
    slovo["Z"] = "З";
    slovo["I"] = "И";
    slovo["J"] = "Ј";
    slovo["K"] = "К";
    slovo["L"] = "Л";
    slovo["Lj"] = "Љ";
    slovo["M"] = "М";
    slovo["N"] = "Н";
    slovo["Nj"] = "Њ";
    slovo["O"] = "О";
    slovo["P"] = "П";
    slovo["R"] = "Р";
    slovo["S"] = "С";
    slovo["T"] = "Т";
    slovo["Ć"] = "Ћ";
    slovo["U"] = "У";
    slovo["F"] = "Ф";
    slovo["H"] = "Х";
    slovo["C"] = "Ц";
    slovo["Č"] = "Ч";
    slovo["Dž"] = "Џ";
    slovo["Š"] = "Ш";
    //mala slova
    slovo["a"] = "а";
    slovo["b"] = "б";
    slovo["v"] = "в";
    slovo["g"] = "г";
    slovo["d"] = "д";
    slovo["đ"] = "ђ";
    slovo["e"] = "е";
    slovo["ž"] = "ж";
    slovo["z"] = "з";
    slovo["i"] = "и";
    slovo["j"] = "ј";
    slovo["k"] = "к";
    slovo["l"] = "л";
    slovo["lj"] = "љ";
    slovo["m"] = "м";
    slovo["n"] = "н";
    slovo["nj"] = "њ";
    slovo["o"] = "о";
    slovo["p"] = "п";
    slovo["r"] = "р";
    slovo["s"] = "с";
    slovo["t"] = "т";
    slovo["ć"] = "ћ";
    slovo["u"] = "у";
    slovo["f"] = "ф";
    slovo["h"] = "х";
    slovo["c"] = "ц";
    slovo["č"] = "ч";
    slovo["dž"] = "џ";
    slovo["š"] = "ш";

    for (var i = 0; i < rec.length; i++) {
        var karakter = rec.charAt(i);
        prevod += slovo[karakter] || karakter;
    }
    return prevod;
}

function zameni_u_cir(tekst) {
    var str = tekst;

    str = str.replace(/DŽ/g, "Џ");
    str = str.replace(/Dž/g, "Џ");
    str = str.replace(/dž/g, "џ");

    str = str.replace(/Lj/g, "Љ");
    str = str.replace(/LJ/g, "Љ");
    str = str.replace(/lj/g, "љ");

    str = str.replace(/Nj/g, "Њ");
    str = str.replace(/NJ/g, "Њ");
    str = str.replace(/nj/g, "њ");

    return str;
}

// Jotovanje je glasovna promena u kojoj se sonant J spaja sa suglasnicima ispred sebe koji nisu prednjonepčani suglasnici (Z, S, D, T, N, L, K G, H) i na taj način daje prednjonepčane suglasnike (Ž, Š, Đ, Ć, NJ, LJ, Č).

// Primer: VEŽEM

// vezati – vez + jem – vezjem – vežem

// Kada se sonant J nađe ispred usnenih suglasnika B, P, V, M ne stapa se sa njima, već prelazi u samoglasnik LJ, pa dobijamo grupe BLJ, PLJ, MLJ i VLJ:

// Primer: GLUPLJI

// glup – glup + ji – glupji – gluplji

// Jotovanje se javlja u sledećim slučajevima:

//  Komperativ prideva

// Primer:  CRNJI

// crn + JI – crnJI – crnji

//  Prezent pojedinih glagola

// Primer:  HRAMLJEM

// hramati – hram + jem – hramjem – hramljem

// Kod glagola čija se prezentska osnova završava na K, G, H,  ako glagol ostaje nepromenjen u trećem licu množine prezenta izvršena glasovna promena je palatalizacija.  U ostalim  slučajevima  izvršeno je jotovanje.

// Primer: PEČEM

// JA pečem – ONI peku.  (Izvršena glasovna poromena je palatalizacija)

// Primer: PEČEM

// JA stružem – ONI stružu. (Izvršena glasovna poromena je jotovanje)

//  Trpni pridev pojedinih glagola

// Primer: VOLJEN

// voleti – vol+ jen – voljen

//   Instrumental jednine imenica ženskog roda koje se završavaju na suglasnik

// Primer: GLAĐU

// glad – glad+ ju – glađu

//   U izvedenim rečima

// Primer: CVEĆE

// cvet – cvet + je – cveće



//  zvezdica  Jotovanje i druge glasovne promene
// Često su u rečima u kojima je izvršeno jotovanje izvršene  i druge glasovne promene:

// 1) jednačenje suglasnika po zvučnosti, gubitak suglasnika, jotovanje

// Primer: ISITNJEN

// iz + sitniti  – izsitniti  – isitniti –  isitn + jen – isitnjen

// 2)  jednačenje suglasnika po zvučnosti, jednačenje suglasnika po mestu tvorbe, jotovanje

// Primer: IŠČAŠENJE

// iz + čašiti  – izčašiti  – ižčašiti –  iščašiti – iščašenje

// 3) jotovanje, jednačenje suglasnika po mestu tvorbe

// Primer: GOŠĆA

// gost + ja – gostja – gosća –  gošća



//       Ne pravi greške kod komperativa prideva!
//  strog + JI –  stroži         Nepravilno:   strožiji

//  besan + JI – bešnji        Nepravilno:   besniji

//  tesan + JI – tešnji         Nepravilno:   tesniji

//  visok + JI – viši             Nepravilno:   visočiji