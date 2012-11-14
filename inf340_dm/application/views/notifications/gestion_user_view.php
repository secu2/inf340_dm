<!-- Si l'utilisateur est un admin, la liste des utilisateurs sera affich�e sur son profil -->
<!-- Il pourra ainsi supprimer des utilisateurs, les nommer mod�rateurs, ou les r�trograder -->
<h2>Gestion des utilisateurs</h2>
<table id="membres">
	<?php foreach ($users as $user) :?>
	<tr>
		<!-- Login -->
		<td><?php echo $user -> getLogin();?></td>
		<!-- Si c'est un utlisateur normal, on ajoute un bouton "nommer mod�rateur" -->
		<!-- Si c'est un mod�rateur, on ajoute un bouton "r�trograder" -->
		<!-- Un admin ne peut pas se retrograder -->
		<td>
			<?php if ($user->getId()!=$utilisateur->getId())
				{if($user->getLevel()==0){?>
					<a href=<?php echo site_url(''); echo "user/change_level/"; echo $user->getId();?>>Nommer mod&eacute;rateur</a>
				<?php }else{?>
					<a href=<?php echo site_url(''); echo "user/change_level/"; echo $user->getId();?>>R&eacute;trograder</a>
		</td>
		<!-- Bouton "supprimer utilisateur" mais un admin ne peut pas se supprimer lui-même -->
		<?php }}if($user->getId()!=$utilisateur->getId()){?>
				<td><a href=<?php echo site_url(''); echo "user/delete/"; echo $user->getId()+"";?>>Supprimer</a></td>
	</tr>
	<?php }endforeach;?>
</table>