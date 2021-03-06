<h2>Commentaires</h2>
<table border=1 id="commentaires">
	<?php $dejaCommente=false ;
	 foreach($commentaires as $commentaire) :
	 if(isset($utilisateur))
			if($utilisateur->getId()==$commentaire->getUtilisateur()->getId())
	 	      $dejaCommente=true ;
	?>
	<tr>
		<!-- Pseudo de la personne qui a poste un commentaire -->
		<td><em><?php echo $commentaire->getUtilisateur()->getLogin();?>:</em></td>
		<!-- Le commentaire -->
		<td><?php echo $commentaire->getData(); ?></td>
		<!-- La note -->
		<td><?php echo $commentaire->getNote(); echo " / 10"; ?></td>
		<!-- Bouton suppression si  : -->
		<!-- - l'utilisateur est l'auteur du commentaire -->
		<!-- - l'utilisateur est un modo (mais il ne peut pas supprimer les commentaires de l'admin -->
		<!-- - l'utilisateur est admin -->
		<?php if(isset($utilisateur))
			if($utilisateur->getId()==$commentaire->getUtilisateur()->getId() || $utilisateur->getLevel()>0 && $commentaire->getUtilisateur()->getLevel()<2){?>
				<td><a href=<?php echo site_url(''); echo "user/delete_commentaire/"; echo $commentaire->getUtilisateur()->getId(); echo "/"; echo $station->getNom();?>>Supprimer</a></td><?php }?>
	</tr>
	<?php endforeach;?>
</table>

<h2>Ajouter un commentaire</h2>
	<form method='post' action="<?php echo site_url('user/add_commentaire');?>">
		<?php
        if ($dejaCommente)
        {
        	echo "Vous avez déjà commenté cette station, vous ne pouvez pas déposer un second commentaire.";
        }
        else
        {
			if(isset($utilisateur)){ ?>
			<p><input type="hidden" name="nom" value="<?php echo $station->getNom();?>"/></p>
			<p><input type="text" name="data" value="Participez a la discussion" class="commentaire" size="150" id="commentaire"></input></p>
			<p>Mettre une note</p>
			<?php for($i=0; $i<=10; $i++){?>
			<p id="note">
				<input type="radio" name="note" value=<?php echo $i;?> class="commentaire"/><?php echo $i;?>
			</p><?php }?>
			<p><input type="submit" value="Commenter" id="bouton_commentaire"></p>
			<?php }else{ ?>
			Veuillez vous <a href=<?php echo site_url('user/');?>>connecter</a> ou vous <a href=<?php echo site_url('user/register');?>>inscrire</a> pour laisser un commentaire.
			<?php }
        } ?>
	</form>
