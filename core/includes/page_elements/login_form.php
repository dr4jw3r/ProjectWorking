<p>Log In</p>
<hr/>
<br/>
<form id="login_form" action="<?php echo PROCESSES_URL . 'login.php'; ?>" method="POST">
	<label for="login_email"><?php echo $lang['general']['e_mail']; ?></label>
	<br/>
	<input type="email" id="login_email" name="login_email" placeholder="<?php echo $lang['general']['e_mail']; ?>...">
	<br/><br/>
	<label for="login_password"><?php echo $lang['general']['password']; ?></label>
	<br/>
	<input type="password" id="login_password" name="login_password" placeholder="<?php echo $lang['general']['password']; ?>...">
	<br/><br/>
	<input type="hidden" name="cur_loc" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
	<input type="submit" value="<?php echo $lang['navigation']['log_in']; ?>" id="login_submit">
</form>

<br/>

<a href="<?php echo PAGES_URL . 'registration.php'; ?>"><?php echo $lang['navigation']['not_registered_yet']; ?></a>