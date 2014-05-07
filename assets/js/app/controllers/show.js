// Define all dependencies
define(['jquery', 
		'ember',
		'handlebars',
		'app/models/country',
		'app/models/channel',
		'app/models/show',
		'app/models/episode',
		'covers-carousel'
		], 
// And then start our module
function ($,Ember){
	EpGuide.ShowsController = Ember.ArrayController.extend({
		viewMode: 'grid',
		itemController: 'show',

		// Change the current view mode
		actions: {
			viewAsGrid: function(){
				this.set("viewMode",'grid');
			},
			viewAsCarousel: function(){
				this.set("viewMode", 'carousel');
				$(".carousel-wrapper").coversCarousel();
			}
		}
	});

	EpGuide.ShowController = Ember.ObjectController.extend({
		ratingLength: function(){
			return (this.get('rating')*10);
		}.property('rating'),
		ratingText: function(){
			return (this.get('rating').toFixed(1))
		}.property('rating'),

		actions: {
			more: function(){
				this.transitionToRoute('show',this)
			}
		}
	});
});