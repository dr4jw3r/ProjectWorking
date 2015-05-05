<form action="<?php echo PROCESSES_URL . 'sendmessage.php'; ?>" method="POST" id="sendmessage_form">
	<label for="message_to_input"><?php echo $lang['messages']['to']; ?></label>
	<br/>
	<input type="text" name="message_to_input" id="message_to_input" disabled="true" value="<?php if(isset($user_to_compose)){echo $user_to_compose->get_full_name();} ?>">
	<br/><br/>
	<label for="message_subject_input"><?php echo $lang['messages']['subject']; ?></label>
	<br/>
	<input type="text" name="message_subject_input" id="message_subject_input">
	<br/><br/>
	<label for="message_body"><?php echo $lang['messages']['body']; ?></label>
	<br/>
	<textarea cols="80" rows="10" maxlength="1000" id="message_body" name="message_body_input"></textarea>
	<br/><br/>
	<input type="hidden" name="to_id" id="to_id" value="<?php if(isset($user_to_compose)){echo $user_to_compose->get_user()->get_id();} ?>">
	<input type="submit" value="<?php echo $lang['messages']['send']; ?>">
</form>