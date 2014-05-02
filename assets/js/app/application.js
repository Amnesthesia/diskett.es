define(['jquery', 'ember','ember-data','handlebars'], function ($,Ember,null,handlebars) {

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

	

});