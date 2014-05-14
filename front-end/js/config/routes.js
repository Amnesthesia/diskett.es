var App = require('./app');

App.Router.map(function() {
  
  // Route for the section with watched shows
  this.route('watched',{path: '/following'});
  this.route('show',{path: '/following/:show_id'});

  this.resource('shows');
  this.resource('show', {path: '/shows/:show_id'});
  // end generated routes

  // This is the login route
  this.route('login');

  // Route for the account section
  this.route('account',{path: '/account'});

  // Route for the calendar view
  this.route('calendar',{path: '/calendar'});

  // Route for the information view
  this.route('info');

  // generated by ember-generate --scaffold
  this.resource('channels');
  this.resource('channel', {path: '/channels/:channel_id'});
  // end generated routes


  // generated by ember-generate --scaffold
  this.resource('countries');
  this.resource('country', {path: '/countries/:country_id'});
  this.route('edit_country', {path: '/countries/:country_id/edit'});
  this.route('new_country', {path: '/countries/new'});
  // end generated routes


  // generated by ember-generate --scaffold
  this.resource('episodes');
  this.resource('episode', {path: '/episodes/:episode_id'});
  // end generated routes

  this.resource('users');
  this.resource('user', { path: '/user/:user_id'});

});

// Set the base URL
App.Router.reopen({
  rootURL: '/front-end/'
});

// Apply mixins for authentication :)
App.ApplicationRoute = Ember.Route.extend(Ember.SimpleAuth.ApplicationRouteMixin,{
    user: '',
    model: function(){
      // We're working with the users session account, but 
      // the account returns a RSVP.Promise, which means it "promises"
      // to fill up the content "soon". We have to wait for this promise to finish,
      // _then_ return it, otherwise we get an object that isn't set up properly
      // and we can't work with that :(
      if(this.get('session').isAuthenticated)
        return this.get('session.account').then(function(user){
          return user; 
        });
    },
    actions: {
      logSession: function(){
        console.log(session);
      },
      follow: function(show_id){
        if(!this.get('session').isAuthenticated)
          this.transitionTo('login');
        
        console.log("Attempting to follow show with ID "+show_id);
        console.log(this.get('session.account.shows'));

        var user = this.store.find('user',this.get('session.account.id'));
        this.get('session.account.shows').pushObject(this.store.find('show',show_id));
        this.get('session.account').then(function(response){
         response.save();
        });
        // Hide the show
        Ember.$("#"+show_id).hide("slideLeft");
      }
    }
});

// Show loading screen
App.LoadingRoute = Ember.Route.extend({
  // Render template into main outlet, and navigation into navigation outlet
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }
});

App.IndexRoute = Ember.Route.extend({
  redirect: function(){
    // Redirect index to shows
    this.transitionToAnimated('shows',{main: 'slideOverRight'});
  }
});
