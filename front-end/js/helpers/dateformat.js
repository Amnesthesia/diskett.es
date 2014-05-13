Ember.Handlebars.registerBoundHelper('formatDate', function(d) {
      return moment(d).format('MMM DD, YYYY');
});

Ember.Handlebars.registerBoundHelper('sinceUntilTime',function(d){
    return moment(d).fromNow();
});

