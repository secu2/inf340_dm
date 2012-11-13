<!-- Si l'utilisateur est un admin, la liste des utilisateurs sera affich�e sur son profil -->
<!-- Il pourra ainsi supprimer des utilisateurs, les nommer mod�rateurs, ou les r�trograder -->
<h2>Gestion des utilisateurs</h2>
<table>
	<?php foreach ($utilisateurs as $utilisateur) :?>
	<tr>
		<!-- Login -->
		<td><?php echo $utilisateur -> getLogin();?></td>
		<!-- Si c'est un utlisateur normal, on ajoute un bouton "nommer mod�rateur" -->
		<!-- Si c'est un mod�rateur, on ajoute un bouton "r�trograder" -->
		<td>
			<?php if($utilisateur->getLevel()==0)
				echo 'nommer mod�rateur';
			else
				echo 'r�trograder';?>
		</td>
		<!-- Bouton "supprimer utilisateur" -->
		<td><?php echo 'supprimer';?></td>
	</tr>
	<?php endforeach;?>
</table>