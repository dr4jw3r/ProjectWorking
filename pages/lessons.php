<?php 
	require_once(realpath('../core/core_include.php'));

	pageProtect();

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');
	$lang['lessons'] = getTranslations('lessons');

	appendJs(array('lessons'));
	appendJsTranslations(array('lessons_js'));

	$page_title = 'LangExchange';
	$active_page = 'lessons';

	require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">

	<h1><?php echo $lang['lessons']['lessons']; ?></h1>
	<?php
		printSessionErrors();
		printSessionSuccess();
	?>
	<div class="lessons_outer flex">
		<div class="lessons_menu">
			<ul>
				<li><a href="" id="lessons_received_link" class="active"><?php echo $lang['lessons']['received']; ?></a></li>
				<li><a href="" id="lessons_sent_link"><?php echo $lang['lessons']['sent']; ?></a></li>
				<li><a href="" id="lessons_archived_link"><?php echo $lang['lessons']['archived']; ?></a></li>
			</ul>
		</div>
		<div id="lessons_wrapper">
			<div class="loading"></div>
		</div>
		<div id="lessons_sent_wrapper">
			<div class="loading"></div>
		</div>
		<div id="lessons_archived_wrapper">
			<div class="loading"></div>
		</div>
	</div>

</section>
<?php
	require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>