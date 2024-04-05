<?php
class Postavljanje extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
// METODE

// konstruktor nasledjuje od bazne klase Tabela

public function DaLiJeIspunjenaMesečnaKvotaZaDatiProizvod($KvotaParametar)
{
// incijalizacija promenljive za izlaz
$odgovor="NE";

// izdvajanje ogranicenja iz XML
$xml=simplexml_load_file("klase/".$KvotaParametar.".xml") or die("Nije uspesno ucitavanje fajla sa ogranicenjem!");
$kvota=$xml->kvota;

// izdvajanje koliko trenutno imamo upisanih za tu vrstu signalizacije u bazi podataka
$NazivTrazenogPolja="count(`RBPostavljanja`)";
$KriterijumFiltriranja="`KvotaParametar`='".$KvotaParametar."'";
$KriterijumSortiranja="`RBPostavljanja`"; // nema potrebe da se sortira, ali ne menjamo baznu klasu
$trenutanBrojProizvoda = $this->DajVrednostJednogPoljaPrvogZapisa($NazivTrazenogPolja, $KriterijumFiltriranja, $KriterijumSortiranja); 

// uporedjivanje max i trenutno i odlucivanje
if ($trenutanBrojProizvoda<$kvota)
{
$odgovor="NE";
}
else
{
$odgovor="DA";
}

//vracanje odgovora
return $odgovor;
}


}
?> 