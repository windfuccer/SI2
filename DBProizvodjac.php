<?php
class DBProizvodjac extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $Id;
public $Prezime; 
public $Ime;
public $MestoPrebivalista;
public $UkupanBrojEvidencija;

// METODE

// konstruktor

public function UcitajKolekcijuSvihProizvodjaca()
{
$SQL = "select * from `Proizvodjac` ORDER BY Prezime ASC";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
//return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

// inkrement evidencija za proizvodjaca koji se nalazi u bazi
public function InkrementirajBrojEvidencijaProizvodnje($IDProizvodjaca)
{
	
	$KriterijumFiltriranja="Id='".$IDProizvodjaca."'";
	$StaraVrednostUkBrEvidencija=$this->DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojEvidencija', $KriterijumFiltriranja, 'UkupanBrojEvidencija'); 
	
	// izracunavanje nove vrednosti
	$NovaVrednostUkBrEvidencija=$StaraVrednostUkBrEvidencija + 1;
	
	// izvrsavanje izmene
    $SQL = "UPDATE `".$this->NazivBazePodataka."`.`Proizvodjac` SET UkupanBrojEvidencija=".$NovaVrednostUkBrEvidencija." WHERE Id='".$IDProizvodjaca."'";
	$greska= $this->IzvrsiAktivanSQLUpit($SQL);

	return $greska;
	
	}
}

?>