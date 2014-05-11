var LoginRoute = Ember.Route.extend({
	// Make sure no old error messages are around from failed logins
	setupController: function(controller, model){
		controller.set('errorMessage',null);
	},

	renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  },

  // Display error messages for failed logins
  actions: {
  	sessionAuthenticationFailed: function(msg){
  		this.controller.set('errorMessage',msg);
  	}
  }
});

module.exports = LoginRoute;

