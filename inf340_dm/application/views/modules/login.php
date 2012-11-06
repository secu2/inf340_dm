<?php 
	$this->load->helper('form');
	echo form_open('/login/verify');
	echo form_input('username', 'Utilisateur');
	echo form_password('password', 'Mot de Passe');
	echo form_submit('submit','Connection');
	echo form_close();
?>
<hr>