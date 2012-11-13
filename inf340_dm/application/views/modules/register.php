<?php
	$this->load->helper('form');

	echo validation_errors();
	echo form_open('/user/register'); ?>

	<h1> Inscrivez-vous</h1>
		<form>
		Nom d'utilisateur: <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="20" /> <br />
		Mot de passe: <input type="password" name="password" value="" size="20" /> <br />
		Confirmer mot de passe: <input type="password" name="password_verify" value="" size="20" /> <br />
		<input type="submit" value="Submit" />
		</form>
<hr>
