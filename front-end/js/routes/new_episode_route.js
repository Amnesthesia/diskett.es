var episode = require('../models/episode');

var NewEpisodeRoute = Ember.Route.extend({

  renderTemplate: function() {
    this.render('edit_episode', {controller: 'new_episode'});
  },

  model: function() {
    return episode.createRecord();
  },

  deactivate: function() {
    var model = this.get('controller.model');
    if (!model.get('isSaving')) {
      model.deleteRecord();
    }
  }

});

module.exports = NewEpisodeRoute;

