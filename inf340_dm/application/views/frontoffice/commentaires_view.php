<h2>Commentaires</h2>
<table border=1>
	<?php foreach($commentaires as $commentaire) :?>
	<tr>
		<!-- Pseudo de la personne qui a posté un commentaire -->
		<td><?php echo $commentaire->getUtilisateur()->getLogin();?></td>
		<!-- Le commentaire -->
		<td><?php echo $commentaire->getData()?></td>
		<!-- Si l'utilisateur est un admin ou un modo, on ajoute un bouton pour supprimer le commentaire -->
		<?php ?>
		<td><?php ?></td>
		<?php ?>
	</tr>
	<?php endforeach;?>
</table>