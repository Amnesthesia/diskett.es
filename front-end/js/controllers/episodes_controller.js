var EpisodesController = Ember.ArrayController.extend({
	itemController: 'episode',

	// Sort on season first, then episode
	sortProperties: ['season','episodeNum']

});

module.exports = EpisodesController;

