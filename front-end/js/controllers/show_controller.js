var ShowController = Ember.ObjectController.extend({
  	ratingLength: function(){
		return (this.get('rating')*10);
	}.property('rating'),
  	ratingText: function(){
		return (this.get('rating').toFixed(1))
	}.property('rating'),
  	
  	actions: {
  		destroy: function() {
    	if (!confirm('Are you sure?')) return;
    	this.get('model').deleteRecord();
    	this.get('store').commit();
    	this.get('target.router').transitionTo('shows');
  		}
  	}

});

module.exports = ShowController;

