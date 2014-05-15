var WatchedRoute = Ember.Route.extend(Ember.SimpleAuth.AuthenticatedRouteMixin,{
	model: function(){
		return this.get('session.account').then(function(acc){
			if(!Ember.isEmpty(acc.get('shows')))
				return this.get('store').filter('show',{ token: this.get('session.token') }, function(show){
				return show;
			});
		});
 
    	
	},
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

module.exports = WatchedRoute;

