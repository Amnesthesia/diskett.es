// require other, dependencies here, ie:
// require('./vendor/moment');

require('../vendor/jquery');
require('../vendor/jquery-ui/ui/jquery-ui');
require('../vendor/jquery.mousewheel/jquery.mousewheel');
require('../vendor/handlebars');
require('../vendor/handlebars/handlebars.min');
require('../vendor/ember');
require('../vendor/ember-data.min'); // delete if you don't want ember-data


// ... like animated outlets :)
require('../vendor/ember-animated-outlet/dist/ember-animated-outlet.min');

// .. and booooootstraaaaaaap! <3
require('../vendor/bootstrap-css/js/bootstrap.min');

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



// We need this to do login! :)
Ember.Application.initializer({
  name: 'authentication',
  initialize: function(container, application) {
  	container.register('authenticator:custom', App.CustomAuthenticator);
    container.register('authorizer:custom', App.CustomAuthorizer);
    Ember.SimpleAuth.setup(container, application,function(){
    	authorizerFactory: 'authorizer:custom'
    });
  }
});

var App = Ember.Application.create();
App.name = "Episode Guide";


// Set up our REST API
App.ApplicationAdapter = DS.RESTAdapter;
DS.RESTAdapter.reopen({
	namespace: 'api'
	// host: 'we-could-change-backend-location.com'
});

/**
 ** To do authentication in EmberJS, we use an adapter called
 ** Ember SimpleAuth. Still, we need to provide a usable REST
 ** backend to do the authentication, but the functions below
 ** will sort out the communication with the REST API. Read on!
**/
App.CustomAuthenticator = Ember.SimpleAuth.Authenticators.Base.extend({
	tokenEndpoint: '/api/session',

	restore: function(data){
		return new Ember.RSVP.Promise(function(resolve, reject){
			if(!Ember.isEmpty(data.token))
			{
				resolve(data);
			}
			else
			{
				reject();
			}
		});
	},
	// Here, we do the actual AJAX request for the authentication,
	// and we return an Ember Promise. A promise that resolves,
	// is a successful request :D
	authenticate: function(credentials){
		var _this = this;
		return new Ember.RSVP.Promise(function(resolve, reject){
			Ember.$.ajax({
				url: 	_this.tokenEndpoint,
				type: 	'POST',
				data: 	JSON.stringify({session: {identification: credentials.identification, password: credentials.password}}),
				contentType: 	'application/json'
			}).then(function(response){ 
				// During the next runloop, try to verify the token
				// we got back from the response
				Ember.run(function(){
					resolve({ token: response.session.token});
				});
			}, function(xhr, status, error){
				var response = JSON.parse(xhr.responseText);
				Ember.run(function(){
					reject(response.error);
				});
			});
		});
	},
	// This is essentially the log out method
	invalidate: function(){
		var _this = this;
		return new Ember.RSVP.Promise(function(resolve){
			Ember.$.ajax({
				url: _this.tokenEndpoint,
				type: 'DELETE'
			}).always(function(){
				resolve();
			})
		});
	}
});
App.CustomAuthorizer = Ember.SimpleAuth.Authorizers.Base.extend({});

// We also need to authorize the token, to make sure that we're 
// actually logged in after that part is over. Thus, we need
// this authorizer right here!
App.CustomAuthorizer = Ember.SimpleAuth.Authorizers.Base.reopen({
	authorize: function(jqXHR, requestOptions){
		if(this.get('session.isAuthenticated') && !Ember.isEmpty(this.get('session.token'))){
			jqXHR.setRequestHeader('Authorization','Token: '+this.get('session.token'));
		}
	}
});

App.Store = require('./store'); // delete if you don't want ember-data

module.exports = App;

