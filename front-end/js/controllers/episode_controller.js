var EpisodeController = Ember.ObjectController.extend({

 needs: "show",

 show: function(){
  	//console.log("Trying to find show with id" + this.get('show_id'));

  	//var show = this.get('store').find('show',this.get('show_id'));

  	return this.get('show');
  }.property('show'),

  // Has user seen this episode?
  hasSeen: function(){
  	if(this.get('session').isAuthenticated)
  	{
  		if(this.get('show.userSeenEpisodes').contains(this.get('id')))
  			return true;
  		else
  			return false;
 
  	}
  	return false;
  }.property('session','show','id'),

  actions: {
  	toggleWatch: function(){
        if(!this.get('session').isAuthenticated)
          this.transitionToRoute('login');
        
  		var episode = this;
  		var user = this.get('session.account');

  		// Check if the episode is contained in the array for episodes the user has
  		// seen in this show
  		//if(this.get('hasSeen'))
  		//	this.get('show').then(function(s){ s.get('userSeenEpisodes').removeObject(this.get('id'))});
  		//else
  		//	this.get('show.userSeenEpisodes').then(function(s){ s.get('userSeenEpisodes').pushObject(this.get('id'))});

  		// Now perform the toggle-request to the server as well :)
  		Ember.$.ajax({
  			url: '/'+App.APINamespace+"/watch",
  			type: 'GET',
  			data: Ember.$.param({token: this.get('session.token'), eid: episode.get('id')}),
  			success: function(data) {
    			console.log('Server returned '+data+" after attempting to follow episode "+episode.get('id'));
  				console.log("Successfully followed show.");
			}	
		});
	  	
        // Add class to episode
        Ember.$("#"+this.get('id')).toggleClass("episode-watched");
      
  	}
  }

});

module.exports = EpisodeController;

