// Define all dependencies
define(['jquery', 
		'ember',
		'handlebars',
		'app/models/episode'
		], 
// And then start our module
function ($,Ember){
	EpGuide.EpisodesController = Ember.ArrayController.extend({
		itemController: 'episode'
	});

	EpGuide.EpisodeController = Ember.ObjectController.extend({
		
	});
});