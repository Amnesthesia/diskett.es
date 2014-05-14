var Show = require('../models/show');

var ShowsRoute = Ember.Route.extend({

  model: function(params) {
  	console.log("Trying to find shows");
  	return this.store.find('show');
  	/*if(params.page>0 && !params.show_id)
    	return this.store.find('show',{page: params.page});
   	else
   		return this.store.find('show',{id: params.show_id});*/
  },
  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  }

});

module.exports = ShowsRoute;

