$(function(){

	$.ajax({
		type: "POST",
		url: CONSTANTS.AJAX_URL + 'search_ajax.php',
		data: {'function': 'get_users', 'languages_learn': languages_learn, 'languages_spoken': languages_spoken},
		dataType: "json",
		success: function(data){
			// console.log(data);
			generateContent(data);
		},
		error: function(jqxhr, status, error){
			console.log(status);
			console.log(error);
			console.log(error.message);
		}
	});

	function generateContent(data)
	{
		var template = '<div class="search_user_wrap"><div class="search_user_header_wrap"><div class="search_user_avatar"></div><div class="search_user_name">{1} {2}</div><div class="search_user_buttons"><form action="{3}" method="POST"><input type="hidden" value="{4}" name="message_user_id"><input type="submit" value="Message"></form><form action="{5}" method="POST"><input type="hidden" value="{6}" name="request_user_id"><input type="submit" value="Lesson Request"></form></div>	</div><div class="search_user_details"><div class="search_user_details_item">Age: {7}</div><div class="search_user_details_item">Location: {8}, {9}</div><div class="search_user_details_item">Gender: {10}</div></div><div class="search_user_languages_wrap"><div class="search_user_languages_item"><h4>Speaks</h4><div class="search_user_languages_item_half_box"><ul>{11}</ul><ul>{12}</ul></div></div><div class="search_user_languages_item"><h4>Wants to learn</h4><ul>{13}</ul></div></div><div class="search_user_description"><h3>Description</h3>{14}</div></div>';
		var html = "";

		for(var i = 0; i < data.length; i++)
		{
			var user 						= data[i].user;
			var details 					= data[i].personal_details;
			var _languages_spoken 			= data[i].languages_spoken;
			var _languages_learn 			= data[i].languages_learn;
			var age 						= (details.age == null) ? lang.search_page_js.not_given : details.age;
			var city 						= (details.city == null) ? lang.search_page_js.not_given : details.city;
			var lessonRequestUrl 			= CONSTANTS.PAGES_URL + 'lessonrequest.php';
			var messageUrl 					= CONSTANTS.PAGES_URL + 'messages.php';
			var levels 						= generateLevelString(_languages_spoken);
			var languages_spoken_string 	= generateLanguageString('spoken', _languages_spoken, languages_learn);
			var languages_learn_string 		= generateLanguageString('learn', _languages_learn, languages_spoken);

			html += template.sprintf(
						Array(
							details.first_name,
							details.last_name,
							messageUrl,
							user.id,
							lessonRequestUrl,
							user.id,
							age,
							details.country_code,
							details.city,
							details.gender,
							languages_spoken_string,
							levels,
							languages_learn_string,
							details.profile_description
						)
				);
		}

		$('.loading').remove();
		$('#search_wrap').html(html);
	}	

	function generateLanguageString(type, langArray, toCompare)
	{
		var ret = "";
		var codes = new Array();

		if(type == 'spoken')
		{
			for(var i = 0; i < langArray.length; i++)
			{
				codes.push(langArray[i].language_spoken.language_code);
			}
		}
		else if(type == 'learn')
		{
			for(var i = 0; i < langArray.length; i++)
			{
				codes.push(langArray[i].language_learn.language_code);
			}
		}

		for(var i = 0; i < langArray.length; i++)
		{
			if(type == 'spoken')
			{
				if(toCompare.indexOf(langArray[i].language_spoken.language_code) != -1)
				{
					ret += '<li class="language_highlight">';
				}
				else
				{
					ret += '<li>';
				}
			}
			else if(type == 'learn')
			{
				if(toCompare.indexOf(langArray[i].language_learn.language_code) != -1)
				{
					ret += '<li class="language_highlight">';
				}
				else
				{
					ret += '<li>';
				}
			}

			ret += langArray[i].language_name;
			ret += '</li>';
		}

		return ret;
	}

	function generateLevelString(l_spoken)
	{
		var str = "";

		for(var i = 0; i < l_spoken.length; i++)
		{
			str += "<li>" + l_spoken[i].language_level_string + "</li>";
		}

		console.log(str);

		return str;
	}

});

/*
	<div class="search_user_wrap">
	<div class="search_user_header_wrap">
		<div class="search_user_avatar"></div>
		<div class="search_user_name">{1} {2}</div>
		<div class="search_user_buttons">
			<form action="{3}" method="POST">
				<input type="hidden" value="{4}" name="message_user_id">
				<input type="submit" value="Message">
			</form>
			<form action="{5}" method="POST">
				<input type="hidden" value="{6}" name="request_user_id">
				<input type="submit" value="Lesson Request">
			</form>
		</div>
	</div>
	<div class="search_user_details">
		<div class="search_user_details_item">Age: {7}</div>
		<div class="search_user_details_item">Location: {8}, {9}</div>
		<div class="search_user_details_item">Gender: {10}</div>
	</div>
	<div class="search_user_languages_wrap">
		<div class="search_user_languages_item">
			<h4>Speaks</h4>
			<div class="search_user_languages_item_half_box">
				<ul>
					{11}
				</ul>
				<ul>
					{12}
				</ul>
			</div>
		</div>
			
		<div class="search_user_languages_item">
			<h4>Wants to learn</h4>
			<ul>
				{13}
			</ul>
		</div>
	</div>
	<div class="search_user_description">
		<h3>Description</h3>
			{14}
	</div>
</div>
*/