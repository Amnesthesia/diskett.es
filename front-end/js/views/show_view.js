var ShowView = Ember.View.extend({
	model: function(){
		return this.get('controller').get('model');
	},

	redrawPage: function(){
		this.rerender();
		console.log("User seems to have followed or unfollowed the show, redrawing");
	}.observes('session.account.shows')
});

module.exports = ShowView;

