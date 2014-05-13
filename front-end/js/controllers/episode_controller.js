var EpisodeController = Ember.ObjectController.extend({


  // Return the episode number (the number within the season)
  episodeNum: function(){
  	
  	var id = this.get('id').split(',');

  	return id[2];
  }.property('episode_id'),

  show: function(){
  	//console.log("Trying to find show with id" + this.get('show_id'));

  	var show = this.get('store').find('show',this.get('show_id'));

  	return show;
  }.property('show_id')

});

module.exports = EpisodeController;

