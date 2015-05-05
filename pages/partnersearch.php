<?php 
	require_once(realpath('../core/core_include.php'));
	require_once(realpath(SERVICES_DIR . 'UserService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageSpokenService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageLearnService.php'));
	require_once(realpath(MAPPINGS_DIR . 'Mapping.php'));

	pageProtect();

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] 	= getTranslations('general');
	$lang['search'] 	= getTranslations('partnersearch');

	appendJsTranslations(array('search_page_js'));
	appendJs(array('partner_search'));

	$page_title 	= 'LangExchange';
	$active_page 	= 'partnersearch';

	$language_spoken_service 	= new LanguageSpokenService();
	$language_learn_service 	= new LanguageLearnService();
	$user_service 				= new UserService();

	$languages_spoken 	= Mapping::toArray($language_spoken_service->byProperty(array('user_id' => $_SESSION['logged_user']['id'])));
	$languages_learn 	= Mapping::toArray($language_learn_service->byProperty(array('user_id' => $_SESSION['logged_user']['id'])));

	require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">
	<h1><?php echo $lang['search']['partner_search']; ?></h1>
	<?php
		printSessionErrors();
		printSessionSuccess();

		if($languages_spoken == null)
		{
			echo '<div class="warning">';
			echo $lang['search']['no_lang_spoken'];
			echo "&nbsp;<a href=\"" . PAGES_URL . "settings.php" . "\">{$lang["search"]["settings"]}</a>";
			echo '</div>';
		}

		if($languages_learn == null)
		{
			echo '<div class="warning">';
			echo $lang['search']['no_lang_learn'];
			echo "&nbsp;<a href=\"" . PAGES_URL . "settings.php" . "\">{$lang["search"]["settings"]}</a>";
			echo '</div>';
		}
		
		if($languages_spoken != null && $languages_learn != null)
		{
			echo '<div class="loading"></div>';
		}

	?>
	<div id="search_wrap">

	</div>
</section>

<script>
	var languages_learn = new Array();
	var languages_spoken = new Array();
	<?php 
		for($i = 0; $i < count($languages_learn); $i++)
		{
			echo "languages_learn[{$i}] = \"" . $languages_learn[$i]["language_code"] . '";';
		}

		for ($i = 0; $i < count($languages_spoken); $i++)
		{
			echo "languages_spoken[{$i}] = \"" . $languages_spoken[$i]["language_code"] . '";';
		}
	?>	
</script>

<?php
	require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>