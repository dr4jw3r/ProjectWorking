<h2 id="psettings"><?php echo $lang['settings']['personal_details']; ?></h2>
	<form id="personal_settings_form" action="<?php echo PROCESSES_URL . 'p_settings_update.php'; ?>" method="POST">
		<label for="settings_first_name"><?php echo $lang['settings']['first_name']; ?></label>
		<br/>
		<input type="text" id="settings_first_name" name="settings_first_name" placeholder="<?php echo $personal_details->get_first_name(); ?>">
		<br/><br/>
		<label for="settings_last_name"><?php echo $lang['settings']['last_name']; ?></label>
		<br/>
		<input type="text" id="settings_last_name" name="settings_last_name" placeholder="<?php echo $personal_details->get_last_name(); ?>">
		<br/><br/>
		<label for="settings_country"><?php echo $lang['settings']['country']; ?></label>
		<br/>
		<select name="settings_country" id="settings_country">
			<?php require(OPTION_INCLUDES_DIR . 'country_options.php'); ?>
		</select>
		<br/><br/>
		<label for="settings_city"><?php echo $lang['settings']['city']; ?></label>
		<br/>
		<input type="text" id="settings_city" name="settings_city" placeholder="<?php echo $personal_details->get_city(); ?>">
		<br/><br/>
		<label for="settings_age"><?php echo $lang['settings']['age']; ?></label>
		<br/>
		<input type="text" id="settings_age" name="settings_age" placeholder="<?php echo $personal_details->get_age(); ?>">
		<br/><br/>
		<label for="gender_male"><?php echo $lang['settings']['gender']; ?></label>
		<br/>
		<div id="gender_box">
			<div>
		  		<input id="gender_male" type="radio" name="gender" value="1">
		  		<label for="gender_male"><span><span></span></span><?php echo $lang['settings']['male']; ?></label>
			</div>
			<div>
		  		<input id="gender_female" type="radio" name="gender" value="2">
		  		<label for="gender_female"><span><span></span></span><?php echo $lang['settings']['female']; ?></label>
			</div>
		</div>
		<br/><br/>
		<button class="button_primary"><?php echo $lang['settings']['save']; ?><span class="icon save_icon"></span></button>
	</form>