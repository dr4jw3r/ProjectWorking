<?php 
	require_once(realpath('../core/core_include.php'));

	require_once(realpath(ENTITIES_DIR . 'DecoratedUser.php'));

	require_once(realpath(SERVICES_DIR . 'UserService.php'));

	require_once(realpath(MAPPINGS_DIR . 'Mapping.php'));

	pageProtect();

	appendCss(array('jquery-ui.min', 'jquery.timepicker'));
	appendJs(array('jquery-ui.min', 'jquery.timepicker.min', 'jquery.validate.min', 'lesson_request'));

	appendJsTranslations(array('lesson_request_js'));

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');
	$lang['lesson_request'] = getTranslations('lesson_request');

	$page_title = 'LangExchange';
	$active_page = 'lessonrequest';

	$user_service = new UserService();

	$data = sanitize($_POST);

	if(!isset($data['request_user_id']))
	{
		$data['request_user_id'] = $_SESSION['lesson_request_user_to_id'];
		unset($_SESSION['lesson_request_user_to_id']);
	}

	$current_user_decorated = new DecoratedUser(Mapping::toObject('User', $_SESSION['logged_user']));
	$user_to_decorated = new DecoratedUser(Mapping::toObject('User', $user_service->byId((int) $data['request_user_id'])));

	require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">
	<?php
		printSessionErrors();
		printSessionSuccess();
	?>

	<div id="request_form_wrap">
		<?php require_once(PAGE_ELEMENTS_DIR . 'lesson_request_form.php'); ?>
	</div>	

</section>
<?php
	require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>