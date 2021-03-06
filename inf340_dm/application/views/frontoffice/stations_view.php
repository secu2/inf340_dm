<!-- Affiche la liste complete des galeries -->
<h1>Les stations</h1>
<!-- Cliquer sur le nom d'une station envoie vers sa fiche -->
<?php foreach($stations as $station) :?>
<table border=1 id="tableau">
	<tr>
		<!-- Nom de la station -->
		<th><a href=<?php echo site_url(); echo "station/station_info/"; echo $station->getNom();?>><?php echo $station->getNom();?></a></th>
	</tr>
	<tr>
		<!-- Photo de la station -->
		<td><?php echo 'photo'; ?></td>
	</tr>
	<!-- Si l'utilisateur est un admin, on ajoute le bouton pour supprimer la station -->
	<tr>
		<?php if(isset($utilisateur))
				if($utilisateur->getLevel()==2){?>
					<td><a href=<?php echo site_url(''); echo "station/delete/"; echo $station->getNom();?>>Supprimer</a></td><?php }?>
	</tr>
</table>
<?php endforeach;?>