<h2 id="pubsettings"><?php echo $lang['settings']['public_details']; ?></h2>
<form id="public_settings_form" action="<?php echo PROCESSES_URL . 'pub_settings_update.php'; ?>" method="POST">
	<textarea name="profile_desc" id="profile_desc" cols="90" rows="10" maxlength="1000"><?php echo $personal_details->get_profile_description(); ?></textarea>
	<p id="desc_char_counter"></p>
	<br/>
	<button class="button_primary"><?php echo $lang['settings']['save']; ?><span class="icon save_icon"></span></button>
</form>
