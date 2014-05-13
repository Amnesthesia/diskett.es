
Ember.Handlebars.registerBoundHelper('markdown', function (content) {
        if (typeof input == 'undefined')  return;

        return new Ember.Handlebars.SafeString(markdown.makeHtml(input));
    });
