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
  		var show = this;
  		return this.get('session.account').then(function(acc){
	  		return acc.get('shows').then(function(s){
	  			if(s.contains(show.get('model')))
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
	  		
  		});
  		
  	}.property('session').volatile(),

  	isFollowing: function(){
  		return !this.get('notFollowing');
  	}.property('notFollowing').volatile(),

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
  		console.log("Running");
  		// Skip this if user is not logged in
  		if(!this.get('session').isAuthenticated)
  			return Ember.A();
  		console.log("Is logged in");

  		if(!Ember.isEmpty(this.get('seenEpisodes')))
  			return this.get('seenEpisodes');
  		console.log("Non empty array");
  		Ember.$.ajax({
  			url: '/'+App.APINamespace+"/seen",
  			type: 'GET',
  			data: Ember.$.param({token: this.get('session.token'), sid: this.get('id')}),
		}).then(function(data){
			var arr = Ember.$.parseJSON(data);
  			console.log(arr);
  			console.log("Ajax call finished with "+data);
  			// Break on empty response
  			if(Ember.isEmpty(arr))
  				return Ember.A();
    		this.set('seenEpisodes',arr);
		});

		
		return this.get('seenEpisodes');
  	}.property('seenEpisodes','session.token').volatile(),

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
	  		var session = this.get('session');
	  		this.get('session.account').then(function(u){
	  			console.log("Attempting to follow show "+show.get('id')+" on user account "+u.get('id')+" with session token "+session.get('token'));
		  		console.log(Ember.$.param({uid: u.get('id'), sid: show.get('id')}));
		  		// We avoid using Ember's store here, because we do not want to 
		  		// send the WHOLE user object and ALL of the shows with it. 
		  		// We consider this unnecessary, and instead we make a simple, custom
		  		// PUT request with only the user's ID, the show ID and the token.
		  		



	  		});

	  		// Run an AJAX call against the server to mark the show as followed
	  		Ember.$.ajax({
	  			url: '/'+App.APINamespace+"/follow",
	  			type: 'GET',
	  			data: Ember.$.param({token: this.get('session.token'), sid: this.get('id')}),
	  			success: function(data) {
	    			console.log('Server returned '+data+" after attempting to follow show "+show.get('id'));
	  				console.log("Successfully followed show.");
	
	  				session.get('account').then(function(u){
	  					if(u.get('shows').contains(show))
	  					{
	  						console.log("Show found in user session; removing...");
	  						u.get('shows').removeObject(show);
	  					}
	  					else{
	  						console.log("Show not found in user session; adding...")
	  						u.get('shows').pushObject(show);
	  					}
	  				});
	  				Ember.$("#"+show.get('id')).hide("slideLeft");
	  			}
			});
	  	}

  	}

});

module.exports = ShowController;

