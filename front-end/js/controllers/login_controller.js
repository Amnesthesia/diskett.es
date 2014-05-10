var LoginController = Ember.Controller.extend({
	loginVisible: false,
	loginEmail: "",
	loginPassword: "",
	signupEmail: "",
	signupPassword: "",
	signupValidate: "",
	
	toggleLogin: function(){
		if(!this.get('session').isAuthenticated && !this.get('loginVisible'))
		{
			Ember.$("#login-button").attr('id','login-button-invis');
  			Ember.$("#login-overlay").slideDown();
  			this.set('loginVisible',true);
  			Ember.$("#login-overlay-button").twinkle();

		}
  		else if(this.get('loginVisible'))
  		{
  			Ember.$("#login-button-invis").attr('id','login-button');
  			Ember.$("#login-overlay").slideUp();
  			this.set('loginVisible',false);
  		}
		
	}.on('didInsertElement'),
	actions:{
		loginForm: function(){
			this.get('controller').send('toggleLogin');
		},
		verifyLoginForm: function(){
			if(this.get('loginEmail') != "lol")
				Ember.$(".loginusername-area").append('<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Oh come on.. :( Your email sucks, man</div>');

		}
	}
});

module.exports = LoginController;

