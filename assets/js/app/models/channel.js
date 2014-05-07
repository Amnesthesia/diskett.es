define(['ember','ember-data'], function ($,Ember){
	
	EpGuide.Channel = DS.Model.extend({
		name: 		DS.attr("string"),
		country_id: DS.attr("number"),
		country: 	DS.belongsTo("EpGuide.Country")
	});
});