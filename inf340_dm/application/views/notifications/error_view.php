<h2>Erreur : <?php echo $id_error; ?></h2>
<p>Une erreur est survenue, veuillez r&eacute;essayer.</p>
<p>
<?php if(isset($url_retour)){?>
	<a href="<?php base_url($url_retour); ?>">Retour</a></p>
<?php }?>

<?php 
/*
 * 
 * Ceci est une page d'erreur qui peut être utilisée dans un controlleur:
 * Lui envoyer:
 * - URL relative du lien retour
 * - Type d'erreur
 * 
 */



?>