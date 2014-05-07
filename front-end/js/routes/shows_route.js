var Show = require('../models/show');

var ShowRoute = Ember.Route.extend({

  model: function() {
    return Show.find();
  }

});

module.exports = ShowRoute;

