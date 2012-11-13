<!-- Vue accessible seulement par l'admin -->
<!-- Il peut, à partir de cette vue, ajouter une station -->
<h1>Ajouter une station</h1>
<?php
	$this->load->helper('form');

	echo validation_errors();
	echo form_open('/welcome/add_station'); ?>
<form>
	Nom de la station : <input type="text" name="nom_station" value="<?php echo set_value('nom'); ?>" size="100" /> <br />
	Photo : <br />
	Description : <input type="text" name="description_station" value="<?php echo set_value('description'); ?>" size="100" /> <br />
	Département : <input type="text" name="departement_station" value="<?php echo set_value('departement'); ?>" size="3"/> <br />
	<input type="submit" value="Submit" />
</form>