<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>    
    <title> Dahu </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="<?php echo base_url('ressources/css/style.css'); ?>" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
	<div id="haut">
		<p id="dahu"> 
			<img src="<?php echo base_url('./ressources/images/dahu.png'); ?>"/> 
		</p>
		<p>
			<a href=<?php echo base_url();?> id="logo"><img src="<?php echo base_url('./ressources/images/logo.png'); ?>" alt="logo" /></a>
		</p>
		
		<ul id="connexion">
			<li><a href=<?php echo site_url('welcome/inscription/');?>>Inscription</a></li>
		</ul>
		</div>	
		
		<ul id="menu">
			<li><a href=<?php echo site_url();?>>Accueil</a></li>
			<li><a href=<?php echo site_url('welcome/stations/');?>>Les stations</a></li>
			<li><a href=<?php echo site_url('welcome/compte/');?>>Votre compte</a></li>
		</ul>
		
	</body>
</html>