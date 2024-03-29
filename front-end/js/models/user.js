var User = DS.Model.extend({

  email: DS.attr('string'),

  password: DS.attr('string'),

  last_activity: DS.attr('string'),

  shows: DS.hasMany('Show'),

  role: DS.belongsTo('Role'),

  episodes: DS.hasMany('Episode')

});

module.exports = User;

