var InfoController = Ember.Controller.extend({
	info: function(){

		// Fetch markdown with a jQuery AJAX request
		return Ember.$.ajax("readme.md").then(function(data){return data;});

		console.log(markdown);
		return markdown;
	}.property()
});

module.exports = InfoController;

