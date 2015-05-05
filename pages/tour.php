<?php 
	require('../core/core_include.php');

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');

	$page_title = 'LangExchange';
	$active_page = 'tour';

	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content">
	<?php printSessionErrors(); printSessionSuccess(); ?>

</section>
<?php
	require(PAGE_ELEMENTS_DIR . 'footer.php');
?>