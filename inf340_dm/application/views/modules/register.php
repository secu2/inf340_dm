<?php 
	// Condition pour récupérer une erreur et le nom d'utilisateur venant d'une tentative précédente
	if(!isset($error_id)){
		// Pas d'erreur, je remplis la variable pour éviter une erreur
		$username = '';
	}
	else{
		// J'ai une erreur, je l'écris au dessus du formulaire
		echo $error_id;
	}
	$this->load->helper('form');
	echo form_open('/user/register');
	echo 'Utilisateur: '.form_input('username', $username); //Je réutilise le nom d'utilisateur
	echo 'Mot de passe: '.form_password('password');
	echo 'Repeter mot de passe: '.form_password('password_verify');
	echo form_submit('submit','S\'inscrire');
	echo form_close();
	
?>
<hr>
