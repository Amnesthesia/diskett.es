define(['ember','ember-data'], function ($,Ember){
	
	EpGuide.Country = DS.Model.extend({
		summary: 	DS.attr("string"),
		language: 	DS.attr("string"),
		channels: 	DS.hasMany("EpGuide.Channel")
	});
});