var ShowController = Ember.ObjectController.extend({
	needs: "login",
	loginController: Ember.computed.alias("controllers.login"),
	nSeasons: 0,
	seasonSortedEpisodes: Ember.A(),
  	
  	// Returns true if the user is logged in
  	isLoggedIn: function(){
  		return this.get('session').isAuthenticated;
  	}.property('session'),

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
  		var rate = this.get('rating').toFixed(1);
  		if(rate < 2.5)
  			return "progress-bar-info";
  		else if(rate < 5)
  			return "progress-bar-info";
  		else if(rate < 7.5)
  			return "progress-bar-warning";
  		else return "progress-bar-danger";
  	}.property('rating'),
  	isNotWatched: function(){
  		if(this.get('session').isAuthenticated)
  		{
  			if(this.get('session.account.shows').contains(this.get('model').get('id')))
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
  	},
  	seasonCount: function(){
  		var season = 0;
  		if(this.get('nSeasons')>0)
  			return this.get('nSeasons');

  		this.get('episodes').forEach(function(ep){
  			if(ep.get('season')>season)
  				season = ep.get('season');
  		});
  		this.set('nSeasons',season);
  		return season;

  	},
  	seasonSort: function(){
  		var loop;
  		for(loop = 1; loop <= this.get('seasonCount'); loop=loop+1)
  		{
  			var eps = Ember.A();
  			this.get('episodes').filterBy('season',loop).forEach(function(ep){
  				eps.pushObject(ep);
  			});	
  			this.get('seasonSortedEpisodes').pushObject(eps);
  		}
  			
  	},
  	getEpisodesBySeason: function(){
  		this.seasonSort();
  		return this.get('seasonSortedEpisodes');
  	}.property('seasonSortedEpisodes'),
  	actions: {
  		destroy: function() {
    	if (!confirm('Are you sure?')) return;
    	this.get('model').deleteRecord();
    	this.get('store').commit();
    	this.get('target.router').transitionTo('shows');
  		}
  	}

});

module.exports = ShowController;

