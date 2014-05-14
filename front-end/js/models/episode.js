var Episode = DS.Model.extend({

  show_id: DS.attr('number'),

  episode_id: DS.attr('number'),

  season: DS.attr('number'),

  poster: DS.attr('string'),

  date: DS.attr('date'),

  name: DS.attr('string'),

  summary: DS.attr('string'),

  show: DS.belongsTo('Show')

});

module.exports = Episode;

