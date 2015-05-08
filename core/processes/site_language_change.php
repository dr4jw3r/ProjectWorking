<?php

	require_once(realpath('../core_include.php'));

	$data = sanitize($_POST);

	setcookie('current_language', $data['site_language_change'], time() + (86400 * 30), "/"); 

	appendSessionSuccess('Language changed successfully!');
	redirect(PAGES_URL . 'settings.php');

?>