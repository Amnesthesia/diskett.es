define(['jquery', 'ember','handlebars','ember-data'], function ($,Ember) {

	window.EpGuide = Ember.Application.create({
		LOG_TRANSITIONS: true,
    	LOG_BINDINGS: true,
    	LOG_VIEW_LOOKUPS: true,
    	LOG_STACKTRACE_ON_DEPRECATION: true,
    	LOG_VERSION: true,
    	debugMode: true
	});
	EpGuide.Store = DS.Store.extend();

	

	EpGuide.ApplicationAdapter = DS.RESTAdapter.extend({ namspace: 'api' });
	DS.RESTAdapter.reopen({
		namespace: 'api'
	});


	// Load partials
	requirejs(["app/partials"]);

	// Load our animations module :-)
	requirejs(["app/animations"]);

	// Load the Ember router and controllers
	requirejs(["app/router"]);
	requirejs(["app/controllers/episode"]);
	requirejs(["app/controllers/show"]);

	// Load the views!
	requirejs(["app/views/grid"]);
	

});