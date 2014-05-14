var CalendarRoute = Ember.Route.extend(Ember.SimpleAuth.AuthenticatedRouteMixin,{
	model: function(params) {
  	console.log("Retrieving user shows ...");

  	console.log("Year "+params.yearnow+" month"+params.monthnow)
  	if(typeof this.get('session.account.shows') === 'undefined')
  		return eps;

  	// We only want episodes aired within the past 3 months, or in the future.
  	// This method should sort out all episodes from
  	// all shows the user is currently watching, and make sure these
  	// are in the future, or at least recent. We assume users have no reason
  	// to look at the calendar that far back.
  	
  	// Set up an array to keep all our episode objects in
  	var eps = Ember.A();

  	// Check the current date
  	var currentTime = new Date().getTime();

  	// Maximum time difference in milliseconds
  	var timeDiff = 1000*60*60*24*90;


  	// Iterate through all shows in the users session
    this.get('session.account.shows').forEach(function(show){
    	
    	// Iterate through all episodes for each show
    	show.get('episodes').forEach(function(ep){
    		if(ep.get('date')==null)
    			return;
    		// Check if air date is less than time difference, or
    		// if air date is in the fuuuuuuuuuture
    		var epTime = ep.get('date').getTime();
    		if(epTime > currentTime || (currentTime-epTime)<timeDiff )
    		{
    			eps.pushObject(ep);
    		}
    	});
    });

    return Ember.ArrayProxy.create({content: eps});

  },

  // Render template into main outlet, and navigation into navigation outlet
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

module.exports = CalendarRoute;

