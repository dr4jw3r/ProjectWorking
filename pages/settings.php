<?php 
	require_once(realpath('../core/core_include.php'));

	pageProtect();
	
	require_once(realpath(SERVICES_DIR . 'PersonalDetailsService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageSpokenService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageLearnService.php'));
	require_once(realpath(MAPPINGS_DIR . 'Mapping.php'));
	require_once(realpath(MAPPINGS_DIR . 'ProficiencyMapping.php'));
	require_once(realpath(MAPPINGS_DIR . 'LanguageMapping.php'));

	appendJsTranslations(array('settings_page_js'));
	appendJs(array('settings_page'));

	$personal_details_service = new PersonalDetailsService();
	$language_service = new LanguageService();
	$language_spoken_service = new LanguageSpokenService();
	$language_learn_service = new LanguageLearnService();

	$personal_details = $personal_details_service->byProperty(array('user_id' => $_SESSION['logged_user']['id']));
	$personal_details = $personal_details[0];
	$languages_spoken = $language_spoken_service->byProperty(array('user_id' => $_SESSION['logged_user']['id']));
	$languages_learn = $language_learn_service->byProperty(array('user_id' => $_SESSION['logged_user']['id']));

	if($languages_spoken != null)
	{
		$languages_spoken = Mapping::toArray($languages_spoken);
	}
	if($languages_learn != null)
	{
		$languages_learn = Mapping::toArray($languages_learn);
	}

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');
	$lang['settings'] = getTranslations('settings');

	$page_title = 'LangExchange';
	$active_page = 'settings';

	require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">
	<aside id="settings_sidebar">
		<ul>
			<li><a href="#psettings"><?php echo $lang['settings']['personal_details']; ?></a></li>
			<li><a href="#pubsettings"><?php echo $lang['settings']['public_details']; ?></a></li>
			<li><a href="#langsettings"><?php echo $lang['settings']['language_details']; ?></a></li>
			<li><a href="#accsettings"><?php echo $lang['settings']['account_settings']; ?></a></li>
		</ul>
	</aside>

	<?php printSessionErrors(); printSessionSuccess(); ?>

	<div id="settings_sidebar_right">
		<?php 
			require_once(PAGE_ELEMENTS_DIR . 'personal_settings_form.php'); 
			require_once(PAGE_ELEMENTS_DIR . 'public_settings_form.php');
			require_once(PAGE_ELEMENTS_DIR . 'language_settings_form.php');
			require_once(PAGE_ELEMENTS_DIR . 'account_settings_form.php');
		?>
	</div>
	
	<div class="clear"></div>

</section>

<script type="text/javascript">
	var settings_selected_country = "<?php echo $personal_details->get_country_code(); ?>";
	var settings_gender = "<?php echo $personal_details->get_gender(); ?>";
	<?php if($languages_spoken == null){ echo "var displayTempBox = true;"; } else{ echo "var displayTempBox = false;"; } ?>
	<?php
		if($languages_spoken != null)
		{
			echo "var languages_spoken = [";
			foreach ($languages_spoken as $language_spoken)
			{
				echo "{";
				foreach ($language_spoken as $key => $value)
				{
					echo "\"{$key}\": \"{$value}\",";
				}
				echo "},";
			}
			echo "];";
		}
	?>
</script>

<?php
	require_once(PAGE_ELEMENTS_DIR . 'footer.php');
?>