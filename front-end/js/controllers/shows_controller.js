var ShowsController = Ember.ArrayController.extend({
	itemController: 'show',
	content: [],
	needs: 'show',
	originalContent: [],
	search_text: '',
	page: 1,

	
	actions:{
		// When the "update" action is triggered by hitting enter, 
		// we transition to either 
		// 1) index page if search query is empty
		// 2) search page with the query bound to search_text 
		update: function(){
			console.log("Transitioning to shows.search with "+this.get('search_text'));
  			
  			if(Ember.isEmpty(this.get('search_text')))
  				this.transitionToRoute('index');
  			else
  				this.transitionToRoute('/shows/'+this.get('search_text'));
  		},

  		forward: function(){
  			this.set('page',this.get('page')+1);
  			this.set('content',this.store.filter('show',{page: this.get('page')},function(shows){return shows;}));
  			console.log("Advancing page");
  		
  		}
	}
});

module.exports = ShowsController;

