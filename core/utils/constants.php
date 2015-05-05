<?php 

/*
	NOTE: PROJECT_FOLDER constants is defined in the "core_include.php" file.
*/

//====DIRECTORIES====
//Root Directory
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER);
//Core Directory
define('CORE_DIR', ROOT_DIR . 'core/');
//Models Directory
define('MODELS_DIR', CORE_DIR . 'models/');
//Services Directory
define('SERVICES_DIR', CORE_DIR . 'services/');
//Processes Directory
define('PROCESSES_DIR', CORE_DIR . 'processes/');
//Database Directory
define('DB_DIR', CORE_DIR . 'database/');
//Repository Directory
define('REPO_DIR', DB_DIR . 'repositories/');
//Entities Directory
define('ENTITIES_DIR', DB_DIR . 'entities/');
//Functions Directory
define('FUNCTIONS_DIR', CORE_DIR . 'functions/');
//General Functions Directory
define('GENERAL_FUNCTIONS_DIR', FUNCTIONS_DIR . 'general/');
//Includes Directory
define('INCLUDES_DIR', CORE_DIR . 'includes/');
//Page Elements Directory
define('PAGE_ELEMENTS_DIR', INCLUDES_DIR . 'page_elements/');
//Option includes Directory
define('OPTION_INCLUDES_DIR', INCLUDES_DIR . 'options/');
//Utils Directory
define('UTILS_DIR', CORE_DIR . 'utils/');
//Images Directory
define('IMAGES_DIR', ROOT_DIR . 'public/images/');
//Javascript Directory
define('SCRIPTS_DIR', ROOT_DIR . 'public/javascript/');
//Pages Directory
define('PAGES_DIR', ROOT_DIR . 'pages/');
//Stylesheets Directory
define('STYLES_DIR', ROOT_DIR . 'public/stylesheets/');
//Logs Directory
define('LOGS_DIR', ROOT_DIR . 'logs/');
//Mappings Directory
define('MAPPINGS_DIR', DB_DIR . 'mappings/');
//Languages Directory
define('LANGUAGE_DIR', CORE_DIR . 'lang/');
//Template Directory
define('TEMPLATE_DIR', INCLUDES_DIR . 'templates/');

//====URLS====
$root_folder = '/Project/';
//Root URL
define('ROOT_URL', "http://$_SERVER[HTTP_HOST]$root_folder");
//Pages URL
define('PAGES_URL', ROOT_URL . 'pages/');
//Core URL
define('CORE_URL', ROOT_URL . 'core/');
//Public URL
define('PUBLIC_URL', ROOT_URL . 'public/');
//Stylesheets URL
define('STYLES_URL', PUBLIC_URL . 'stylesheets/');
//Javascript URL
define('SCRIPTS_URL', PUBLIC_URL . 'javascript/');
//Core Images URL
define('CORE_IMAGES_URL', PUBLIC_URL . 'images/core/');
//Uploaded Images URL
define('UPLOADED_IMAGES_URL', PUBLIC_URL . 'images/uploaded/');
//Flag Images URL
define('FLAG_IMAGES_URL', CORE_IMAGES_URL . 'flags/');
//Processes URL
define('PROCESSES_URL', CORE_URL . 'processes/');

 ?>
