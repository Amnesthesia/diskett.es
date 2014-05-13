var ShowView = Ember.View.extend({
	model: function(){
		return this.get('controller').get('model');
	},
	tableize: function(){
		this.$(table).dataTable();
	}.on('didInsertElement')
});

module.exports = ShowView;

