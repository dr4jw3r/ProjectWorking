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
	?>
</section>
<?php
	require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>