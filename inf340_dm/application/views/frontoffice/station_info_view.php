<!-- Affiche les infos d'une station -->
<h2><?php echo $station->getNom();?></h2>
<table border=1>
	<tr>
		<th>D&eacute;partement</th>
		<td><?php echo $station->getDepartement();?></td>
	</tr>
	<tr>
		<th>Photo</th>
		<td><?php echo "photo"?></td>
	</tr>
	<tr>
		<th>Description</th>
		<td><?php echo $station->getDescription();?></td>
	</tr>
</table>