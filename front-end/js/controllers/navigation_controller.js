var NavigationController = Ember.Controller.extend({
	needs: 'login',
	loginController: Ember.computed.alias("controllers.login"),

	actions:{
		loginForm: function(){
			this.get('loginController').toggleLogin();
		}
	}
});

module.exports = NavigationController;

