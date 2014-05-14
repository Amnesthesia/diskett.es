var InfoRoute = Ember.Route.extend({
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

module.exports = InfoRoute;

