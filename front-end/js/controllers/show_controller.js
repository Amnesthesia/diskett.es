var ShowController = Ember.ObjectController.extend({
	needs: "login",
	loginController: Ember.computed.alias("controllers.login"),
	nSeasons: 0,
	seasonSortedEpisodes: Ember.A(),
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
  			return "progress-bar-danger";
  		else if(rate < 5)
  			return "progress-bar-warning";
  		else if(rate < 7.5)
  			return "progress-bar-info";
  		else return "progress-bar-success";
  	}.property('rating'),
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
  		},
  		follow: function(){
  			if(!this.get('session').isAuthenticated)
  				this.get('loginController').toggleLogin();

  		}
  	}

});

module.exports = ShowController;

