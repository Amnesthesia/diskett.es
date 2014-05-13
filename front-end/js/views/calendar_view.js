var CalendarView = Ember.View.extend({
	onRerender: function(){
		this.rerender();
		console.log("Rerendering ...");
	}.observes('controller.controlChange')
});

module.exports = CalendarView;

