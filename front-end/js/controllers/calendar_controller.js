var CalendarController = Ember.ArrayController.extend({
	itemController: 'episode',

	// Sort all episodes by date, ascending
	sortProperties: ['show_id','date'],
	monthNum: -1,
	year: -1,
	monthDays: Ember.A(),
	allowPrevious: true,
	loopDay: 0,

	// Get the name of the current month
	monthName: function(){
		var month = [];
		

		month[0] = "January";
		month[1] = "February";
		month[2] = "March";
		month[3] = "April";
		month[4] = "May";
		month[5] = "June";
		month[6] = "July";
		month[7] = "August";
		month[8] = "September";
		month[9] = "October";
		month[10] = "November";
		month[11] = "December";
		
		return month[this.get('monthNum')];
	}.property('monthNum').volatile(),

	init: function(){
		var d = new Date();

		this.set('year',1900+d.getYear());
		this.set('monthNum',d.getMonth());
	},

	allowPrev: function(){
		var d = new Date();
		var current = new Date(this.get('year'),this.get('monthNum'),d.getDate());

		if(current - d.getTime() > (1000*90*24*3600))
			return false;
		else
			return true;
	}.property('year','monthNum'),

	/** 
		NONE of these computed properties are cached! 
		Because we want to update the calendar, we must continuously
		recalculate these values -- therefore, they're ALL volatile!
	**/

	// Get numbers of days in month
	daysInMonth: function(){
		var days = Ember.A();
		var numDays = new Date(this.get('year'),(this.get('monthNum')+1),0).getDate();
		
		for(var i=1; i<=numDays; i++)
			days.pushObject({dayNumber: i});

		return days;
	}.property().volatile(),


	episodesByDay: function(){
		this.set('loopDay',this.get('loopDay')+1);
		var now = new Date();
		if(this.get('year')<0)
			this.set('year',now.getYear());
		var date = new Date(this.get('year'),this.get('monthNum'),this.get('loopDay'),00,00,00,00,00);

		eps = Ember.A();

		var contextThis = this;
		
		this.get('model').forEach(function(episode){
			var airDate = new Date(episode.get('date').getYear(),episode.get('date').getMonth(),episode.get('date').getDate(),02,00,00,00,00);
			if(episode.get('date').getYear() == date.getYear() && episode.get('date').getMonth() == date.getMonth() && episode.get('date').getDate() == date.getDate())
			{
				var s = contextThis.get('store').find('show',episode.get('show_id'));
					
				eps.pushObject(s);
			}
		});

		return eps;
	}.property('model').volatile(), // It's volatile because this _should not_ be cached.


	actions: {
		previousMonth: function(){

			if(this.get('monthNum') == 0)
			{
				this.set('monthNum',11);
				this.set('year',this.get('year')-1);
			}
			else
				this.set('monthNum',this.get('monthNum')-1);

			console.log('Updated monthNum to'+this.get('monthNum'));
		},

		nextMonth: function(){

			if(this.get('monthNum') == 11)
			{
				this.set('monthNum',0);
				this.set('year',this.get('year')+1);
			}
			else
				this.set('monthNum',this.get('monthNum')+1);

			console.log('Updated monthNum to'+this.get('monthNum'));
		}
	}

});

module.exports = CalendarController;

