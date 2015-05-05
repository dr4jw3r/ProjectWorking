$(function(){

	var genderFilter = '[value="' + settings_gender + '"]';

	//Pre-set settings
	$('#settings_country').val(settings_selected_country);
	$('input:radio[name="gender"]').filter(genderFilter).attr('checked', true);

	//Textarea character counter
	var counter = $('#desc_char_counter');
	var textArea = $('#profile_desc');
	var maxChars = $('#profile_desc').attr('maxlength');

	function updateCounter()
	{
		var charsLeft = maxChars - $(textArea).val().length;
		$(counter).html(charsLeft + " " + lang.settings_page_js.chars_left);
	}

	//Update after page load
	updateCounter();

	//KEYUP for the textarea
	$('#profile_desc').keyup(function()
	{
		updateCounter();
	});


	$('#add_new_language_spoken').click(function(e)
	{
		$('#temp_message_box').remove();

		var lang = $('#language_add_lang').val();
		var level = $('#language_add_level').val();

		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'settings_ajax.php',
			data: {'function': 'add_language', 'language': lang, 'level': level},
			success: function(data){
				location.reload();
			},
			error: function(){}
		});

	});

	$('.remove_language_btn').each(function(index, element)
	{
		$(element).click(function()
		{
			var lang = $(element).attr("data-code");
			var id = $(element).attr("data-userid");

			$.ajax({
				type: "POST",
				url: CONSTANTS.AJAX_URL + 'settings_ajax.php',
				data: {'function': 'remove_language', 'language': lang, 'id': id},
				success: function(data){
					location.reload();
				},
				error: function(){}
			});			
		});
	});

	$('#add_new_language_to_learn').click(function()
	{
		$('#temp_message_box_alt').remove();

		var lang = $('#to_learn_add_select').val();

		$.ajax({
			type: "POST",
			url: CONSTANTS.AJAX_URL + 'settings_ajax.php',
			data: {'function': 'add_language_to_learn', 'language': lang},
			success: function(data){
				location.reload();
			},
			error: function(){}
		});
	});

	$('.remove_language_to_learn_btn').each(function(index, element)
	{
		$(element).click(function()
		{
			var lang = $(element).attr("data-code");
			var id = $(element).attr("data-userid");

			$.ajax({
				type: "POST",
				url: CONSTANTS.AJAX_URL + 'settings_ajax.php',
				data: {'function': 'remove_language_to_learn', 'language': lang, 'id': id},
				success: function(data){
					location.reload();
				},
				error: function(){}
			});			
		});
	});

	function updateLanguageBoxAdd(data)
	{
		// lopts_content
		var outerItem = document.createElement('div');
		var loptsLeft = document.createElement('div');
		var loptsCenter = document.createElement('div');
		var loptsRight = document.createElement('div');

		$(outerItem).addClass('lopts_item flex');
		$(loptsLeft).addClass('lopts_left');
		$(loptsCenter).addClass('lopts_center table_heading_center');
		$(loptsRight).addClass('lopts_right flex');

		alert(data);
	}

});