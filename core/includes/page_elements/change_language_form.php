<h2><?php echo $lang['settings']['language_change']; ?></h2>
<form action="<?php echo PROCESSES_URL . 'site_language_change.php'; ?>" method="post">
	<label for="site_language_change"><?php echo $lang['settings']['choose_language']; ?></label>
	<br/>
	<select name="site_language_change" id="site_language_change">
		<?php generateLanguageDropdown(); ?>
	</select>
	<br/><br/>
	<button class="button_primary"><?php echo $lang['settings']['save']; ?><span class="icon save_icon"></span></button>
</form>