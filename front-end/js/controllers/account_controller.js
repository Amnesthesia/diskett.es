var AccountController = Ember.ObjectController.extend({
	isEditingPassword: false,
	accountPassword: '',
	showPasswordInfo: false,

	isPasswordValid: function(){
		var pwRegex1 =  /[A-Z]/i;
		var pwRegex2 =  /[a-z]/i;
		var pwRegex3 =  /\d/i;
		var pwRegex4 =  /[@]/i;

		var strength = 0;

		strength += pwRegex1.test(this.get('accountPassword')) ? 1:0;
		strength += pwRegex2.test(this.get('accountPassword')) ? 1:0;
		strength += pwRegex3.test(this.get('accountPassword')) ? 1:0;
		strength += pwRegex4.test(this.get('accountPassword')) ? 1:0;

		if(this.get('accountPassword').length > 7 && strength > 2)
			return true;
		else
			return false;
	}.property('accountPassword'),

	actions: {

		editPassword: function(){
			this.set('isEditingPassword',!this.get('isEditingPassword'));
			this.send('validatePassword');
		},

		validatePassword: function(){
			var valid = this.get('isPasswordValid');

			if(valid && this.get('showPasswordInfo') || (!this.get('isEditingPassword')))
			{
				if(this.get('showPasswordInfo'))
					this.set('showPasswordInfo',false);

				// Hide password info message
				Ember.$("#passwordwarning").slideUp();
			}
			else if(!valid && !this.get('showPasswordInfo'))
			{
				if(!this.get('showPasswordInfo'))
					this.set('showPasswordInfo',true);
				// Show password info
				console.log("Validating "+valid);
				Ember.$("#passwordwarning").slideDown();
			}
		},

		performUpdate: function(){
			if(this.get('isPasswordValid'))
			{
				this.get('model').set('password',this.get('accountPassword')).save();
				
				//user.setProperties({password: this.get('accountPassword')});
				//console.log(this.get('session').get('account').get('password'));
				//user.save();	
			}
		}
	}
});

module.exports = AccountController;

