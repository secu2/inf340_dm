<!-- Affiche la liste complète des galeries -->
<h1>Les stations</h1>
<!-- Cliquer sur le nom d'une station envoie vers sa fiche -->
<?php foreach($stations as $station) :?>
<table border=1>
	<tr>
		<!-- Nom de la station -->
		<th><a href=<?php echo site_url(); echo "/welcome/station_info/"; echo $station->getNom();?>><?php echo $station->getNom();?></a></th>
	</tr>
	<tr>
		<!-- Photo de la station -->
		<td><?php echo 'photo'?></td>
	</tr>
</table>
<?php endforeach;?>
<hr>