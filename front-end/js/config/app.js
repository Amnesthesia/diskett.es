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


require('../vendor/ember-simple-auth/ember-simple-auth');
require('../vendor/jquery.twinkle/jquery.twinkle-0.5.0.min');

// Markdown processor
require('../vendor/markdown/lib/index');


// We need this to do login!
// With this code right here, we initialize the application,
// and at the same time we add a computed property (that function right there, you see?)
// to the Session which makes a second request with the user_id,
// and loads the user model into the session. Sooooo:
//
// IMPORTANT: This makes the current user object accessible in session.account
Ember.Application.initializer({
  name: 'authentication',
  initialize: function(container, application) {
  	container.register('authenticator:custom', App.CustomAuthenticator);
    container.register('authorizer:custom', App.CustomAuthorizer);

  	  // Let's set up the user session so that it contains the logged in user!
    Ember.SimpleAuth.Session.reopen({
    	account: function(serverSession){

    		var user_id = this.get('user_id');
    		if(!Ember.isEmpty(user_id)){
    			return container.lookup('store:main').find('user',user_id);
    		}
    		console.log(user_id);
    	}.property('user_id')
    });


    // We have to set up some basic stuff, like what route to
    // redirect to after authentication, and what authorizerfactory
    // we use to verify the session
    Ember.SimpleAuth.setup(container, application,function(){
    	routeAfterAuthentication: 'shows'
    	authorizerFactory: 'authorizer:custom'
    });

   
  }
});

var App = Ember.Application.create();
App.name = "diskett .es";


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
				data: 	Ember.$.param({session: {identification: credentials.identification, password: credentials.password}})//,
				//contentType: 	'application/json'
			}).then(function(response){ 
				// During the next runloop, try to resolve the token
				// we got back from the response
				Ember.run(function(){
					// Show the response in console, and most importantly,
					// save the damn token! ;) Oh, and the user ID...
					console.log(response);
					resolve({ token: response.session.token, user_id: response.session.user_id});
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
	invalidate: function(sess){
		var _this = this;
		console.log(sess);
		
		return new Ember.RSVP.Promise(function(resolve){

			Ember.$.ajax({
				url: _this.tokenEndpoint+"/"+sess.token,
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

