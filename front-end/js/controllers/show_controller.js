var ShowController = Ember.ObjectController.extend({
	needs: "login",
	loginController: Ember.computed.alias("controllers.login"),
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
  	episodeList: function(){
  		return this.get('episodes');
  	}.property('episodes'),
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

