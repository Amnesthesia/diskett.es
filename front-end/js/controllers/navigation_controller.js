var NavigationController = Ember.Controller.extend({
	needs: 'login',
	loginController: Ember.computed.alias("controllers.login"),

	actions:{
		loginForm: function(){
			this.get('loginController').toggleLogin();
		},
		invalidate: function(){
			this.get('loginController').send('invalidate');
		}
	}
});

module.exports = NavigationController;

