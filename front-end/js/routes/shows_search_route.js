var ShowsSearchRoute = Ember.Route.extend({
	controllerName: 'shows',
	queryParams: {
		search_text: {
			refreshModel: true
		}
	},

	model: function(params){
		return this.get('store').find('show', {search: params.search_text});
	},

});

module.exports = ShowsSearchRoute;

