<?php 
	require('../core/core_include.php');
	loggedInPageProtect();
	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');
	$lang['registration'] = getTranslations('registration');
	$page_title = 'Register';
	$active_page = 'registration';
	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content">
	<h1><?php echo $lang['registration']['register']; ?></h1>


	<?php 
		printSessionErrors();
		require_once(PAGE_ELEMENTS_DIR . "registration_form.php");
	?>
</section>

<?php require(PAGE_ELEMENTS_DIR . 'footer.php'); ?>