<?php 
	require('../core/core_include.php');

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');
	$lang['contact'] = getTranslations('contact');

	$page_title = 'LangExchange';
	$active_page = 'contact';

	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content">
	<?php printSessionErrors(); printSessionSuccess(); ?>
	<h1><?php echo $lang['contact']['contact']; ?></h1>
	<div id="contact_content">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
		<?php require(PAGE_ELEMENTS_DIR . 'contact_form.php'); ?>
	</div>
</section>
<?php
	require(PAGE_ELEMENTS_DIR . 'footer.php');
?>