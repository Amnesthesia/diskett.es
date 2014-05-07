var EditEpisodeController = Ember.ObjectController.extend({

  save: function() {
    this.get('store').commit();
    this.redirectToModel();
  },

  redirectToModel: function() {
    var router = this.get('target');
    var model = this.get('model');
    router.transitionTo('episode', model);
  }

});

module.exports = EditEpisodeController;

