var ShowRoute = Ember.Route.extend({
  model: function(params){
  	
  	return this.store.find('show');
  },
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render('show');
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

module.exports = ShowRoute;

