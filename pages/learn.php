<?php 
	require_once(realpath('../core/core_include.php'));

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] 	= getTranslations('general');

	$page_title = 'LangExchange';
	$active_page = 'learn';

	appendJs(array('webrtc_object', 'webrtc_client'));

	$data = sanitize($_GET);

	if(isset($data['roomid']))
	{
		$room_id = $data['roomid'];
	}
	if(isset($data['alh']))
	{
		$alh = $data['alh'];
	}

	require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">
	<?php
		printSessionErrors();
		printSessionSuccess();
	?>
	<div class="video-wrapper">
		<video id="otherVideo" class="other-video" src="" autoplay="true"></video>
		<video id="ownVideo" class="own-video" src="" autoplay="true" muted="true"></video>
	</div>
	
	<div id="chat_wrap">
		<div id="chat_messages">
			<p>User 1: Hello!</p>
			<p>User 2: Hi, how are you?</p>
		</div>
		<input type="text" id="chat_input">
		<button id="chat_send" class="button_primary">Send</button>
	</div>
</section>


<script>
	var roomId = "<?php if(isset($room_id)){ echo $room_id; }else{ echo "null"; } ?>";
	var alh = "<?php if(isset($alh)){ echo $alh; }else{ echo "null";} ?>";
</script>


<?php
	require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>
