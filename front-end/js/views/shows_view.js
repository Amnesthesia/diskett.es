var ShowsView = Ember.View.extend({
	afterRender: function(){
		console.log("Done rendering all shows!");
		
	}.on("didInsertElement")
});

module.exports = ShowsView;

