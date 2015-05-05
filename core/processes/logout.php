<?php
	require_once('../core_include.php');
	$lang['logout'] = getTranslations('logout');
	unset($_SESSION['logged_user']);
	session_destroy();
	session_start();
	appendSessionSuccess($lang['logout']['logout_success']);
	header('Location: ' . PAGES_URL . 'index.php');
?>