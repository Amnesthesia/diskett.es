var LoginRoute = Ember.Route.extend({
	renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

module.exports = LoginRoute;

