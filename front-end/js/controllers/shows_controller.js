var ShowsController = Ember.ArrayController.extend({
	itemController: 'show',
	searchQuery: '',

	unwatchedShows: function(){
		return this.get("content").reduce(function(arr, object, index){
			if(object.get("isNotWatched"))
				arr.pushObject(object);
			return arr;
		}, Ember.A());

	}.property('show.@each.isNotWatched'),

	searchShows: function(){

	}
	
});

module.exports = ShowsController;

