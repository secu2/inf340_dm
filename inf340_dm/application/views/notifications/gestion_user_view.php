<!-- Si l'utilisateur est un admin, la liste des utilisateurs sera affichée sur son profil -->
<!-- Il pourra ainsi supprimer des utilisateurs, les nommer modérateurs, ou les rétrograder -->
<h2>Gestion des utilisateurs</h2>
<table>
	<?php foreach ($utilisateurs as $utilisateur) :?>
	<tr>
		<!-- Login -->
		<td><?php echo $utilisateur -> getLogin();?></td>
		<!-- Si c'est un utlisateur normal, on ajoute un bouton "nommer modérateur" -->
		<!-- Si c'est un modérateur, on ajoute un bouton "rétrograder" -->
		<td>
			<?php if($utilisateur->getLevel()==0)
				echo 'nommer modérateur';
			else
				echo 'rétrograder';?>
		</td>
		<!-- Bouton "supprimer utilisateur" -->
		<td><?php echo 'supprimer';?></td>
	</tr>
	<?php endforeach;?>
</table>