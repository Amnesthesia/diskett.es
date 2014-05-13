var EpisodeController = Ember.ObjectController.extend({

  destroy: function() {
    if (!confirm('Are you sure?')) return;
    this.get('model').deleteRecord();
    this.get('store').commit();
    this.get('target.router').transitionTo('episodes');
  },

  episodeNum: function(){
  	
  	var id = this.get('id').split(',');

  	return id[2];
  }.property('episode_id'),

  getTime: function(){
  	return this.get('date').getTime();
  }.property('date'),

  showname: function(){
  	return this.get('show_id');
  }.property('show'),

  getMonthNumber: function(){
  	return this.get('date').getMonth();
  }.property(),

  getYearNumber: function(){
  	return (1900+this.get('date').getYear());
  }.property(),

  getDayNumber: function(){
  	return this.get('date').getDate();
  }.property()

});

module.exports = EpisodeController;

