$(function(){
	$('#duration_calculation').addClass('red');
	$('#duration_calculation').html(lang.lesson_request_js.invalid_duration);

	// client-side form validation
	$.validator.setDefaults({ ignore: [], });
	$.validator.addMethod("greaterThanZero", function(value, element){
		return this.optional(element) || (parseInt(value) > 0);
	});

	$('#sendlessonrequestform').validate({
		errorClass: "form_input_invalid",

		rules: {
			req_date: {
				required: true,
			},
			req_duration_min: { 
				greaterThanZero: true,
			}
		},
		messages: {
			req_date: {
				required: lang.lesson_request_js.please_choose_date,
			},
			req_duration_min: {
				greaterThanZero: "",
			}
		}
	});

	var timepickerSettings = {};
	timepickerSettings.timeFormat = "H:i";
	timepickerSettings.forceRoundTime = true;
	timepickerSettings.useSelect = true;


	var today = new Date();
	$('#datepicker').datepicker({
		"dateFormat": "dd-mm-yy",
		"minDate": today
	});

	$('#starttime').timepicker(timepickerSettings);
	$('#starttime').on('changeTime', function(){ calculateDuration(); });
	$('#endtime').timepicker(timepickerSettings);
	$('#endtime').on('changeTime', function(){ calculateDuration(); });

	function calculateDuration()
	{
		var startTime = $('#starttime').val();
		var endTime = $('#endtime').val();
		
		if(startTime != '' && endTime != '')
		{
			startTime = startTime.match(/\d\d/g);
			endTime = endTime.match(/\d\d/g);

			var durationHr = parseInt(endTime[0]) - parseInt(startTime[0]);
			var durationMin = parseInt(endTime[1]) - parseInt(startTime[1]);

			if(durationMin == -30)
			{
				durationHr -= 1;
				durationMin *= -1;
			}

			var minutes = (durationHr * 60) + durationMin;

			if (minutes <= 0)
			{
				$('#duration_calculation').addClass('red');
				$('#duration_calculation').html(lang.lesson_request_js.invalid_duration);
			}
			else
			{
				var durHrStr = durationHr.toString();
				durHrStr = (durHrStr.length == 2) ? durHrStr : "0" + durHrStr;

				var durMinStr = durationMin.toString();
				durMinStr = (durMinStr.length == 2) ? durMinStr : "0" + durMinStr;

				$('#duration_calculation').removeClass('red');
				$('#req_duration_min').val(minutes);
				$('#duration_calculation').html(durHrStr + ":" + durMinStr);
			}

		}
	}


});