$(function(){

	String.prototype.sprintf = function(values)
	{
		var template = this;
		var max_replace = values.length;

		for(var i = 0; i < max_replace; i++)
		{
			var replacement_tag = "{" + (i + 1) + "}";
			template = template.replace(replacement_tag, values[i]);
		}

		return template;
	};

	
});