var LoginController = Ember.Controller.extend(Ember.SimpleAuth.LoginControllerMixin,{
	authenticatorFactory: 'authenticator:custom',
	loginFailed: false, //error message	
	signupEmail: "",
	signupPassword: "",
	signupValidate: "",
	signupPwValid: false,
	signupVerifyValid: false,
	signupEmailValid: false,
	signupValid: true,
	loginValid: false,
	
	actions:{
		sessionAuthenticationSucceeded: function(){
			this.transitionTo("shows");
		},
		signUp: function(){

			var user = this.store.createRecord('user', {
				email: this.get('signupEmail'),
				password: this.get('signupPassword')
			});

			user.save();
			console.log(user);
		},
		validateLoginEmail: function(){
			var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;

			if(!emailRegex.test(this.get('identification')))
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
		validateSignupEmail: function(){
			var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;

			if(!emailRegex.test(this.get('signupEmail')))
			{
				Ember.$(".signupemail-area input").css("borderColor","red");
				Ember.$(".signupemail-area input").css("backgroundColor","lightyellow");
				Ember.$("#signupemailwarning").fadeToggle().delay(5000).fadeToggle();
				if(this.get('signupEmailValid'))
					this.set('signupEmailValid',false);
			}
			else
			{
				Ember.$(".signupemail-area input").css("borderColor","green");
				Ember.$(".signupemail-area input").css("backgroundColor","lightgreen");
				if(!this.get('signupEmailValid'))
					this.set('signupEmailValid',true);
			}
			if(this.get('signupVerifyValid') && this.get('signupPwValid') && this.get('signupEmailValid'))
				this.set('signupValid');
		},
		validateSignupPw: function(){
			var pwRegex1 =  /[A-Z]/;
			var pwRegex2 =  /[a-z]/;
			var pwRegex3 =  /\d/;
			var pwRegex4 =  /[@]/;

			if(pwRegex1.test(this.get('signupPassword')) && pwRegex2.test(this.get('signupPassword')) && pwRegex3.test(this.get('signupPassword')) && pwRegex4.test(this.get('signupPassword')))
			{
				Ember.$(".signuppw-area input").css("borderColor","red");
				Ember.$(".signuppw-area input").css("backgroundColor","lightyellow");
				Ember.$("#passwordwarning").fadeToggle().delay(5000).fadeToggle();
				if(this.get('signupPwValid'))
					this.set('signupPwValid',false);	
			}
			else
			{
				Ember.$(".signuppw-area input").css("borderColor","green");
				Ember.$(".signuppw-area input").css("backgroundColor","lightgreen");
				if(!this.get('signupPwValid'))
					this.set('signupPwValid',true);
			}
			if(this.get('signupVerifyValid') && this.get('signupPwValid') && this.get('signupEmailValid'))
				this.set('signupValid');
		},
		validateSignupVerification: function(){
			/*if(Ember.computed.equal(this.get('signupPassword'),this.get('signupVerify')))
			{
				Ember.$(".signupverify-area input").css("borderColor","red");
				Ember.$(".signupverify-area input").css("backgroundColor","lightyellow");
				Ember.$("#verifywarning").fadeToggle().delay(5000).fadeToggle();
				if(this.get('signupVerifyValid'))
					this.set('signupVerifyValud',false);
			}
			else
				if(!this.get('signupVerifyValid'))
					this.set('signupVerifyValid',true);

			if(this.get('signupPwValid') && this.get('signupEmailValid'))
				this.set('signupValid');*/
		}
	}
});

module.exports = LoginController;

