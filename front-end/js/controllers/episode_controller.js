var EpisodeController = Ember.ObjectController.extend({
  destroy: function() {
    if (!confirm('Are you sure?')) return;
    this.get('model').deleteRecord();
    this.get('store').commit();
    this.get('target.router').transitionTo('episodes');
  },

  episodeNum: function(){
  	var id = this.get('episode_id').split(',');
  	return id[2];
  }.property('episode_id')

});

module.exports = EpisodeController;

