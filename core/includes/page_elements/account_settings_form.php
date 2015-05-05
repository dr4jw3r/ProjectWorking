<h2 id="accsettings"><?php echo $lang['settings']['account_settings']; ?></h2>
<form action="<?php echo PROCESSES_URL . "account_settings_update.php"; ?>" method="POST">
	<div class="flex">
		<div class="settings_section_label">
			<?php echo $lang['settings']['change_password']; ?>
		</div>
		<div class="settings_section_content">
			<label for="old_password"><?php echo $lang['settings']['old_password']; ?></label>
			<br/>
			<input type="password" id="old_password" name="old_password">
			<br/><br/>
			<label for="new_password"><?php echo $lang['settings']['new_password']; ?></label>
			<br/>
			<input type="password" id="new_password" name="new_password">
			<br/><br/>
			<label for="new_password_repeat"><?php echo $lang['settings']['new_password_repeat']; ?></label>
			<br/>
			<input type="password" id="new_password_repeat" name="new_password_repeat">
			<br/>
			<input type="submit" value="<?php echo $lang['settings']['save']; ?>">
		</div>
	</div>
</form>
