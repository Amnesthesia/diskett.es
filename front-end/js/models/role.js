var Role = DS.Model.extend({

  name: DS.attr('string'),

  description: DS.attr('string'),

  is_admin: DS.attr('boolean'),

  users: DS.hasMany('User')

});

module.exports = Role;

