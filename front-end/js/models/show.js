var Show = DS.Model.extend({

  imdb: DS.attr("string"),

  zap2: DS.attr("string"),

  channel: DS.attr("string"),

  poster: DS.attr("string"),

  pilot_date: DS.attr("string"),

  name: DS.attr("string"),

  summary: DS.attr("string"),

  rating: DS.attr("string"),

  lst_update: DS.attr("number"),

  episodes: DS.hasMany('Episode',{async: true})

});

module.exports = Show;

