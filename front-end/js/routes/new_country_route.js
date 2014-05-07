var country = require('../models/country');

var NewCountryRoute = Ember.Route.extend({

  renderTemplate: function() {
    this.render('edit_country', {controller: 'new_country'});
  },

  model: function() {
    return country.createRecord();
  },

  deactivate: function() {
    var model = this.get('controller.model');
    if (!model.get('isSaving')) {
      model.deleteRecord();
    }
  }

});

module.exports = NewCountryRoute;

