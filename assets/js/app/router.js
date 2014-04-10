// Define all dependencies
define(['jquery', 
		'ember',
		'handlebars',
		'app/models/show'
		], 
// And then start our module
function ($,Ember){
	EpGuide.Router.map(function(){
		// When the URL matches the root path, load the grid template 
		this.resource('shows', { path: '/'});
		
	});

	EpGuide.ShowRoute = Ember.Route.extend({
		model: function(){
			return this.store.find('show');
		}
	});

	EpGuide.ShowsRoute = Ember.Route.extend({
		model: function(){
			return this.store.find('show');
		}
	});


});