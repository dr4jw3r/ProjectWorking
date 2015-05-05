<?php 
	require_once(realpath("../core/core_include.php"));
	$lang['settings'] = getTranslations('settings');
?>

<option value="0"><?php echo $lang['settings']['beginner']; ?></option>
<option value="1"><?php echo $lang['settings']['intermediate']; ?></option>
<option value="2"><?php echo $lang['settings']['advanced']; ?></option>
<option value="3"><?php echo $lang['settings']['native']; ?></option>