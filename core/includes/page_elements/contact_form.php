<form action="<?php echo PROCESSES_URL . 'contactform_message.php'; ?>" method="POST">
	<label for="reply_email"><?php echo $lang['contact']['email']; ?></label>
	<br/>
	<input type="email" name="message_email" id="reply_email">
	<br/><br/>
	<label for="subject"><?php echo $lang['contact']['subject']; ?></label>
	<br/>
	<input type="text" name="message_subject" id="subject">
	<br/><br/>
	<label for="body"><?php echo $lang['contact']['body']; ?></label>
	<br/>
	<textarea name="body" id="body" cols="90" rows="10"></textarea>
	<br/><br/>
	<input type="submit" value="<?php echo $lang['contact']['send']; ?>">
</form>