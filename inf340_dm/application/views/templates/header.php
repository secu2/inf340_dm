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
		<p>
			<a href="" id="logo"><img src="<?php echo base_url('./ressources/images/logo.png'); ?>" alt="logo" /></a>
		</p>
		<p id="dahu"> 
			<img src="<?php echo base_url('./ressources/images/dahu.png'); ?>"/> 
		</p>
		<ul id="connexion">
			<!-- Si l'utilisateur est connect�, afficher "Bonjour [pseudo]" et un lien vers la d�connexion -->
			<?php ?>
			<!-- Sinon afficher liens vers inscription et connexion -->
			<?php ?>
			<li><a href="">Inscription</a></li>
			<li><a href="">Connexion</a></li>
			<?php ?>
		</ul>
		<ul id="menu">
			<li><a href="">Accueil</a></li>
			<li><a href="">Les stations</a></li>
			<li><a href="">Votre compte</a></li>
		</ul>
		<table>
			<tr>
				<th>News</th>
			</tr>
			<tr>
				<td> 01/01/01 - Ouverture du site</td>
			</tr>
		</table>
	</body>
</html>