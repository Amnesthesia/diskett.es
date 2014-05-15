var Episode = DS.Model.extend({

  episodeNum: DS.attr('number'),

  season: DS.attr('number'),

  //poster: DS.attr('string'),

  date: DS.attr('date'),

  name: DS.attr('string'),

  summary: DS.attr('string'),

  show: DS.belongsTo('Show')

});

module.exports = Episode;

