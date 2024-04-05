<?php
class DBEvidencijaRealizovaneProizvodnje extends Tabela 
// rad sa stored procedurom za snimanje novog studenta
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

public function DodajEvidenciju()
{

	
	
		$GreskarezultatPar1 = $this->IzvrsiAktivanSQLUpit ("SET @IdProizvodnjeParametar='".$this->IdProizvodnje."'");
		
		$GreskarezultatPar2 = $this->IzvrsiAktivanSQLUpit ("SET @NazivProizvodnjeParametar='".$this->NazivProizvodnje."'");
		
		$GreskarezultatPar3 = $this->IzvrsiAktivanSQLUpit ("SET @MestoProizvodnjeParametar='".$this->MestoProizvodnje."'");
		
		$GreskarezultatPar4 =  $this->IzvrsiAktivanSQLUpit ("SET @BrojProizvodnihObjekataParametar='".$this->BrojProizvodnihObjekata."'");
		
		$GreskarezultatPar5 = $this->IzvrsiAktivanSQLUpit (  "SET @IdProizvodjacaParametar='".$this->IdProizvodjaca."'");
		
		$GreskarezultatCall = $this->IzvrsiAktivanSQLUpit ( "CALL `DodajEvidenciju`(@IdProizvodnjeParametar, @NazivProizvodnjeParametar, @MestoProizvodnjeParametar, @BrojProizvodnihObjekataParametar,@IdProizvodjacaParametar);");
		 
	
	$greska=$GreskarezultatPar1.$GreskarezultatPar2.$GreskarezultatPar3.$GreskarezultatPar4.$GreskarezultatPar5.$GreskarezultatCall;
	return $greska;
}


}
?>