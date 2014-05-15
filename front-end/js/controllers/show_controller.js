var ShowController = Ember.ObjectController.extend({
	needs: "shows",
	query: function(){return this.get('controllers.shows.search_text')}.property('controllers.shows.search_text'),
	seenEpisode: Ember.A(),

  	// Returns true if the user is logged in
  	isLoggedIn: function(){
  		return this.get('session').isAuthenticated;
  	}.property('session'),

  	// Returns true if the user is not following this show item
  	notFollowing: function(){
  		if(!this.get('session').isAuthenticated)
  		{
  			console.log("User is not authenticated. Displaying show.")
  			return true;
  		}

  		return this.get('session.account').then(function(acc){
	  		if(acc.contains(this.get('model')))
	  		{
	  			console.log("Show model found in users watchlist - graying out follow button");
	  			return false;
	  		}
	  		else
	  		{
	  			console.log("Show model not found in users watchlist - displaying element");
	  			return true;
	  		}
  		});
  		
  	}.property('session'),

  	// Returns true if the name of the show matches the current search query
  	matchFilter: function(){
  		// If there's text in the query ...
  		if(this.get('query')!==null)
  		{
  			// Set up a case insensitive regex and return comparison result
  			var text = new RegExp(this.get('query'),'i');
  			if(this.get('name').match(text))
  				return true;
  			else
  				return false;
  			
  		}
  		return true;
  	}.property('name').volatile(),

  	// Check what episode the user has seen in this series
  	userSeenEpisodes: function(){
  		// Skip this if user is not logged in
  		if(!this.get('session').isAuthenticated)
  			return;

  		if(!Ember.isEmpty(this.get('seenEpisodes')))
  			return this.get('seenEpisodes');

  		Ember.$.ajax({
  			url: '/'+App.APINamespace+"/seen",
  			type: 'GET',
  			data: Ember.$.param({token: this.get('session.token'), sid: episode.get('id')}),
  			success: function(data) {
  				var arr = Ember.$.parseJSON(data);
  				console.log(arr);

  				// Break on empty response
  				if(Ember.isEmpty(arr))
  					return;
    			this.get('seenEpisodes',arr);
    		}
		});
  	}.property('seenEpisodes','session.token'),

  	// Returns rating as length for the rating progress bar
  	ratingLength: function(){ 
    	return (this.get('rating')*10);
  	}.property('rating'),
  	// Returns rating as text to display on the rating progress bar
  	ratingText: function(){
  		return (this.get('rating'));
  	}.property('rating'),

  	// Returns the type of bootstrap progressbar to display for rating
  	progressType: function(){
  		if( this.get('rating') === null)
  			return "progress-bar-warning";
  		var rate = this.get('rating');
  		if(rate < 2.5)
  			return "progress-bar-info";
  		else if(rate < 5)
  			return "progress-bar-info";
  		else if(rate < 7.5)
  			return "progress-bar-warning";
  		else return "progress-bar-danger";
  	}.property('rating'),


  	actions: {
  		// Let a user follow a show if the user is logged in and has a token
	  	follow: function(){
	  		
	  		// This method will not proceed unless user is authenticated
	  		if(!this.get('session').isAuthenticated)
	  			 this.transitionTo('login');
	  		
	  		var show = this;
	  		var user = this.get('session.account');
	  		console.log("Attempting to follow show "+this.get('id')+" on user account "+this.get('session.account.id')+" with session token "+this.get('session.token'));
	  		console.log(Ember.$.param({uid: this.get('session.account.id'), sid: this.get('id')}));
	  		// We avoid using Ember's store here, because we do not want to 
	  		// send the WHOLE user object and ALL of the shows with it. 
	  		// We consider this unnecessary, and instead we make a simple, custom
	  		// PUT request with only the user's ID, the show ID and the token.
	  		
	  		// If there are no shows in users show array yet, set up empty array
	  		if(Ember.isEmpty(user.get('shows')) || typeof user.get('shows') === 'undefined') 
  					user.set('shows',Ember.A());


	  		Ember.$.ajax({
	  			url: '/'+App.APINamespace+"/follow",
	  			type: 'GET',
	  			data: Ember.$.param({token: this.get('session.token'), sid: this.get('id')}),
	  			success: function(data) {
	    			console.log('Server returned '+data+" after attempting to follow show "+show.get('id'));
	  				console.log("Successfully followed show.");
	
	  				user.get('shows').pushObject(show);
	  				Ember.$("#"+show.get('id')).hide("slideLeft");
	  			}
			});
	  	}

  	}

});

module.exports = ShowController;

