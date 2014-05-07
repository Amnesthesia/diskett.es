var show = require('../models/show');

var NewShowRoute = Ember.Route.extend({

  renderTemplate: function() {
    this.render('edit_show', {controller: 'new_show'});
  },

  model: function() {
    return show.createRecord();
  },

  deactivate: function() {
    var model = this.get('controller.model');
    if (!model.get('isSaving')) {
      model.deleteRecord();
    }
  }

});

module.exports = NewShowRoute;

