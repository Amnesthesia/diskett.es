var WatchedRoute = Ember.Route.extend(Ember.SimpleAuth.AuthenticatedRouteMixin,{
	model: function(){

    	return this.get('session.account').then(function(shows){
    		return shows.get('shows');
    	},function(){
    		var user = this.store.find('user',this.get('session.account.id'));
    		return user.get('shows');
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

