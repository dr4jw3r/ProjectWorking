<?php 
	require_once(realpath('../core/core_include.php'));

	if(isLoggedIn())
	{
		require_once(GENERAL_FUNCTIONS_DIR . 'sitewide_functions.php');
		$request_upcoming_dash_box = checkLessons();

		require_once(SERVICES_DIR . 'LessonRequestService.php');
		require_once(SERVICES_DIR . 'MessageService.php');
	}

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] 	= getTranslations('general');
	$lang['index']		= getTranslations('index');

	$page_title = 'LangExchange';
	$active_page = 'homepage';

	require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">
	<?php
		printSessionErrors();
		printSessionSuccess();

		if(isLoggedIn())
		{
			$lesson_request_service = new LessonRequestService();
			$message_service = new MessageService();

			echo '<div id="dash_wrap" class="flex">';
			$lesson_request_service->generateDashboardBox();
			$message_service->generateDashboardBox();
			echo $request_upcoming_dash_box;
			echo '</div>';
		}
		else
		{
			echo sprintf('<div id="homepage_background">
					<div id="homepage_overlay">
						<div id="homepage_content">
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<p><a href="%s" id="welcome_button">%s</a></p>
						</div>
					</div>
				</div>', PAGES_URL . 'registration.php', $lang['index']['get_started']);
		}
	?>
</section>
<?php
	require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>