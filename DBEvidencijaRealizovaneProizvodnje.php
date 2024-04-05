<?php
class DBEvidencijaRealizovaneProizvodnje extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $IdProizvodnje;
public $NazivProizvodnje;
public $MestoProizvodnje;
public $BrojProizvodnihObjekata;
public $IdProizvodjaca;

// METODE

// konstruktor

public function DajKolekcijuSvihEvidencijaProizvodnje()
{
$SQL = "select * from `EvidencijaRealizovaneProizvodnje` ORDER BY MestoProizvodnje ASC";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function UcitajEvidencijuPoIdProizvodnje($IdProizvodnjeParametar)
{
$SQL = "select * from `EvidencijaRealizovaneProizvodnje` where `IdProizvodnje`='".$IdProizvodnjeParametar."'";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
// raspolazemo sa:
// $Kolekcija;
//  $BrojZapisa;
}

public function DodajNovuEvidenciju()
{
	$SQL = "INSERT INTO `EvidencijaRealizovaneProizvodnje`(IdProizvodnje, NazivProizvodnje, MestoProizvodnje, BrojProizvodnihObjekata, IdProizvodjaca) VALUES ('$this->IdProizvodnje', '$this->NazivProizvodnje', '$this->MestoProizvodnje', '$this->BrojProizvodnihObjekata', '$this->IdProizvodjaca')";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}



public function ObrisiEvidenciju($IdProizvodnjeZaBrisanje)
{
	$SQL = "DELETE FROM `EvidencijaRealizovaneProizvodnje` WHERE IdProizvodnje='".$IdProizvodnjeZaBrisanje."'";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

// TO DO

public function IzmeniEvidenciju($StariIdProizvodnje, $idProizvodnje, $nazivProizvodnje, $mestoProizvodnje, $brojProizvodnihObjekata, $idProizvodjaca)
{
	$SQL = "UPDATE `EvidencijaRealizovaneProizvodnje` SET IdProizvodnje='".$idProizvodnje."', NazivProizvodnje='".$nazivProizvodnje."',MestoProizvodnje='".$mestoProizvodnje."', BrojProizvodnihObjekata='".$brojProizvodnihObjekata."', IdProizvodjaca='".$idProizvodjaca."' WHERE IdProizvodnje='".$StariIdProizvodnje."'";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

// ostale metode 




}
?>