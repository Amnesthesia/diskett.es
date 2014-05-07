var channel = require('../models/channel');

var NewChannelRoute = Ember.Route.extend({

  renderTemplate: function() {
    this.render('edit_channel', {controller: 'new_channel'});
  },

  model: function() {
    return channel.createRecord();
  },

  deactivate: function() {
    var model = this.get('controller.model');
    if (!model.get('isSaving')) {
      model.deleteRecord();
    }
  }

});

module.exports = NewChannelRoute;

