var LoginController = Ember.Controller.extend({
	loginVisible: false,
	
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
		}
	}
});

module.exports = LoginController;

