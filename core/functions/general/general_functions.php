<?php
	/*
		This function checks whether the user is logged in.
	*/
	function isLoggedIn(){
		return isset($_SESSION['logged_user']) ? true : false;
	}

	/*
		This function redirects the user to the index page if he is not 
		logged in.
	*/
	function pageProtect(){
		if(!isLoggedIn()){
			header('Location: ' . PAGES_URL);
		}
	}

	/*
		This function redirects a user to the index page if he is logged in.
	*/
	function loggedInPageProtect(){
		if(isLoggedIn()){
			header('Location: ' . PAGES_URL);
		}
	}

	/*
		This function appends an additional CSS stylesheet to the array of styles to be included
	*/
	function appendCss($styles){

		global $css;

		if(is_array($styles)){
			foreach ($styles as $style) {
				array_push($css, $style);
			}
		}
		else{
			echo "STYLES variable is not an array";
			die();
		}
	}

	/*
		This function generates a css link
	*/
	function css(){

		global $css;

		if(!empty($css)){
			foreach ($css as $style){
				echo '<link rel="stylesheet" type="text/css" href="' . STYLES_URL . $style . '.css"/>';
			}
		}
	}

	/*
		This method appends an additional JS script to the array of scripts to be included
	*/
	function appendJs($scripts){

		global $js;

		if(is_array($scripts)){
			foreach ($scripts as $script) {
				array_push($js, $script);
			}
		}
		else{
			echo "SCRIPTS variable is not an array";
			die();
		}
	}

	/*
		This method generates a javascript link
	*/
	function js(){

		global $js;

		if(!empty($js)){
			foreach ($js as $script){
				echo '<script type="text/javascript" src="' . SCRIPTS_URL . $script . '.js"></script>';
			}
		}
	}

	/*
		This function generates an image link
	*/
	function img($folder, $img, $alt){
		$html = '<img src="';

		if($folder == 'core'){
			$html .= CORE_IMAGES_URL;
		}
		else if($folder == 'uploaded'){
			$html .= UPLOADED_IMAGES_URL;
		}

		$html .= $img . '" alt="' . $alt . '"/>';

		echo $html;
	}

	/*
		This function appends errors to the session array
	*/
	function appendSessionError($error){
		if(!isset($_SESSION['error'])){
			$_SESSION['error'] = array();
		}

		array_push($_SESSION['error'], $error);
	}

	/*
		This function displays errors stored in sessions in an appropriate div
	*/
	function printSessionErrors(){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			
			echo '<div class="error"><span class="icon error_icon"></span>';
			
			if(!is_array($_SESSION['error'])){
				echo $_SESSION['error'];
			}
			else{
				foreach($_SESSION['error'] as $error){
					echo $error . '<br/>';
				}
			}
		
			echo '</div>';
			unset($_SESSION['error']);
		}
	}

	/*
		This function appends a success message to the session success array.
	*/
	function appendSessionSuccess($message){
		if(!isset($_SESSION['success'])){
			$_SESSION['success'] = array();
		}

		array_push($_SESSION['success'], $message);
	}

	/*
		This function displays success messages stored in sessions in an appropriate div
	*/
	function printSessionSuccess(){
		if(isset($_SESSION['success']) && !empty($_SESSION['success'])){

			echo '<div class="success"><span class="icon success_icon"></span>';
			
			if(!is_array($_SESSION['success'])){
				echo $_SESSION['success'];
			}
			else{
				foreach($_SESSION['success'] as $success){
					echo $success . '<br/>';
				}
			}
		
			echo '</div>';
			unset($_SESSION['success']);
		}
	}

	/*
		This function retrieves the translations from ini files.
	*/
	function getTranslations($type){

		if(!isset($_COOKIE['current_language'])){
			$lang = 'en';
		}
		else{
			$lang = $_COOKIE['current_language'];
		}

		return parse_ini_file(LANGUAGE_DIR . 'php/' . $lang . '/' . $type . '.ini');
	}

	/*
		This function generates the options for the language choice dropdown
	*/
	function generateLanguageDropdown()
	{
		$template = '<option value="%s">%s</option>';
		$ignored = array('.', '..');
		$dirs = scandir(LANGUAGE_DIR . 'php/');
		$html = '';

		foreach($dirs as $dir)
		{
			if(!in_array($dir, $ignored))
			{
				$html .= sprintf($template, $dir, $dir);
			}
		}
		echo $html;
	}

	/*
		This function appends the javascript translations to an array
	*/
	function appendJsTranslations($type){

		global $js_translations;

		if(is_array($type)){
			foreach ($type as $t_type) {
				array_push($js_translations, $t_type);
			}
		}
		else{
			echo "Appended JS translations must be in array format.";
		}
	}

	/*
		This function retrieves the javascript translations and generates JS variables.
	*/
	function jsTranslations(){

		global $js_translations;

		if(!isset($_COOKIE['current_language']))
		{
			$lang = 'en';
		}
		else
		{
			$lang = $_COOKIE['current_language'];
		}

		$all_translations = array();

		foreach($js_translations as $translations)
		{
			$all_translations[$translations] = parse_ini_file(LANGUAGE_DIR . 'js/' . $lang . '/' . $translations . '.ini');
		}

		$html = '<script type="text/javascript">';
		$html .= 'var lang ={};';

		foreach ($all_translations as $all_key => $all_value)
		{
			$html .= "lang[\"{$all_key}\"] = {};";
			foreach ($all_value as $key => $value)
			{
				$html .= "lang.{$all_key}[\"{$key}\"] = \"{$value}\";";
			}
		}

		$html .= '</script>';

		echo $html;
	}

	/*
		This function hashes the object for comparison purposes
	*/
	function object_hash($object){
		return md5(serialize($object));
	}

	/*
		This function sanitizes the given input
	*/
	function sanitize($input){
		if(is_array($input))
		{
			$arr = array();
			foreach ($input as $key => $value)
			{
				$arr[$key] = $value;
			}
			return $arr;
		}
		else
		{
			return htmlspecialchars($input, ENT_QUOTES);
		}
	}

	/*
		This function redirects the user to another page
	*/
	function redirect($location)
	{
		header("Location: " . $location);
	}

	/*
		This function retrieves a template
	*/
	function getTemplate($name)
	{
		$filepath = TEMPLATE_DIR . $name . '.tpl';
		if(file_exists($filepath))
		{
			return file_get_contents($filepath);			
		}
		else
		{
			die('Template file not found');
		}
	}

?>