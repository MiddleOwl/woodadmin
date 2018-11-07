<?php $title = "Woodien"; ?>

<?php ob_start(); ?>
    <?php include(dirname(__FILE__)."/../includes/nav.php"); ?>
<?php $nav = ob_get_clean(); ?>

<?php ob_start(); ?>
    <section id="flexStart">
        <div id="identity">
                        
            <?php echo "<p id='nomWoodien'>".$woodien['prenom']." ".$woodien['nom']."</p>";?>
			
        </div>
		
		<div class="boutons">

			<form action="index.php?page=woodien&action=editPDF" method="post">
				<input id="createPDF" type="submit" name="createPDF" value="Editer la fiche" />
			</form>
			<input id="deleteWoodien" type="button" name="delete" value="Supprimer"/>
			<input id="updateWoodien" type="button" name="update" value="Enregistrer"/>
			
		</div>
		
		
		
			<div id="etatcivil" class="details">
				<h1>Etat civil</h1>
				
				<div id="blocSection">
					<div id="infosdebase">			
					<h2>Infos de base</h2>
						<p id ="sexe"><strong>Sexe: </strong>
						
							<label for"homme"><input id="homme" class="modif" type="radio" name="sexe" value="homme" <?php if($woodien['sexe']=="homme")echo('checked="checked"');?>/>Homme</label><br />
							<label for"femme"><input id="femme" class="modif" type="radio" name="sexe" value="femme" <?php if($woodien['sexe']=="femme")echo('checked="checked"');?>/>Femme</label><br />
							
						</p>
						
						<p><strong>Prénom: </strong><?php echo("<input id='firstName' class='modif' type=text value=".str_replace(' ','&nbsp;',$woodien['prenom'])."></input>");?></p>
						<p><strong>Nom: </strong><?php echo("<input id='name' class='modif' type=text value=".str_replace(' ','&nbsp;',$woodien['nom'])."></input>");?></p>
						<p><strong>Date de naissance: </strong><?php echo("<input id='dateOfBirth' class='modif' type=date value=".$woodien['dateOfBirth']."></input>");?></p>	
						<p><strong>Lieu de naissance: </strong><?php echo("<input id='lieuDeNaissance' class='modif' type=text value=".$woodien['lieuDeNaissance']."></input>");?></p>
						<p><strong>Situation familiale: </strong>
							<select id="situation" class="modif">
								<?php 
									foreach($situationMatri as $s){
										$selected=($woodien['situationMaritale']==$s['id'])?'selected="selected"':'';
										echo ('<option value="'.$s['nom'].'"'.$selected.'>'.$s['nom'].'</option>');								
									}
								?>					
							</select>						
					</div>
					
					<div id="coordonnées">
						<h2>Coordonnées</h2>
							<p><strong>Adresse: </strong><?php echo("<input id='adresse' class='modif' type= text value=".str_replace(' ','&nbsp;',$woodien['adresse'])."></input>");?></p>
							<p><strong>Code Postal: </strong><?php echo("<input id='codepostal' class='modif' type= text value=".$woodien['codePostal']."></input>");?></p>
							<p><strong>Ville: </strong><?php echo("<input id='ville' class='modif' type= text value=".str_replace(' ','&nbsp;',$woodien['ville'])."></input>");?></p>
							<p><strong>Tel: </strong><?php echo("<input id='tel' class='modif' type= text value=".$woodien['tel']."></input>");?></p>
							<p><strong>Portable: </strong><?php echo("<input id='portable' class='modif' type= text value=".$woodien['portable']."></input>");?></p>
					</div>
					
					<div id="autres">
						<h2>Autres</h2>
						<p class="titreParag">Travailleur handicapé:
							
							<label for "Handitrue"><input id="Handitrue" class="modif" type="radio" name="handicap" value="Handitrue"<?php if($woodien['travailleurHandicape']=='Handitrue'){echo('checked="checked"');}?>/>Oui</label>
							<label for "Handifalse"><input id="Handifalse" class="modif" type="radio" name="handicap" value="Handifalse"<?php if($woodien['travailleurHandicape']=='Handifalse'){echo('checked="checked"');}?>/>Non</label>
						
						</p>						
					</div>
				</div>
			</div>
			
			<div id="listesAssociees">
				<div class="details">
					<h2>Enfants à charge</h2>
					<div class="boutons"><a href="index.php?page=enfants&action=create&idWoodien=<?php echo($woodien['id']);?>"><input id="createEnfant" type="button" name="nouveau" value="Nouveau"></input></a></div>
					<div id="bordsarrondis">
						<?php 
							echo("<table>
									<thead>
										<tr>
											<th>Prénom</th>
											<th>Nom</th>
											<th>Date de naissance</th>
										</tr>
									</thead>
									<tbody>");
							foreach($enfants as $e){
								
								$dateDeNaissanceConvertie=conversionDate($e['dateOfBirth']);
								
								echo(
									'<tr>
										<td><a href="index.php?page=enfants&action=read&idWoodien='.$woodien['id'].'&id='.$e['id'].'">'.$e['prenom'].'</a></td>
										<td>'.$e['nom'].'</td>
										<td>'.$dateDeNaissanceConvertie.'</td>
									</tr>'
								);
							}
						?>	
						</tbody>
						</table>
					</div>

				</div>
				<div class="details">
					<h2>Contrats</h2>
					<div class="boutons"><a href="index.php?page=contrat&action=create&idWoodien=<?php echo($woodien['id']);?>"><input id="createContrat" type="button" name="nouveau" value="Nouveau"></input></a></div>
					<div id="bordsarrondis">
						<?php 
							echo("<table>
									<thead>
										<tr>
											<th>Numéro</th>
											<th>Type</th>
											<th>Date de début Contrat</th>
											<th>Date de fin Contrat</th>
											<th>Début Période d'Essai</th>
											<th>Fin Période d'Essai</th>
										</tr>
									</thead>
									<tbody>");
									
								
								foreach($contrats as $c){
									
									$dateDebutContratConvertie = ($c['dateDebut']=='0000-00-00')? '' : conversionDate($c['dateDebut']);
									$dateFinContratConvertie = ($c['dateFin']=='0000-00-00')? '' : conversionDate($c['dateFin']);
									$dateDebutPEConvertie = ($c['debutPeriodeEssai']=='0000-00-00')? '' : conversionDate($c['debutPeriodeEssai']);
									$dateFinPEConvertie = ($c['finPeriodeEssai']=='0000-00-00')? '' : conversionDate($c['finPeriodeEssai']);
									
									echo(							
										'<tr>
											<td><a href="index.php?page=contrat&action=read&id='.$c['id'].'&idWoodien='.$woodien['id'].'">'.$c['numContrat'].'</a></td>								                    
											<td>'.$c['nom'].'</td>                                
											<td>'.$dateDebutContratConvertie.'</td>
											<td>'.$dateFinContratConvertie.'</td>
											<td>'.$dateDebutPEConvertie.'</td>
											<td>'.$dateFinPEConvertie.'</td>
										</tr>'
									);
								}
						?>
						</tbody>
						</table>
					</div>
				</div>
				<div class="details">
					<h2>Qualifications</h2>
					<div id="bordsarrondis">
						<?php
							echo(
									"<table>
										<thead>
											<tr>
												<th>Niveau de qualification</th>
												<th>Profil Performance</th>
												<th>Profil Sisem</th>
											</tr>
										</thead>
										<tbody>");
								foreach($qualifs as $qualif){
								echo(
										"<tr>
											<td>".$qualif['niveauQualification']."</td>
											<td>".$qualif['profilPerformance']."</td>
											<td>".$qualif['profilSisem']."</td>
										</tr>"
									);											
								}
						?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		
    </section>

	
<?php $content = ob_get_clean(); ?>

<?php include(dirname(__FILE__)."/../templates/template.php"); ?>