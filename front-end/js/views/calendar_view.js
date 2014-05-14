var CalendarView = Ember.View.extend({
	// Rerender the page if the month changes
	onRerender: function(){
		this.rerender();
		console.log("Rerendering...");
	}.observes('controller.monthNum')
});

module.exports = CalendarView;

