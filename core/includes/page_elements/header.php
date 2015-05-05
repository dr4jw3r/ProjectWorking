<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>reset.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>fonts.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>main_smartphone_p.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>main_smartphone_l.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>main_ipad_p.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>main_ipad_l.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>main_desktop.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo STYLES_URL; ?>main_large.css"/>
	<link rel="icon" type="image/png" href="<?php echo CORE_IMAGES_URL . 'favicon.ico'; ?>">
	<?php css(); ?>
</head>
<body>
<header>
	<?php
		if(!isLoggedIn()){
			require(PAGE_ELEMENTS_DIR . 'navigation.php');
		}
		else{
			require(PAGE_ELEMENTS_DIR . 'navigation_logged_in.php');
		}
	?>
</header>