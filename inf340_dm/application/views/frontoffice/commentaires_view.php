<h2>Commentaires</h2>
<table border=1>
	<?php foreach($commentaires as $commentaire) :?>
	<tr>
		<!-- Pseudo de la personne qui a posté un commentaire -->
		<td><?php echo $commentaire->getUtilisateur()->getLogin();?></td>
		<!-- Le commentaire -->
		<td><?php echo $commentaire->getData()?></td>
		<!-- Bouton suppression si l'utilisateur est l'auteur du commentaire ou si c'est un admin ou modo -->
		<td><?php if(isset($utilisateur))
			if($utilisateur->getId()==$commentaire->getUtilisateur()->getId() || $utilisateur->getLevel()>0)
				echo "supprimer";?>
		</td>
	</tr>
	<?php endforeach;?>
</table>