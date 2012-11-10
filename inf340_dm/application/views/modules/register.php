<?php
	$this->load->helper('form');

	echo validation_errors();
	echo form_open('/user/register'); ?>

		Nom d'utilisateur: <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="20" />
		Mot de passe: <input type="password" name="password" value="" size="20" />
		Confirmer Mot de passe: <input type="password" name="password_verify" value="" size="20" />
		<input type="submit" value="Submit" />
		</form>
<hr>
