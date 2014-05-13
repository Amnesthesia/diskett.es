Ember.Handlebars.registerBoundHelper('markdown', function (content) {
      return new Handlebars.SafeString(markdown.toHTML(content));
});
