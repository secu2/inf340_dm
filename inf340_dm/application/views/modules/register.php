<?php
	$this->load->helper('form');

	echo validation_errors();
	echo form_open('/user/register'); ?>

	<h1> Inscrivez-vous</h1>
		<form>
		<p>Nom d'utilisateur: <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="20" /></p> <br />
		<p>Mot de passe: <input type="password" name="password" value="" size="20" /></p> <br />
		<p>Confirmer mot de passe: <input type="password" name="password_verify" value="" size="20" /></p> <br />
		<input type="submit" value="Submit" />
		</form>
