var Episode = require('../models/episode');

var EpisodeRoute = Ember.Route.extend({

  model: function() {
    return Episode.find();
  }

});

module.exports = EpisodeRoute;

