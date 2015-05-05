$(function(){
	getLessonRequests();
	getSent();
	getArchived();

	function getLessonRequests()
	{
		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'requests_ajax.php',
			data: {'function': 'get_requests'},
			dataType: "json",
			success: function(data){
				generateContent(data);
				// console.log(data);
				// $('#content').html('<pre>' + data + '</pre>');
			},
			error: function(jqxhr, status, error){
				console.log(status);
				console.log(error);
				console.log(error.message);
			}
		});
	}

	function generateSentContent(data)
	{

		if(data == 'null')
		{
			var html = '<div class="warning">{1}</div>'.sprintf(new Array(lang.lessons_js.no_requests));
		}
		else
		{
			var template = '<div class="lesson_wrap" data-request-id="{1}"><div class="lesson_from">{2}: {3} {4}</div><div class="flex"><div class="lesson_flex_item">{5}:</div><div class="lesson_flex_item">{6}:</div><div class="lesson_flex_item">{7}:</div><div class="lesson_flex_item">{8}:</div><div class="lesson_flex_item">{9}:</div></div><div class="flex"><div class="lesson_flex_item">{10}</div><div class="lesson_flex_item">{11}</div><div class="lesson_flex_item">{12}</div><div class="lesson_flex_item">{13}</div><div class="lesson_flex_item">{14}</div></div><div class="lesson_buttons">{15}</div><input type="hidden" value="{16}" class="lesson_request_status"></div>';
			var html = '';

			for(var i = 0; i < data.requests.length; i++)
			{
				var request = data.requests[i];
				var user = findUser(request.user_to_id, data.users);
				var lastName = (user.personal_details.last_name == 'null') ? user.personal_details.last_name : "";
				var statusString = 0;


				if(request.status == 0)
				{
					statusString = lang.lessons_js.pending;
				}
				else if(request.status == 1)
				{
					statusString = lang.lessons_js.accepted;
				}
				else if(request.status == 2)
				{
					statusString = lang.lessons_js.rejected;
				}
				statusString = '<span style="color:#FFF;">' + statusString + '</span>';
				
				var props = new Array(
									request.id,
									lang.lessons_js.to,
									user.personal_details.first_name,
									lastName,
									lang.lessons_js.date,
									lang.lessons_js.start_time,
									lang.lessons_js.end_time,
									lang.lessons_js.duration,
									lang.lessons_js.language,
									request.date,
									request.start_time,
									request.end_time,
									request.duration + " " + lang.lessons_js.minutes,
									request.language_code,
									statusString,
									request.status
								);

				html += template.sprintf(props);
			}
		}
		$('#lessons_sent_wrapper').html(html);

		var outer_wrap = $('#lessons_sent_wrapper').children();

		$(outer_wrap).each(function(index, element){
			var requestId = $(element).attr('data-request-id');
			var statusField = $(element).find('.lesson_request_status');
			var status = $(statusField).val();
			
			var attr = {'id': requestId, 'status': status};			
			updateRequestDisplay(attr);
		});

	}

	function getSent()
	{
		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'requests_ajax.php',
			data: {'function': 'get_sent'},
			dataType: "json",
			success: function(data){
				generateSentContent(data);
			},
			error: function(jqxhr, status, error){
				console.log(status);
				console.log(error);
				console.log(error.message);
			}
		});
	}

	function generateArchivedContent(data)
	{
		if(data == 'null')
		{
			var html = '<div class="warning">{1}</div>'.sprintf(new Array(lang.lessons_js.no_requests));
		}
		else
		{
			var template = '<div class="lesson_wrap" data-request-id="{1}"><div class="lesson_from">{2}: {3} {4}</div><div class="flex"><div class="lesson_flex_item">{5}:</div><div class="lesson_flex_item">{6}:</div><div class="lesson_flex_item">{7}:</div><div class="lesson_flex_item">{8}:</div><div class="lesson_flex_item">{9}:</div></div><div class="flex"><div class="lesson_flex_item">{10}</div><div class="lesson_flex_item">{11}</div><div class="lesson_flex_item">{12}</div><div class="lesson_flex_item">{13}</div><div class="lesson_flex_item">{14}</div></div></div>';
			var html = '';

			for(var i = 0; i < data.requests.length; i++)
			{
				var request = data.requests[i];
				var user = findUser(request.user_to_id, data.users);
				var lastName = (user.personal_details.last_name == 'null') ? user.personal_details.last_name : "";
				var statusString = 0;


				if(request.status == 0)
				{
					statusString = lang.lessons_js.pending;
				}
				else if(request.status == 1)
				{
					statusString = lang.lessons_js.accepted;
				}
				else if(request.status == 2)
				{
					statusString = lang.lessons_js.rejected;
				}
				statusString = '<span style="color:#FFF;">' + statusString + '</span>';
				
				var props = new Array(
									request.id,
									lang.lessons_js.to,
									user.personal_details.first_name,
									lastName,
									lang.lessons_js.date,
									lang.lessons_js.start_time,
									lang.lessons_js.end_time,
									lang.lessons_js.duration,
									lang.lessons_js.language,
									request.date,
									request.start_time,
									request.end_time,
									request.duration + " " + lang.lessons_js.minutes,
									request.language_code
								);

				html += template.sprintf(props);
			}
		}
		$('#lessons_archived_wrapper').html(html);

		var outer_wrap = $('#lessons_sent_wrapper').children();

		$(outer_wrap).each(function(index, element){
			var requestId = $(element).attr('data-request-id');
			var statusField = $(element).find('.lesson_request_status');
			var status = $(statusField).val();
			
			var attr = {'id': requestId, 'status': status};			
			updateRequestDisplay(attr);
		});
	}

	function getArchived()
	{
		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'requests_ajax.php',
			data: {'function': 'get_archived'},
			dataType: "json",
			success: function(data){
				console.log(data);
				generateArchivedContent(data);
			},
			error: function(jqxhr, status, error){
				console.log(status);
				console.log(error);
				console.log(error.message);
			}
		});
	}


	function changeRequestStatus(status, requestId)
	{
		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'requests_ajax.php',
			data: {'function': 'change_status', 'status': status, 'request_id': requestId},
			dataType: "json",
			success: function(data){
				updateRequestDisplay(data);
				// console.log(data);
				// $('#content').html('<pre>' + data + '</pre>');
			},
			error: function(jqxhr, status, error){
				console.log(status);
				console.log(error);
				console.log(error.message);
			}
		});
	}

	function generateContent(data)
	{
		if(data == 'null')
		{
			var html = '<div class="warning">{1}</div>'.sprintf(new Array(lang.lessons_js.no_requests));
		}
		else
		{
			var template = '<div class="lesson_wrap" data-request-id="{1}"><div class="lesson_from">{2}: {3} {4}</div><div class="flex"><div class="lesson_flex_item">{5}:</div><div class="lesson_flex_item">{6}:</div><div class="lesson_flex_item">{7}:</div><div class="lesson_flex_item">{8}:</div><div class="lesson_flex_item">{9}:</div></div><div class="flex"><div class="lesson_flex_item">{10}</div><div class="lesson_flex_item">{11}</div><div class="lesson_flex_item">{12}</div><div class="lesson_flex_item">{13}</div><div class="lesson_flex_item">{14}</div></div><div class="lesson_buttons"><button class="button_primary" data-request-id="{15}">{16}</button><button class="button_primary" data-request-id="{17}">{18}</button></div><input type="hidden" value="{19}" class="lesson_request_status"></div>';
			var html = '';

			for(var i = 0; i < data.requests.length; i++)
			{
				var request = data.requests[i];
				var user = findUser(request.user_from_id, data.users);
				var lastName = (user.personal_details.last_name == 'null') ? user.personal_details.last_name : "";

				var props = new Array(
									request.id,
									lang.lessons_js.from,
									user.personal_details.first_name,
									lastName,
									lang.lessons_js.date,
									lang.lessons_js.start_time,
									lang.lessons_js.end_time,
									lang.lessons_js.duration,
									lang.lessons_js.language,
									request.date,
									request.start_time,
									request.end_time,
									request.duration + " " + lang.lessons_js.minutes,
									request.language_code,
									request.id,
									lang.lessons_js.accept,
									request.id,
									lang.lessons_js.reject,
									request.status
								);

				html += template.sprintf(props);
			}

		}

		$('#lessons_wrapper').html(html);

		$('.lesson_buttons').each(function(index, el){
			$(el).children().each(function(index, element){
				if(index == 0)
				{
					$(element).click(function(){
						changeRequestStatus(1, $(element).attr('data-request-id'));
					});
				}
				else
				{
					$(element).click(function(){
						changeRequestStatus(2, $(element).attr('data-request-id'));
					});
				}
			});
		});

		$('.lesson_wrap').each(function(index, element){
			var status = $(element).find('.lesson_request_status').val();

			if(status != 0)
			{
				if(status == 1)
				{
					$(element).find('.lesson_buttons').css({ 'background': '#0D0' });
					$(element).find('.lesson_buttons').html(lang.lessons_js.accepted);
				}
				else if(status == 2)
				{
					$(element).find('.lesson_buttons').css({ 'background': '#D00' });
					$(element).find('.lesson_buttons').html(lang.lessons_js.rejected);
				}
			}

		});

		$('.loading').remove();

	}

	$('#lessons_sent_wrapper').hide();
	$('#lessons_archived_wrapper').hide();
	$('#lessons_received_link').click(function(e){
		e.preventDefault();
		$('#lessons_sent_wrapper').hide();
		$('#lessons_archived_wrapper').hide();
		$('#lessons_wrapper').show();
		$(this).addClass('active');
		$('#lessons_sent_link').removeClass('active');
		$('#lessons_archived_link').removeClass('active');
	});
	$('#lessons_sent_link').click(function(e){
		e.preventDefault();
		$('#lessons_wrapper').hide();
		$('#lessons_archived_wrapper').hide();
		$('#lessons_sent_wrapper').show();
		$(this).addClass('active');
		$('#lessons_received_link').removeClass('active');
		$('#lessons_archived_link').removeClass('active');
	});
	$('#lessons_archived_link').click(function(e){
		e.preventDefault();
		$('#lessons_sent_wrapper').hide();
		$('#lessons_wrapper').hide();
		$('#lessons_archived_wrapper').show();
		$(this).addClass('active');
		$('#lessons_received_link').removeClass('active');
		$('#lessons_sent_link').removeClass('active');
	});

	function findUser(needle, haystack)
	{
		for(var i = 0; i < haystack.length; i++)
		{
			if(needle == haystack[i].user.id)
			{
				return haystack[i];
			}
		}
	}
	
	function updateRequestDisplay(data)
	{
		var tag = '.lesson_wrap[data-request-id=' + data.id + ']';
		var buttonContainer = $(tag).find('.lesson_buttons');

		if(data.status == 1)
		{
			$(buttonContainer).css({ 'background': '#0D0' });
			$(buttonContainer).html(lang.lessons_js.accepted);
		}
		else if(data.status == 2)
		{
			$(buttonContainer).css({ 'background': '#D00' });
			$(buttonContainer).html(lang.lessons_js.rejected);
		}
		else if(data.status == 0)
		{
			$(buttonContainer).css({ 'background': '#DDD' });
			$(buttonContainer).html(lang.lessons_js.pending);
		}
		
	}

	



});

/*
	<div class="lesson_wrap" data-request-id="{1}">
		<div class="lesson_from">{2}: {3} {4}</div>
		<div class="flex">
			<div class="lesson_flex_item">{5}:</div>
			<div class="lesson_flex_item">{6}:</div>
			<div class="lesson_flex_item">{7}:</div>
			<div class="lesson_flex_item">{8}:</div>
			<div class="lesson_flex_item">{9}:</div>
		</div>
		<div class="flex">
			<div class="lesson_flex_item">{10}</div>
			<div class="lesson_flex_item">{11}</div>
			<div class="lesson_flex_item">{12}</div>
			<div class="lesson_flex_item">{13}</div>
			<div class="lesson_flex_item">{14}</div>
		</div>
		<div class="lesson_buttons">
			<button class="button_primary" data-request-id="{15}">{16}</button>
			<button class="button_primary" data-request-id="{17}">{18}</button>
		</div>
		<input type="hidden" value="{19}" class="lesson_request_status">
	</div>
*/