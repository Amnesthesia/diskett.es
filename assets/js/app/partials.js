define(['jquery','handlebars'], function ($,handlebars) {

	// Create some partials for the index page (navigation, login, etc)
	//loadPartial("navigation","#navigation",{});
	//loadPartial("signuplogin","#signuplogin",{});
	loadPartial("nav","#navigation",{});

	function loadPartial(name, target, options)
	{
		
		var rawTemplate = $.ajax({
			url: "partials/"+name+".html",
			cache: true,
			success: function(data){
				var compiled = Handlebars.compile(data);
				var tmpl = compiled(options);
				console.log("Loaded partial" + name + ".html");
				$(target).html(tmpl);
			}
		});
	}
});