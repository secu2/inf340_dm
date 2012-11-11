<!-- Affiche la liste complète des galeries -->
<h1>Les stations</h1>
<!-- Cliquer sur le nom d'une station envoie vers sa fiche -->
<?php foreach($stations as $station) :?>
<table>
	<tr>
		<!-- Nom de la station -->
		<th><?php echo $station->getNom();?></th>
	</tr>
	<tr>
		<!-- Photo de la station -->
		<td><?php echo 'photo'?></td>
	</tr>
</table>
<?php endforeach;?>
<hr>