$(function(){

	$('#sendmessage_form').validate({
		errorClass: "form_input_invalid",

		rules: {
			message_subject_input: {
				required: true,
			},
			message_body_input: {
				required: true
			}
		},
		messages: {
			message_subject_input: {
				required: "Please enter a subject"
			},
			message_body_input: {
				required: "Please enter a message body"
			}
		}
	});

	var allElements = new Array();
	var allLinks = new Array();

	var composeBox = $('#messages_compose_box');
	var inboxBox = $('#messages_inbox_box');
	var sentBox = $('#messages_sent_box');
	var trashBox = $('#messages_trash_box');
	var singleBox = $('#messages_single_box');

	var inboxLink = $('#inbox_link');
	var sentLink = $('#sent_link');
	var trashLink = $('#trash_link');

	allElements.push(composeBox);
	allElements.push(inboxBox);
	allElements.push(sentBox);
	allElements.push(trashBox);
	allElements.push(singleBox);

	allLinks.push(inboxLink);
	allLinks.push(sentLink);
	allLinks.push(trashLink);

	$(inboxLink).click(function(e){
		e.preventDefault();
		removeLinkClass();
		showInbox();
		$(inboxLink).addClass('active');
	});
	$(sentLink).click(function(e){
		e.preventDefault();
		removeLinkClass();
		showSentBox();
		$(sentLink).addClass('active');
	});
	$(trashLink).click(function(e){
		e.preventDefault();
		removeLinkClass();
		showTrashBox();
		$(trashLink).addClass('active');
	});

	$('.message_inner_wrap').click(function(e){

		var children = this;
		var sub_children = $(children).children();

		if($(children).hasClass('unread'))
		{
			$(children).removeClass('unread');
			statusUpdate($(sub_children[5]).html(), 1);
		}

		var date = "";

		$(sub_children[1]).children().each(function(i, e){
			date += $(e).html() + "&nbsp;";
		});

		var message = {
			'from': 	$(sub_children[0]).html(),
			'date': 	date,
			'subject': 	$(sub_children[2]).html(),
			'content': 	$(sub_children[3]).html(),
			'from_id': 	$(sub_children[4]).html(),
		};

		$('#message_single_from').html(lang.messages_js.from + ": " + "<span>" + message.from + "</span>");	
		$('#message_single_subject').html(lang.messages_js.subject + ": " + "<span>" + message.subject + "</span>");
		$('#message_single_sent_date').html(lang.messages_js.sent + ": " + "<span>" + message.date + "</span>");
		$('#message_single_content').html(message.content);
		$('#message_single_user_from_id').html(message.from_id);

		removeLinkClass();
		showSingleBox();
	});

	if(typeof compose != 'undefined')
	{
		showComposeBox();
	}
	else{
		showInbox();
	}

	$('.message_delete').click(function(e){
		var outer = $(this).parent().children()[0];
		var props = $(outer).children();
		var messageId = props[props.length - 1].innerHTML;

		statusUpdate(messageId, 2);
		location.reload();
	});

	$('#reply_button').click(function(){
		showComposeBox();

		var message = {
			'to': 				$('#message_single_from span').html(),
			'subject': 			$('#message_single_subject span').html(),
			'content_header': 	lang.messages_js.reply_header,
			'content': 			$('#message_single_content').html(),
			'date'	 : 			$('#message_single_sent_date span').html(),
			'to_id': 			$('#message_single_user_from_id').html()
		}

		console.log(message);

		var sprintfParams = new Array(
			message.date,
			message.to
		);
		
		var r = new RegExp('&nbsp;', 'g');

		message.content_header += "\n\n";
		message.content_header = message.content_header.sprintf(sprintfParams);
		message.content_header = message.content_header.replace(r, ' ');

		$('#message_to_input').val(message.to);
		$('#message_subject_input').val(lang.messages_js.re + ": " + message.subject);
		$('#message_body').val(message.content_header + message.content);
		$('#to_id').val(message.to_id);
	});

	function hideAll()
	{
		$(allElements).each(function(i, e){
			$(e).hide();
		});
	}
	function removeLinkClass()
	{
		$(allLinks).each(function(i, e){
			$(e).removeClass('active');
		});
	}
	function showComposeBox()
	{
		hideAll();
		$(composeBox).show();
	}
	function showInbox()
	{
		hideAll();
		$(inboxBox).show();
	}
	function showSentBox()
	{
		hideAll();
		$(sentBox).show();
	}
	function showTrashBox()
	{
		hideAll();
		$(trashBox).show();
	}
	function showSingleBox()
	{
		hideAll();
		$(singleBox).show();
	}

	function statusUpdate(messageId, status)
	{

		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'messages_ajax.php',
			data: {'function': 'message_status_change', 'status': status, 'message_id': messageId},
			success: function(data){
				console.log(data);
			},
			error: function(jqxhr, status, error){
				console.log(status);
				console.log(error);
				console.log(error.message);
			}
		});
	}

});