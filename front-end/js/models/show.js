var Show = DS.Model.extend({

  imdb_id: DS.attr('number'),

  zap2_id: DS.attr('number'),

  channel_id: DS.attr('number'),

  poster: DS.attr('string'),

  pilot_date: DS.attr('date'),

  name: DS.attr('string'),

  summary: DS.attr('string'),

  lang: DS.attr('string'),

  rating: DS.attr('number'),

  episodecount: DS.attr('number'),

  lst_update: DS.attr('string'),

  watched: DS.attr('boolean')//,

  //episodes: DS.hasMany('Episode')

});

module.exports = Show;

