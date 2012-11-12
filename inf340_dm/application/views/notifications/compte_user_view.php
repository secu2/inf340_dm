<h2>Votre compte</h2>
<!-- L'utilisateur peut modifier son login et son mot de passe -->
<form action="<?php echo site_url('user/updateOk')?>" method="post">
	<p><label class="labelAlign"> Login : </label> <input name="login"  type="text" value="<?php echo $utilisateur->getLogin();?>"/></p>
	<p><label class="labelAlign"> Mot de passe : </label> <input name="password" type="password" value="<?php echo $utilisateur->getLogin();?>"/></p>
	<p><label class="labelAlign"> Level : </label> <input name="level" type="text" value="<?php echo $utilisateur->getLevel();?>" readonly="readonly"/></p>
	<p><input type="submit" value="Mettre à jour" class="mesSubmitsUpdate"/></p>
</form>