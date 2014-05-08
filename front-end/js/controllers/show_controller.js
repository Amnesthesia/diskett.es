var ShowController = Ember.ObjectController.extend({
  	// Returns rating as length for the rating progress bar
  	ratingLength: function(){ 
    	return (this.get('rating').toFixed(1)*10);
  	}.property('rating'),
  	// Returns rating as text to display on the rating progress bar
  	ratingText: function(){
  		return (this.get('rating').toFixed(1));
  	}.property('rating'),
  	actions: {
  		destroy: function() {
    	if (!confirm('Are you sure?')) return;
    	this.get('model').deleteRecord();
    	this.get('store').commit();
    	this.get('target.router').transitionTo('shows');
  		},
  		follow: function(){
  			if(!confirm("You must be logged in")) return;
  		}
  	}

});

module.exports = ShowController;

