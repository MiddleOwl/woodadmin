<?php

	session_start();
	if(isset($_SESSION['prenom'])){//la page n'est accessible qu'aux users connectés
		
		include(dirname(__FILE__).'/../models/salaires.php');
		
		
		switch($_GET['action']){
			case 'create':
				include(dirname(__FILE__).'/../views/salaire.php');
			break;
			case 'insert':
				create_salaire(
					$_POST['annee'],
					$_POST['montant'],
					$_POST['idContrat']
				);
				echo('Le nouveau salaire a été créé');
			break;
			
			case 'read':
				$salaire=get_salaire($_GET['id']);			
				include(dirname(__FILE__).'/../views/salaire.php');
			break;
		}
	}
	else{
		header('Location:index.php');
	}

	
?>