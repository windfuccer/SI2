 <?php
        
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
	   

	      // -------------------------------------
		// UPLOAD FAJLA SLIKE


	   // preuzimanje vrednosti sa forme
	   $idProizvodnje=$_POST['idProizvodnje'];
	   $StariIdProizvodnje=$_POST['StariIdProizvodnje'];
	   $nazivProizvodnje=$_POST['nazivProizvodnje'];
	   $mestoProizvodnje=$_POST['mestoProizvodnje'];

	   $brojProizvodnihObjekata=$_POST['brojProizvodnihObjekata'];

	   if (isset($_POST['idProizvodjaca']))
	   {
		$idProizvodjaca=$_POST['idProizvodjaca'];
	   }
	   else // ako nije nista promenjeno
	   {
		$StariIdProizvodjaca=$_POST['idProizvodjaca'];
		$idProizvodjaca=$StariIdProizvodjaca;
	   }
	  
	   // koristimo klasu za poziv procedure za konekciju
		require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{	
			require "klase/DBEvidencijaRealizovaneProizvodnje.php";
			$EvidencijaObject = new DBEvidencijaRealizovaneProizvodnje($KonekcijaObject, 'EvidencijaRealizovaneProizvodnje');
			$greska=$EvidencijaObject->IzmeniEvidenciju($StariIdProizvodnje, $idProizvodnje, $nazivProizvodnje, $mestoProizvodnje, $brojProizvodnihObjekata, $idProizvodjaca);
		}
		else
		{
			echo "Nije uspostavljena konekcija ka bazi podataka!";
		}
		
    $KonekcijaObject->disconnect();
	   
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	//echo "Greska $greska";	

	header ('Location:EvidencijaRealizovaneProizvodnjeLista.php');	
		
	  
      ?>

