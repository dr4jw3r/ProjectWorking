<?php 
	/*::GLOBAL CONFIG::*/
	// error_reporting(0);
	date_default_timezone_set('Europe/Dublin');

	/*::REQUIRES::*/
	define('PROJECT_FOLDER', '/Project/');
	require_once('/opt/lampp/htdocs/Project/core/utils/constants.php');
	require_once(realpath(UTILS_DIR . 'Logger.php'));
	require_once(realpath(GENERAL_FUNCTIONS_DIR . 'general_functions.php'));

	/*::GLOBAL_VARIABLES::*/
	$page_title = 'CHANGE_ME';
	$js = array();
	$js_translations = array();
	$css = array();

	/*::START SESSION::*/
	session_start();

 ?>
