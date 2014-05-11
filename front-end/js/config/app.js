// require other, dependencies here, ie:
// require('./vendor/moment');

require('../vendor/jquery');
require('../vendor/jquery-ui/ui/jquery-ui');
require('../vendor/jquery.mousewheel/jquery.mousewheel');
require('../vendor/handlebars');
require('../vendor/handlebars/handlebars.min');
require('../vendor/ember');
require('../vendor/ember-data.min'); // delete if you don't want ember-data
// Then we'll include some custom stuff!


// ... like animated outlets :)
require('../vendor/ember-animated-outlet/dist/ember-animated-outlet.min');


// ... and all available bootstrap components -- we can just uncomment the ones we'll use

// This one first, it's a dependency for all other components
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-core.max');

// aaaand here's all of them:
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-alert.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-badge.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-basic.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-button.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-growl-notifications.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-items-action-bar.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-label.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-list-group.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-modal.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-nav.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-notifications.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-progressbar.min');
//require('../vendor/ember-addons.bs_for_ember/dist/js/bs-wizard.min');

require('../vendor/ember-simple-auth/ember-simple-auth');
require('../vendor/jquery.twinkle/jquery.twinkle-0.5.0.min');

var App = Ember.Application.create();
App.name = "Episode Guide"

// Set up our REST API
App.ApplicationAdapter = DS.RESTAdapter;
DS.RESTAdapter.reopen({
	namespace: 'api'
	// host: 'we-could-change-backend-location.com'
});

// We need this to do login! :)
Ember.Application.initializer({
  name: 'authentication',
  initialize: function(container, application) {
    Ember.SimpleAuth.setup(container, application);
  }
});

App.Store = require('./store'); // delete if you don't want ember-data

module.exports = App;

