// require other, dependencies here, ie:
// require('./vendor/moment');

require('../vendor/jquery');
require('../vendor/handlebars');
require('../vendor/ember');
require('../vendor/ember-data'); // delete if you don't want ember-data
require('../vendor/ember-simple-auth/ember-simple-auth');
require('../vendor/jquery.pulsate/jquery.pulsate')

var App = Ember.Application.create();

// We need this to do login! :)
Ember.Application.initializer({
  name: 'authentication',
  initialize: function(container, application) {
    Ember.SimpleAuth.setup(container, application);
  }
});

App.Store = require('./store'); // delete if you don't want ember-data

module.exports = App;

