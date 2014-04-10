define(['jquery', 'ember','handlebars'], function ($,Ember) {
	window.EpGuide = Ember.Application.create();

	EpGuide.ApplicationAdapter = DS.FixtureAdapter.extend();
});