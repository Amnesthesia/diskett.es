define(['jquery', 'ember','ember-data','handlebars'], function ($,Ember){
	
	EpGuide.Show = DS.Model.extend({
		id: 		DS.attr("number"),
		imdb_id: 	DS.attr("number"),
		zap2_id: 	DS.attr("number"),
		channel_id: DS.attr("number"),
		poster: 	DS.attr("string"),
		pilot_date: DS.attr("date"),
		name: 		DS.attr("string"),
		summary: 	DS.attr("string"),
		lang: 		DS.attr("string"),
		rating: 	DS.attr("number"),
		watched: 	DS.attr("boolean")
	});
});