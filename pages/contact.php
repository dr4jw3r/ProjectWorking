<?php 
	require('../core/core_include.php');

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');

	$page_title = 'LangExchange';
	$active_page = 'contact';

	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content">
	<?php printSessionErrors(); printSessionSuccess(); ?>
	<h1>Contact</h1>
</section>
<?php
	require(PAGE_ELEMENTS_DIR . 'footer.php');
?>