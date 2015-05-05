<?php 
	require('../core/core_include.php');

	pageProtect();

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');

	$page_title = 'LangExchange';
	$active_page = 'help';

	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content">
	Help page.
</section>
<?php
	require(PAGE_ELEMENTS_DIR . 'footer.php');
?>