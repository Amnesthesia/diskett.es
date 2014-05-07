var Channel = require('../models/channel');

var ChannelRoute = Ember.Route.extend({

  model: function() {
    return Channel.find();
  }

});

module.exports = ChannelRoute;

