var Show = require('../models/show');

var ShowsRoute = Ember.Route.extend({
  page: 1,
  queryParams: {
		search_text: {
			refreshModel: true
		}
	},
  model: function(params) {
  	console.log("Trying to find shows");
  	/*if(params.page>0 && !params.show_id)
    	return this.store.find('show',{page: params.page});
   	else
   		return this.store.find('show',{id: params.show_id});*/
   	var shows = this.store.find('show',{page: this.get('page'), search: params.search_text});
   	this.set('originalContent',shows);
   	return shows;
  },


  renderTemplate: function(){
    var controller = this.controllerFor('navigation');

    this.render();
    this.render('navigation', {
      outlet: "navigation",
      controller: controller
    })
  },

  actions: {
  	nextPage: function(){
  		this.set('page',this.get('page')+1);
  		this.refresh();
  	}
  }

});

module.exports = ShowsRoute;

