var InfoController = Ember.Controller.extend({
	markdown: function(){

		// Fetch markdown with a jQuery AJAX request
		var markdown = Ember.$.ajax("https://raw.githubusercontent.com/Amnesthesia/Project-Rheya/master/diskett.es/readme.md");

		return markdown;
	}.property()
});

module.exports = InfoController;

