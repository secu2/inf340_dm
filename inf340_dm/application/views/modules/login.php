<h1> Connexion </h1>

<?php 
	$this->load->helper('form');
	echo form_open('/user/verify');
	echo form_input('username', 'Utilisateur');
	echo form_password('password', 'Mot de Passe');
	echo form_submit('submit','Connexion');
	echo form_close();
?>
