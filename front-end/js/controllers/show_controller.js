var ShowController = Ember.ObjectController.extend({
	needs: "shows",
	query: function(){return this.get('controllers.shows.search_text')}.property('controllers.shows.search_text'),

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

  		if(this.get('session.account.shows').contains(this.get('model')))
  		{
  			console.log("Show model found in users watchlist - graying out follow button");
  			return false;
  		}
  		else
  		{
  			console.log("Show model not found in users watchlist - displaying element");
  			return true;
  		}
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

  	// Returns rating as length for the rating progress bar
  	ratingLength: function(){ 
    	return (this.get('rating').toFixed(1)*10);
  	}.property('rating'),
  	// Returns rating as text to display on the rating progress bar
  	ratingText: function(){
  		return (this.get('rating').toFixed(1));
  	}.property('rating'),

  	// Returns the type of bootstrap progressbar to display for rating
  	progressType: function(){
  		if( this.get('rating') == null)
  			return "progress-bar-warning";
  		var rate = this.get('rating').toFixed(1);
  		if(rate < 2.5)
  			return "progress-bar-info";
  		else if(rate < 5)
  			return "progress-bar-info";
  		else if(rate < 7.5)
  			return "progress-bar-warning";
  		else return "progress-bar-danger";
  	}.property('rating'),

  	// Return true if the user is not following this show item
  	isNotWatched: function(){
  		if(this.get('session').isAuthenticated)
  		{
  			if(this.get('session.account.shows') != 'undefined' && this.get('session.account.shows').contains(this.get('model').get('id')))
  			{
  				console.log("User is not watching "+this.get('name')+": Adding to grid");
  				return true;
  			}
  			else{
  				console.log("User already watches "+this.get('name')+": Hiding from grid");
  				return false;
  			}
  		}
  		else{
  			console.log("Could not get session - assuming logged out user and displaying full grid");
  		}
  		return false;
  	}

});

module.exports = ShowController;

