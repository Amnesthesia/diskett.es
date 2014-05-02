/**
 ** This is the configuration file for RequireJS.
 ** 
 ** We'll set up all packages we require here,
 ** and define their individual paths as well as
 ** base path.
 **
 ** Then, we'll load the modules we need! :-)
 */

requirejs.config({

	// Set script base path (also defined in bower)
	"baseUrl": "/assets/js/lib",
	shim: {
		"ember": {
			deps: ["handlebars","jquery"],
			exports: "Ember"
		},
		"ember-data": {
			deps: ["ember"]
		}
	},
	paths: {
		// (sub)paths to all JS files (without .js ending)
		"jquery": 'jquery/dist/jquery',
		"modernizr": 'modernizr/modernizr',
		"foundation": 'foundation/js/foundation',
		"handlebars": 'handlebars/handlebars',
		"ember": 'ember/ember',
		"ember-data": 'ember-data/ember-data',
		"domready": 'domready/ready',
		// "app" means we should go up one level
		// to /assets/js/app instead. 
		// That's where we keep our custom filez, OK? :D
		"app": "../app",
		"template": "../../../partials"
	}/*,

	// Because of reasons, like using other frameworks
	// we want jQuery loaded with noConflict.

	// We do this by mapping all jquery-* stuff to
	// jquery-private. jquery-private is a simple
	// module defined in assets/js/lib/jquery-private.js 
	// which simply returns a jQuery.noConflict object 
	
	// But, to avoid a circular dependency, like jquery-private
	// depending on jquery, which is mapped to jquery-private, which...
	// and so on, we make sure that the jquery reference in 
	// jquery-private points to the actual jquery.
	map: {
		'*': {'jquery': 'jquery-private'},
		'jquery-private': {'jquery': 'jquery'}
	}*/

});

// Load partials
requirejs(["app/partials"]);

// Load our animations module :-)
requirejs(["app/animations"]);

// Load the Ember router and controllers
requirejs(["app/router"]);
requirejs(["app/controllers/episode"]);
requirejs(["app/controllers/show"]);


// The main application.js file
requirejs(["app/application"]);


