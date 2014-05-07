var Country = require('../models/country');

var CountryRoute = Ember.Route.extend({

  model: function() {
    return Country.find();
  }

});

module.exports = CountryRoute;

