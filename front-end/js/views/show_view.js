var ShowView = Ember.View.extend({
	model: function(){
		return this.get('controller').get('model');
	},
	alleps: function(){
		console.log(this.get('model').get('episodes'));
	}
});

module.exports = ShowView;

