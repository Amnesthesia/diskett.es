var LoginController = Ember.Controller.extend(Ember.SimpleAuth.LoginControllerMixin,{
	authenticatorFactory: 'authenticator:custom',
	loginFailed: false, //error message	
	signupEmail: "",	// Form fields
	signupPassword: "",
	signupVerify: "", // End formfields
	signupPwValid: false, // Validation variables for form fields
	signupVerifyValid: false,
	signupEmailValid: false,

	// Return true if login email is a valid email
	loginEmailIsValid: function(){
		var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;

		if(!emailRegex.test(this.get('identification')))
			return false;
		else
			return true;
	}.property('identification'),

	// Return true if signup email is a valid email
	signupEmailIsValid: function(){
		var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;

		if(!emailRegex.test(this.get('signupEmail')))
		{
			if(this.get('signupEmailValid'))
				this.set('signupEmailValid',false);
			return false;
		}	
		else
		{
			if(!this.get('signupEmailValid'))
				this.set('signupEmailValid',true);
			return true;
		}
	}.property('signupEmail'),

	// Return true if password is a decent password
	passwordNotShit: function(){
		var pwRegex1 =  /[A-Z]/i;
		var pwRegex2 =  /[a-z]/i;
		var pwRegex3 =  /\d/i;
		var pwRegex4 =  /[@]/i;

		var strength = 0;

		strength += pwRegex1.test(this.get('signupPassword')) ? 1:0;
		strength += pwRegex2.test(this.get('signupPassword')) ? 1:0;
		strength += pwRegex3.test(this.get('signupPassword')) ? 1:0;
		strength += pwRegex4.test(this.get('signupPassword')) ? 1:0;

		if(this.get('signupPassword').length > 7 && strength > 2)
		{
			if(!this.get('signupPwValid'))
				this.set('signupPwValid',true);
			return true;
		}
		else
		{
			if(this.get('signupPwValid'))
				this.set('signupPwValid',false);
			return false;
		}
	}.property('signupPassword'),

	// Return true if passwords match
	passwordMatch: function(){
		if(this.get('signupPassword') == this.get('signupVerify'))
		{
			console.log("Passwords match")
			return true;
		}	
		else
		{
			return false;
		}
	}.property('signupPassword','signupVerify'),

	signupFormIsValid: function(){
		if(this.get('signupVerifyValid') && this.get('signupPwValid') && this.get('signupEmailValid'))
			return true;
		return false;
	}.property('signupVerifyValid','signupPwValid','signupEmailValid'),

	actions:{

		// If the user is authenticated, log session data and transition to Shows
		sessionAuthenticationSucceeded: function(){
			console.log(session.account);
		},

		// Perform signup
		signUp: function(){

			var user = this.store.createRecord('user', {
				email: this.get('signupEmail'),
				password: this.get('signupPassword')
			});

			user.save();
			console.log(user);
		},

		// Check if loginEmailIsValid, and display warning or green the field
		validateLoginEmail: function(){
			if(!this.get('loginEmailIsValid'))
			{
				Ember.$(".loginusername-area input").css("borderColor","red");
				Ember.$(".loginusername-area input").css("backgroundColor","lightyellow");
				Ember.$("#emailwarning").fadeToggle().delay(5000).fadeToggle();
			}
			else
			{
				Ember.$(".loginusername-area input").css("borderColor","green");
				Ember.$(".loginusername-area input").css("backgroundColor","lightgreen");
			}
		},

		// Check if signupEmailIsValid and display warning or green the field
		validateSignupEmail: function(){


			if(!this.get('signupEmailIsValid'))
			{
				Ember.$(".signupemail-area input").css("borderColor","red");
				Ember.$(".signupemail-area input").css("backgroundColor","lightyellow");
				Ember.$("#signupemailwarning").fadeToggle().delay(5000).fadeToggle();
			}
			else
			{
				Ember.$(".signupemail-area input").css("borderColor","green");
				Ember.$(".signupemail-area input").css("backgroundColor","lightgreen");
			}
		},

		// Make sure password isn't rubbish, and display warning or green the field
		validateSignupPw: function(){
			
			if(!this.get('passwordNotShit'))
			{
				Ember.$(".signuppw-area input").css("borderColor","red");
				Ember.$(".signuppw-area input").css("backgroundColor","lightyellow");
				Ember.$("#passwordwarning").fadeToggle().delay(5000).fadeToggle();
					
			}
			else
			{
				Ember.$(".signuppw-area input").css("borderColor","green");
				Ember.$(".signuppw-area input").css("backgroundColor","lightgreen");
			}
		},

		// Make sure passwords match
		validateSignupVerification: function(){
			if(!this.get('passwordMatch'))
			{
				Ember.$(".signupverify-area input").css("borderColor","red");
				Ember.$(".signupverify-area input").css("backgroundColor","lightyellow");
				Ember.$("#verifywarning").fadeToggle().delay(5000).fadeToggle();
			}
			else
			{
				Ember.$(".signupverify-area input").css("borderColor","green");
				Ember.$(".signupverify-area input").css("backgroundColor","lightgreen");
			}
		}
	}
});

module.exports = LoginController;

