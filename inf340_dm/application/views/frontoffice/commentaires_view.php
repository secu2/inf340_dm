<h2>Commentaires</h2>
<table border=1>
	<?php foreach($commentaires as $commentaire) :?>
	<tr>
		<!-- Pseudo de la personne qui a poste un commentaire -->
		<td><em><?php echo $commentaire->getUtilisateur()->getLogin();?>:</em></td>
		<!-- La date -->
		<td><?php echo "date"; ?></td>
		<!-- Le commentaire -->
		<td><?php echo $commentaire->getData(); ?></td>
		<!-- La note -->
		<td><?php echo $commentaire->getNote(); echo " / 10"; ?></td>
		<!-- Bouton suppression si  : -->
		<!-- - l'utilisateur est l'auteur du commentaire -->
		<!-- - l'utilisateur est un modo (mais il ne peut pas supprimer les commentaires de l'admin -->
		<!-- - l'utilisateur est admin -->
		<?php if(isset($utilisateur))
			if($utilisateur->getId()==$commentaire->getUtilisateur()->getId() || $utilisateur->getLevel()>0 && $commentaire->getUtilisateur()->getLevel()<2)
				echo "<td>supprimer</td>";?>
	</tr>
	<?php endforeach;?>
</table>
	<form action="<?php echo site_url('user/');?>">
		<?php if(isset($utilisateur)){ ?>
			<input type="text" value="Participez a la discussion" class="commentaire" size="100"></input>
			<input type="submit" value="Commenter">
		<?php }else{ ?>
			Veuillez vous <a href=<?php echo site_url('user/');?>>connecter</a> ou vous <a href=<?php echo site_url('user/register');?>>inscrire</a> pour laisser un commentaire.
		<?php } ?>
	</form>