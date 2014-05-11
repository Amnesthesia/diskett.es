var LoginView = Ember.View.extend({
	templateName: 'login',

	actions: {
		validateSignupForm: function(){
			// Validate email against regex
			
			
			var email = this.get('controller').get('signupEmail');
			if(emailRegex.test(email))
				console.log("VALID.");
			else
				console.log("INVALID");


		}
	}
});

module.exports = LoginView;

