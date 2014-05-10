Ember.Handlebars.helper('modalbox', function(value) {
	return Handlebars.SafeString('<div id="modalbox">'+Handlebars.compile(value)+"</div>");
});

