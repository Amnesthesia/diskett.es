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
  }.property('show_id'),

  // Has user seen this episode?
  hasSeen: function(){
  	if(this.get('session').isAuthenticated)
  	{
  		if(typeof this.get('session.account.episodes') !== 'undefined' && this.get('session.account.episodes').contains(this.get('model')))
  			return true;
  		else
  			return false;
  	}
  	return false;
  }.property(),

  actions: {
  	watchedEpisode: function(){
        if(!this.get('session').isAuthenticated)
          return;
        
        console.log("Attempting to follow episode with ID "+this.get('id'));

        // Push object into users episode array
        this.get('session.account.episodes').pushObject(this.get('model'));
        this.get('session.account').then(function(response){
         response.save();
        });
        // Add class to episode
        Ember.$("#"+this.get('id')).addClass("episode-watched");
      }
  }

});

module.exports = EpisodeController;

