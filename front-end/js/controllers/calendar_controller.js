var CalendarController = Ember.ArrayController.extend({
	itemController: 'episode',

	// Sort all episodes by date, ascending
	sortProperties: ['show_id','date'],
	monthNum: -1,
	year: -1,

	// Monitor this variable to rerender view when user
	// clicks a button to change month
	controlChange: 0,
	loopDay: 0,

	// Get the name of the current month
	month: function(num){
		var month = new Array();
		
		if(!num || num<0 || num == null || num == 'month')
		{
			var date = new Date();
			num = date.getMonth();
			this.set('monthNum',num);

			// Set the year as well, if it's not yet set
			if(this.get('year') < 0)
				this.set('year',1900+date.getYear());
		}



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
		
		return month[num];
	}.property(),

	// Get numbers of days in month
	daysInMonth: function(){
		var days = Ember.A();
		var numDays = new Date(this.get('year'),(this.get('monthNum')+1),0).getDate();
		
		for(var i=1; i<=numDays; i++)
			days.pushObject({dayNumber: i});

		return days;
	}.property(),

	currentYear: function(){
		return this.get('year');
	}.property(),

	currentMonth: function(){
		return this.get('monthNum');
	}.property(),

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
				
				// Workaround to avoid unbound variables on page;
				// we cannot print any variables on the calendar
				// and leave them unbound, because we only get empty promises.
				// This means that variables are updated after they are printed, and 
				// must be surrounded by <script> tags. This does not work with images.
				// Thus, we change the property without saving, and let it print it as is.
				
				eps.pushObject(s);
			}
		});

		return eps;
	}.property('model').volatile(), // It's volatile because this _should not_ be cached.


	actions: {
		previousMonth: function(){
			this.set('controlChange',this.get('controlChange')+1);
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
			this.set('controlChange',this.get('controlChange')+1);
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

