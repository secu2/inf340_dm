<!-- Affiche les infos d'une station -->
<h2><?php echo $station->getNom();?></h2>
<table>
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
<h2>Commentaires</h2>
<table>
	<?php ?>
	<tr>
		<!-- Pseudo de la personne qui a posté un commentaire -->
		<td><?php ?></td>
		<!-- Le commentaire -->
		<td><?php ?></td>
		<!-- Si l'utilisateur est un admin ou un modo, on ajoute un bouton pour supprimer le commentaire -->
		<?php ?>
		<td><?php ?></td>
		<?php ?>
	</tr>
	<?php ?>
</table>