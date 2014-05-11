var Show = require('../models/show');

var ShowsRoute = Ember.Route.extend({

  model: function() {
  	console.log("Trying to find shows");
    return this.store.find('show');
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

module.exports = ShowsRoute;

