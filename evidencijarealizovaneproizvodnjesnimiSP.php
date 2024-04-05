 <?php
        
		//session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   //$idkorisnika=$_SESSION["idkorisnika"];
	   
	      // -------------------------------------
		// UPLOAD FAJLA SLIKE


	   
	   // preuzimanje vrednosti sa forme
	   $IdProizvodnje=$_POST['idProizvodnje'];
	   $NazivProizvodnje=$_POST['nazivProizvodnje'];
	   $MestoProizvodnje=$_POST['mestoProizvodnje'];
	   $BrojProizvodnihObjekata=$_POST['brojProizvodnihObjekata'];
	   $IdProizvodjaca =$_POST['idProizvodjaca'];
	   
	   //KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		//echo "USPESNA KONEKCIJA";
		require "klase/BaznaTransakcija.php";
		$TransakcijaObject = new Transakcija($KonekcijaObject);
		$TransakcijaObject->ZapocniTransakciju();
		
		require "klase/DBEvidencijaRealizovaneProizvodnjeSP.php";
		$EvidencijaObject = new DBEvidencijaRealizovaneProizvodnje($KonekcijaObject, 'EvidencijaRealizovaneProizvodnje');
		$EvidencijaObject->IdProizvodnje=$IdProizvodnje;
		$EvidencijaObject->NazivProizvodnje=$NazivProizvodnje;
		$EvidencijaObject->MestoProizvodnje=$MestoProizvodnje;
		$EvidencijaObject->BrojProizvodnihObjekata=$BrojProizvodnihObjekata;
		$EvidencijaObject->IdProizvodjaca=$IdProizvodjaca;
		$greska1=$EvidencijaObject->DodajEvidenciju();
		
		// inkrement broja studenata kroz klasu DBSmer
        require "klase/DBProizvodjac.php";
		$ProizvodjacObject = new DBProizvodjac($KonekcijaObject, 'Proizvodjac');
		$greska2=$ProizvodjacObject->InkrementirajBrojEvidencijaProizvodnje($IdProizvodjaca);
		
		// zatvaranje transakcije
		//$UtvrdjenaGreska=$greska1 or $greska2;
		$UtvrdjenaGreska=$greska1.$greska2;
		$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
        	
		} // od if db selected

      // ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($UtvrdjenaGreska) {
	echo "Greska $UtvrdjenaGreska";	
     }	
	 else
	 {
		//echo "Snimljeno!";	
		header ('Location:EvidencijaRealizovaneProizvodnjeLista.php');		
	 }
		
	  
      ?>

