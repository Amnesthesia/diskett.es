var User = DS.Model.extend({

  email: DS.attr('string'),

  password: DS.attr('string'),

  last_activity: DS.attr('string'),

  shows: DS.hasMany('Show', {async: true}),

  role: DS.belongsTo('Role')

});

module.exports = User;

