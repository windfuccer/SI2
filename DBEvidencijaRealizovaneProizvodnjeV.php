<?php
class DBEvidencijaRealizovaneProizvodnje extends Tabela 
// rad sa pogledom
{

// METODE

// konstruktor

public function DajSvePodatkeOEvidencijiProizvodnje($filterParametar)
{
	if (isset($filterParametar))
	{
		// nad pogledom se moze dodati filter, jer se pogled koristi kao da je tabela
		$upit="select * from `".$this->NazivBazePodataka."`.`SviPodacioEvidencijiRealizovaneProizvodnje` where `MestoProizvodnje`='".$filterParametar."'";
	}
	else
	{
		$upit="select * from `".$this->NazivBazePodataka."`.`SviPodacioEvidencijiRealizovaneProizvodnje`";
	}
	$this->UcitajSvePoUpitu($upit);
	// sada raspolazemo sa:
	//$this->Kolekcija 
	//$this->BrojZapisa
}


}
?>