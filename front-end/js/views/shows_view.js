
var ShowsView = Ember.View.extend({
	afterRender: function(){
		console.log("Done rendering all shows!");
		var oldValue = this.get('controller.search_text');
		Ember.$("#search-area input[type=text]").focus().val('').val(oldValue);

		

	}.on("didInsertElement"),

	didInsertElement: function(){
		// Listen for scroll events -- load more when bottom is reached

		Ember.$(window).scroll(function(){
			if(Ember.$(window).scrollTop()+Ember.$(window).height() == Ember.$(document).height()-100)
			{
				console.log("Should begin loading more now.");
			}
		});
	},

	// Observe changes to controllers search_text
	// because the search field is bound to this value.
	// If it changes, we should re-render the grid immediately,
	// and match each show item against the search query.
	filterGrid: function(){
		console.log("search text changed -- rerendering");
		this.rerender();

		// We have rerendered the page now, but the text in the
		// field is selected. To work around this, we empty it,
		// and refill it with the old value. Magic!

	}.observes('controller.search_text')
	
});

module.exports = ShowsView;

