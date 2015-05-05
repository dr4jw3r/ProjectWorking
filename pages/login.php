<?php 
	require('../core/core_include.php');

	loggedInPageProtect();

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');

	$page_title = 'LangExchange';
	$active_page = 'login';

	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content">
	<?php
		printSessionErrors();
		printSessionSuccess();

		require(PAGE_ELEMENTS_DIR . 'login_form.php');
	?>
</section>
<?php
	require(PAGE_ELEMENTS_DIR . 'footer.php');
?>