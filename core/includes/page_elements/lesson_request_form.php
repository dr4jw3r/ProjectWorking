<?php 
	$current_user_name = $current_user_decorated->get_full_name();
	$user_to_name = $user_to_decorated->get_full_name();
?>

<h2><?php echo $lang['lesson_request']['lesson_request']; ?></h2>
	<form action="<?php echo PROCESSES_URL . 'send_lesson_request.php'; ?>" method="POST" id="sendlessonrequestform">
		<label for="req_from"><?php echo $lang['lesson_request']['from']; ?></label>
		<br/>
		<input type="text" disabled="true" value="<?php echo $current_user_name; ?>">
		<br/><br/>
		<label for="req_to"><?php echo $lang['lesson_request']['to']; ?></label>
		<br/>
		<input type="text" disabled="true" value="<?php echo $user_to_name; ?>">
		<br/><br/>
		<label for="req_date"><?php echo $lang['lesson_request']['date']; ?></label>
		<br/>
		<input type="text" name="req_date" id="datepicker">
		<br/><br/>
		
		<div class="flex">
			<div class="lesson_request_flex_left">
				<label for="req_start_time"><?php echo $lang['lesson_request']['start_time']; ?></label>
				<br/>
				<input type="text" id="starttime" name="start_time">
				<br/><br/>
				<label for="req_end_time"><?php echo $lang['lesson_request']['end_time']; ?></label>
				<br>
				<input type="text" id="endtime" name="end_time">	
			</div>
			<div class="lesson_request_flex_right" id="duration_flex">
				<div>
					<?php echo $lang['lesson_request']['duration']; ?>: <span id="duration_calculation">00:00</span>
				</div>
			</div>
		</div>
		<br/>
		<label for="language_select"><?php echo $lang['lesson_request']['which_language']; ?></label>
		<br/>
		<select name="language_select" id="language_select">
			<?php 
				foreach($user_to_decorated->get_languages_spoken() as $language_spoken)
				{
					$language_name = $language_spoken->get_language_name();
					$language_code = $language_spoken->get_language_spoken()->get_language_code();

					echo "<option value=\"{$language_code}\">{$language_name}</option>";
				}
			?>
		</select>
		<input type="hidden" name="req_duration_min" id="req_duration_min" value="0">
		<input type="hidden" name="req_user_to_id" value="<?php echo $user_to_decorated->get_user()->get_id(); ?>">
		<br/><br/>
		<input type="submit" value="<?php echo $lang['lesson_request']['send']; ?>">
	</form>