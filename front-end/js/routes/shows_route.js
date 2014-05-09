var Show = require('../models/show');

var ShowRoute = Ember.Route.extend({

  model: function() {
    return Show.find();
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

module.exports = ShowRoute;

