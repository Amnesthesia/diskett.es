var ShowView = Ember.View.extend({
	model: function(){
		return this.get('controller').get('model');
	},

	
});

module.exports = ShowView;

