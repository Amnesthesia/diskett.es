var ShowsController = Ember.ArrayController.extend({
	itemController: 'show',
	searchQuery: '',

	unwatchedShows: function(){
		var show = this.get('model');
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
	}.property('show.@each'),

	searchShows: function(){

	}
	
});

module.exports = ShowsController;

