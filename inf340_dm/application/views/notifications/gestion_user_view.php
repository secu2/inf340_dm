<!-- Si l'utilisateur est un admin, la liste des utilisateurs sera affich�e sur son profil -->
<!-- Il pourra ainsi supprimer des utilisateurs, les nommer mod�rateurs, ou les r�trograder -->
<h2>Gestion des utilisateurs</h2>
<table id="membres">
	<?php foreach ($utilisateurs as $utilisateur) :?>
	<tr>
		<!-- Login -->
		<td><?php echo $utilisateur -> getLogin();?></td>
		<!-- Si c'est un utlisateur normal, on ajoute un bouton "nommer mod�rateur" -->
		<!-- Si c'est un mod�rateur, on ajoute un bouton "r�trograder" -->
		<!-- Un admin ne peut pas se retrograder -->
		<td>
			<?php if ($utilisateur->getLevel()!=2)
				{if($utilisateur->getLevel()==0){?>
					<a href=<?php echo site_url(''); echo "user/change_level/"; echo $utilisateur->getId(); echo "/1";?>>Nommer mod�rateur</a>
				<?php }else{?>
					<a href=<?php echo site_url(''); echo "user/change_level/"; echo $utilisateur->getId(); echo "/0";?>>R�trograder</a>
		</td>
		<!-- Bouton "supprimer utilisateur" sauf si c'est un admin -->
		<?php }}if($utilisateur->getLevel()!=2){?>
				<td><a href=<?php echo site_url(''); echo "user/delete/"; echo $utilisateur->getId()+"";?>>Supprimer</a></td>
	</tr>
	<?php }endforeach;?>
</table>