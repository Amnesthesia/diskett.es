define(['ember','ember-data'], function (Ember){
	
	EpGuide.Episode = DS.Model.extend({
		show_id: 	DS.attr("number"),
		episode_id: DS.attr("number"),
		season: 	DS.attr("number"),
		poster: 	DS.attr("string"),
		date: 		DS.attr("date"),
		name: 		DS.attr("string"),
		summary: 	DS.attr("string"),
		watched: 	DS.attr("boolean"),
		show: 		DS.belongsTo("EpGuide.Show")
	});
});