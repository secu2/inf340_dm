<h2>Commentaires</h2>
<table border=1>
	<?php foreach($commentaires as $commentaire) :?>
	<tr>
		<!-- Pseudo de la personne qui a poste un commentaire -->
		<td><em><?php echo $commentaire->getUtilisateur()->getLogin();?>:</em></td>
		<?php $commentaire_data = $commentaire->getData(); ?>
		<!-- Le commentaire -->
		<td><?php echo $commentaire_data[1]; ?></td>
		<!-- La date -->
		<td><?php echo $commentaire_data[0]; ?></td>
		<!-- La note -->
		<td><?php echo $commentaire_data[2].'/10'; ?></td>
		<!-- Bouton suppression si l'utilisateur est l'auteur du commentaire ou si c'est un admin ou modo -->
		<?php if(isset($utilisateur))
			if($utilisateur->getId()==$commentaire->getUtilisateur()->getId() || $utilisateur->getLevel()>0)
				echo "<td>supprimer</td>";
			elseif ($utilisateur->getLevel()==1 && $commentaire->getUtilisateur()->getLevel()<2)
				echo "<td>supprimer</td>";
			elseif ($utilsiateur->getLevel()==2)
				echo "<td>supprimer</td>";?>
	</tr>
</table>
	<?php endforeach;?>
	<form action="<?php echo site_url('user/');?>">
		<?php if(isset($utilisateur)){ ?>
			<input type="text" value="Participez a la discussion" class="commentaire" size="100"></input>
			<input type="submit" value="Commenter">
		<?php }else{ ?>
			Veuillez vous <a href=<?php echo site_url('user/');?>>connecter</a> ou vous <a href=<?php echo site_url('user/register');?>>inscrire</a> pour laisser un commentaire.
		<?php } ?>
	</form>