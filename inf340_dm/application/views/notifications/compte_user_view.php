<h2>Votre compte</h2>
<!-- L'utilisateur peut modifier son login et son mot de passe -->
<table>
	<tr>
		<th>Login</th>
		<td><?php echo form_input('username',$utilisateur->getLogin());?></td>
	</tr>
	<tr>
		<th>Mot de passe</th>
		<td><?php echo form_password('password', $utilisateur->getLogin());?></td>
	</tr>
	<tr>
		<th>Nombre de commentaires</th>
		<td><?php ?></td>
	</tr>
</table>