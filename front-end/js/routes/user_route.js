var UserRoute = Ember.Route.extend({
  model: function(params){
  	return this.store.find('user', params.user_id);
  },
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render('user');
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

module.exports = UserRoute;

