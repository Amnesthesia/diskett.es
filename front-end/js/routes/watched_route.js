var WatchedRoute = Ember.Route.extend(Ember.SimpleAuth.AuthenticatedRouteMixin,{
	model: function(){
		var store = this.get('store');
		var session = this.get('session');
		return this.get('session.account').then(function(acc){
			if(!Ember.isEmpty(acc.get('shows')))
				return store.filter('show',{ token: session.get('token') }, function(show){
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

