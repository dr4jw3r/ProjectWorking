<div id="registration_form_wrapper">
	<form id="registration_form" action="<?php echo PROCESSES_URL . 'register.php'; ?>" method="POST">
		<div class="left_col">
			<label for="registration_email"><?php echo $lang['registration']['email']; ?></label>
			<br/>
			<input type="email" name="registration_email" id="registration_email">
			<br/>
			<label for="registration_email_repeat"><?php echo $lang['registration']['repeat_email']; ?></label>
			<br/>
			<input type="email" name="registration_email_repeat" id="registration_email_repeat">
			<br/>
			<label for="registration_password"><?php echo $lang['registration']['password']; ?></label>
			<br/>
			<input type="password" name="registration_password" id="registration_password">
			<br/>
			<label for="registration_password_repeat"><?php echo $lang['registration']['repeat_password']; ?></label>
			<br/>
			<input type="password" name="registration_password_repeat" id="registration_password_repeat">
		</div>
		<div class="right_col">
			<label for="registration_first_name"><?php echo $lang['registration']['first_name']; ?></label>
			<br/>
			<input type="text" name="registration_first_name" id="registration_first_name">
			<br/>
			<label for="registration_country_select"><?php echo $lang['registration']['country']; ?></label>
			<br/>
			<select name="registration_country_select" id="registration_country_select">
				<?php require(OPTION_INCLUDES_DIR . 'country_options.php'); ?>			
			</select>
			<br/>
			<label for="registration_city"><?php echo $lang['registration']['city']; ?></label>
			<br/>
			<input type="text" id="registration_city" name="registration_city">
			<br/>
			<label><?php echo $lang['registration']['gender']; ?></label>
			<br/>
			<div id="gender_box">
				<div>
			  		<input id="gender_male" type="radio" name="gender" value="1">
			  		<label for="gender_male"><span><span></span></span><?php echo $lang['registration']['male']; ?></label>
				</div>
				<div>
			  		<input id="gender_female" type="radio" name="gender" value="2">
			  		<label for="gender_female"><span><span></span></span><?php echo $lang['registration']['female']; ?></label>
				</div>
			</div>
			<br/>
			<div class="clear"></div>
			<input type="submit" value="<?php echo $lang['registration']['register_button']; ?>">
		</div>
		
	</form>
</div>