var CountryController = Ember.ObjectController.extend({

  destroy: function() {
    if (!confirm('Are you sure?')) return;
    this.get('model').deleteRecord();
    this.get('store').commit();
    this.get('target.router').transitionTo('countries');
  }

});

module.exports = CountryController;

