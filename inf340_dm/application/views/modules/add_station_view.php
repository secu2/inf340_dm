<!-- Vue accessible seulement par l'admin -->
<!-- Il peut, � partir de cette vue, ajouter une station -->
<h2>Ajouter une station</h2>
<?php
	$this->load->helper('form');

	echo validation_errors();
	echo form_open_multipart('/station/add_station'); ?>
<form>
	<p>Nom de la station : <input type="text" name="nom_station" value="<?php echo set_value('nom'); ?>" size="100" /></p> <br />
	<p>Photo : <input type="file" name="userfile" size="20" value="<?php echo set_value('userfile'); ?>" /> Description photo:<input type="text" name="description_image" value="<?php echo set_value('description_image'); ?>" size="10" /></p><br />
	<p>Description : <input type="text" name="description_station" value="<?php echo set_value('description'); ?>" size="100" /></p> <br />
	<p>D&eacute;partement : <input type="text" name="departement_station" value="<?php echo set_value('departement'); ?>" size="3"/></p> <br />
	<input type="submit" value="Submit" />
</form>