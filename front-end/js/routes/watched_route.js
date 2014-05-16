var WatchedRoute = Ember.Route.extend(Ember.SimpleAuth.AuthenticatedRouteMixin,{
	model: function(){
		var store = this.get('store');
		var session = this.get('session');
		return this.get('session.account').then(function(acc){
				//return store.filter('show',{ token: session.get('token') }, function(show){
				console.log(session.get('shows'));
				return session.get('shows');
			//});
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

