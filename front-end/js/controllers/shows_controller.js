var ShowsController = Ember.ArrayController.extend({
	itemController: 'show',
	searchQuery: '',
	content: [],
	needs: 'show',
	showController: Ember.computed.alias('showController'),

	searchShows: function(){

	}
	
});

module.exports = ShowsController;

