var AccountRoute = Ember.Route.extend(Ember.SimpleAuth.AuthenticatedRouteMixin,{
  model: function() {
  	
  	// We're working with the users session account, but 
  	// the account returns a RSVP.Promise, which means it "promises"
  	// to fill up the content "soon". We have to wait for this promise to finish,
  	// _then_ return it, otherwise we get an object that isn't set up properly
  	// and we can't work with that :(
    return this.get('session.account').then(function(user){
    	return user; 
    });
  },

  // Render navigation into the sidebar
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    // And regular content into the main outlet
    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

module.exports = AccountRoute;

