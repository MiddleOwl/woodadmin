<?php $title = "Portail administrateur"; ?>

<?php ob_start(); ?>
    <?php include(dirname(__FILE__)."/../includes/nav.php"); ?>
<?php $nav = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php 
        echo("<div id='welcome'>Bienvenue sur le portail admin !</div>");
	?>
	<div id="tableauDeBord">
		<div id="contratsATraiter">
		
		<p> Vous avez une action requise pour les contrats suivants: </p>
			<table>
				<thead>
					<th>Numéro du contrat à traiter</th>
					<th>Woodien titulaire</th>
					<th>Nature de l'alerte</th>
				</thead>
				<tbody>
				 <?php
					// foreach($contratsATraiter as $cAT){
					
						// echo("
						
							// <tr><td>".$cAT['numContrat']."</td>
							// <td>".$cAT['idWoodien']."</td></tr>
							
						// ");
					// };
				// ?>
				</tbody>
			</table>
		</div>
	</div>
<?php $content = ob_get_clean(); ?>

<?php include(dirname(__FILE__)."/../templates/template.php"); ?>