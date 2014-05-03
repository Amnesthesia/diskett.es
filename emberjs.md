# EpisodeGuide with EmberJS

Okay, I made this document to explain the basic structure, because I realized it may be even more confusing to get into a finished setup than to set it up from the beginning.

Custom code is located in:

`assets/js/app/`

and included packages, such as jQuery, is found in:

`assets/js/lib/`

## RequireJS & Bower
**EmberJS** works really well with **RequireJS**. RequireJS is a framework designed to keep track of all packages the application uses, and the correct version of these. 

*Bower* is a package manager by Twitter, which tries to be a generic, unopinionated solution to the problem of **front-end package management**. It runs over git, and depends on Node.js and NPM, and can be globally installed with:

`npm install -g bower`

The .bowerrc file contains a list of packages to keep installed, and running `bower install` will reinstall these.

### RequireJS config

The configuration file for RequireJS can be found in

`assets/js/config.js`

This file defines the baseURL for all javascript packages as `assets/js/lib/`, and this is also the directory currently defined as the directory where **Bower** installs packages to. For example, installing Modernizr with Bower is as easy as

`bower install modernizr`

The paths in config.js are relative from the baseURL, and are paths to the javascript file to be included, without the file-ending. For example, *jquery/dist/jquery* means that the jQuery file to include is located in */assets/js/lib/jquery/dist/jquery.js*.

This does not mean the files are necessarily included, but that the application is configured to recognize these packages. 

### Writing modules

Modules for RequireJS are written within

```define(['jquery','handlebars'], function ($,handlebars) {

// All module code here

});```

This is called **dependency injection**. By passing what other packages this module depends on, those objects can be passed to the module without requiring them to be global, and since modules can be included on an on-demand basis, we avoid including files that aren't needed, whilst letting RequireJS make sure they're included in the proper order. 

Of course, modules can depend on other custom modules; for example, the **show.js** model depends on the **episode.js** model, and thus, it demands it as such:

```define(['ember','ember-data','app/models/episode','app/models/channel'], function ($,Ember){

});
```

**Note:** `app/models/episode` is still relative from the baseURL, with .js omitted.



### Including modules
The modules required for the site to run are included further down in `assets/js/app/config.js`, and including modules is fairly straight-forward. Just remember the omitting the baseURL and file-ending. This is how we include the script to load partials dynamically, for example:

`requirejs(["app/partials"]);`

This loads the file `partials.js` in `assets/js/app`.

## EmberJS
EmberJS can be a bitch to get into, so it's highly recommended that you install EmberJS inspector for Firefox or Chrome -- it works well with Firebug, which is the de facto debugging tool for the web.

### Templates & Partials
EmberJS uses Handlebars for templating, and because I *hate* having all templates in one file, I've taken the liberty of referring to small templates (templates that are just part of the main site) *partials*.

Partials are located in

`partials/`

Handlebars templates are surrounded by Handlebars-script tags, and must have an ID and a name. These look like this:

```<script id="grid-template" type="text/x-handlebars-template" data-template-name="shows">

<!-- HTML here -->
<a href="#" title="{{unbound name}}"> <h5>{{name}}</h5></a>

</script>
```

as HTML files. You may be wondering what the {{ }} are? These are called Mustaches, and Handlebars is indeed compatible with Mustache templates. The main difference is that Handlebars templates can be compiled, and unlike Mustache templates, Handlebars support conditions, helpers and {{this}} in blocks. For example, you can have a block repeat itself with

```{{#each item}}
<!-- HTML here -->
{{/each}}
```

The {{ }} are called Handlebars, or, Mustaches. These indicate that this part should be processed by Handlebars. If you're working with an object passed from EmberJS controller to the template, and you're iterating through an array of object where you want to print the name of every object, the code may look like this:

```<script id="grid-template" type="text/x-handlebars-template" data-template-name="shows">
{{#each controller itemController="show"}}
<!-- HTML here -->
<a href="#" title="{{unbound this.name}}"> <h5>{{this.name}}</h5></a>

</script>
```
Everytime Handlebars does an insert, it surrounds it with some script tags. This is to be able to update this field in the future, in case the data changes. But this can fuck shit up, like when you're inserting something into an attribute, like in the `title=" "` field above. The *unbound* keyword here means that we will not keep track of this in the future, that we don't need to *bind* it, and thus no script tags will be surrounding it. 

### Models
A model is basically an object, particularly an object stored in the database. Models can be created in two ways -- either statically created with pre-defined information, or the information can be retrieved from an API. 

To load information from the database into a a model, we use a RESTful API. 

More information about that can be found here (such as default URLs for EmberJS interaction with RESTful APIs):

http://emberjs.com/guides/models/the-rest-adapter/

Models are conveniently located in the *models* directory under the basepath for javascript files, namely `assets/js/app/models/`, where they are defined as EmberJS models with variables of the appropriate types.

A variable in one object can be bound to a variable in another object, and update as the other object updates. A variable can also be a relation to another object -- for example, *Show* in the Episode model contains the Show object that Episode belongs to.

http://emberjs.com/guides/models/

### Controllers

Controllers are responsible for the user interaction -- when a user interacts with the site, like clicking on a button, this action is sent to the controller, which performs the appropriate action.

For example, a click may cause the controller to update the User's watchlist and add another TV-series for the user. Or, if the user clicks a "Read more" links, the controller may decide to load up a Show object with a certain ID, and send this to a new view to be displayed with this information.

Controllers manage user I/O and reacts on it.

`assets/js/app/controllers/`

### Views

Supposedly, because of the power of Handlebars' templates, we may not need to create that many views. We'll see about that though. Views are located in

`assets/js/app/controllers/`

## Custom

### animations.js

Animations is a module where I've put most of the site's UI animations, to keep these separate from the rest of the javascript files. 

If you want to add or modify animations, these are found in 

`assets/js/app/animations.js` 
