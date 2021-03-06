<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Dahu</title>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<link href="<?php echo base_url('ressources/css/style.css'); ?>" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
	<div id="haut">
		<p>
			<a href=<?php echo base_url();?> id="logo"><img
				src="<?php echo base_url('./ressources/images/logo.png'); ?>"
				alt="logo" /> </a>
		</p>
		<p id="dahu">
			<img src="<?php echo base_url('./ressources/images/dahu.png'); ?>" />
		</p>
		
		<ul id="menu">
			<li><a href=<?php echo site_url();?>>Accueil</a></li>
			<li><a href=<?php echo site_url('station/');?>>Les stations</a>
			</li>
			<li><a href=<?php echo site_url('user/');?>>Votre compte</a></li>
		</ul>
	</div>

	<div id="contenu">


		<ul id="connexion">
			<!-- Si l'utilisateur est connecte, afficher "Bonjour pseudo" et un lien vers la deconnexion -->
			<?php if(isset($utilisateur)){ ?>
			<li>Bonjour <?php echo $utilisateur->getLogin(); ?>
			</li>
			<li><a href="<?php echo site_url('user/logout');?>">Déconnexion</a>
			</li>
			<!-- Sinon afficher liens vers inscription et connexion -->
			<?php }else{ ?>
			<li><a href=<?php echo site_url('user/register/');?>>Inscription</a>
			</li>
			<li><a href=<?php echo site_url('user/');?>>Connexion</a></li>
			<?php } ?>
		</ul>


		<div id="texte">
