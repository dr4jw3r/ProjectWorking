<?php 
require_once(realpath('../core/core_include.php'));

require_once(ENTITIES_DIR . 'DecoratedUser.php');

require_once(SERVICES_DIR . 'MessageService.php');
require_once(SERVICES_DIR . 'UserService.php');

require_once(MAPPINGS_DIR . 'Mapping.php');

pageProtect();

$lang['navigation'] = getTranslations('navigation');
$lang['general'] 	= getTranslations('general');
$lang['messages'] 	= getTranslations('messages');

$data = sanitize($_POST);

$user_service = new UserService();

if(isset($data['message_user_id']))
{
	$user_to_compose = $user_service->byId($data['message_user_id']);
	$user_to_compose = new DecoratedUser($user_to_compose);
// $user_js = clone $user_to_compose;
// $user_js->get_user()->set_password('');
// $user_js->get_user()->set_salt('');
// $user_js->get_user()->set_email('');
// $user_js->set_personal_details(null);
// $user_js->set_languages_learn(null);
// $user_js->set_languages_spoken(null);
// $user_js->remapToArray();
// $user_js = Mapping::toArray($user_js);
}


$page_title = 'LangExchange';
$active_page = 'messages';

appendJs(array('messages', 'jquery.validate.min'));
appendJsTranslations(array('messages_js'));

$message_service = new MessageService();
require_once(realpath(PAGE_ELEMENTS_DIR . 'header.php'));
?>
<section id="content">
	<h1><?php echo $lang['messages']['messages']; ?></h1>
	<?php
		printSessionErrors();
		printSessionSuccess();
	?>
	<div class="flex" id="messages_wrap">
		
		<div id="messages_left">
			<ul>
				<li><a id="inbox_link" href="" class="active"><?php echo $lang['messages']['inbox']; ?></a></li>
				<li><a id="sent_link" href=""><?php echo $lang['messages']['sent']; ?></a></li>
				<li><a id="trash_link" href=""><?php echo $lang['messages']['trash']; ?></a></li>
			</ul>
		</div>

		<div id="messages_right">
			<div id="messages_inbox_box" class="messages_box">
				<div class="messages_inner">
					<?php $message_service->generateInbox(); ?>
				</div>
			</div>
			<div id="messages_sent_box" class="messages_box">
				<div class="messages_inner">
					<?php $message_service->generateSentbox(); ?>
				</div>
			</div>
			<div id="messages_trash_box">
				<div class="messages_inner">
					<?php $message_service->generateTrashbox(); ?>
				</div>
			</div>
			<div id="messages_single_box">
				<div class="messages_inner">
					<div id="message_single_header" class="flex">
						<div id="message_single_from"></div>
						<div id="message_single_reply"><button class="button_primary" id="reply_button"><?php echo $lang['messages']['reply']; ?></button></div>
					</div>
					<div class="flex" id="message_single_underheader">
						<div id="message_single_subject"></div>
						<div id="message_single_sent_date"></div>
					</div>
					<div id="message_single_content"></div>
					<div id="message_single_user_to_id" style="display:none;">-1</div>
					<div id="message_single_user_from_id" style="display:none;">-1</div>
				</div>
			</div>
			<div id="messages_compose_box" style="display:none;" class="messages_box">
				<?php require_once(PAGE_ELEMENTS_DIR . 'message_compose_form.php'); ?>
			</div>
		</div>
	</div>
</section>
<script>
	<?php if(isset($user_to_compose)){ echo 'var compose=true;'; } ?>
</script>
<?php
require_once(realpath(PAGE_ELEMENTS_DIR . 'footer.php'));
?>