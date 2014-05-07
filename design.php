<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EpisodeGuide</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700" />
    <link rel="stylesheet" href="assets/css/foundation.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate-custom.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/lib/covers-carousel/css/jquery.covers-carousel.css" />
    <script data-main="assets/js/config" src="assets/js/lib/requirejs/require.js"></script>
    <!-- Templates go here (we'll add some AJAX loading for them later) -->
    <script id="shows.episodes" type="text/x-handlebars" data-template-name="episodes">

       {{this.name}}

    </script>
  </head>
  <body>
  <!-- Navigation goes here -->
  <section id="navigation"></section>

  <section id="content">
    <script type="text/x-handlebars">
    {{outlet}}
    <!-- Grid should go here --> 
    </script>
    <script id="shows-template" type="text/x-handlebars" data-template-name="shows">
   <div class="carousel-wrapper">
    <div class="carousel-items">
       {{#each controller itemController="show"}} 
        <div class="item small-3 columns browse-list browse-item overlay-trigger" id="{{unbound id}}">
          <div class="progress browse-item-rating-progress">
            <div class="browse-item-rating">{{ratingText}}</div>
            <span class="meter" style="margin-left: -1px;width: {{unbound ratingLength}}%"></span>
          </div>
          <div class="browse-item-splitter">
            {{#link-to "shows.episodes" this.id}}
              <img src="media/posters/{{unbound poster}}" alt="media/posters/{{unbound poster}}" />
            
            
              <h5>{{name}}</h5>
            {{/link-to}}
          </div>
          <div class="browse-item-actions">
             
              <div class="button small primary follow-button" {{action follow}}> +Follow</div>
              
              
              <div class="button small read-more-button"> More</div>
              
              <div class="clear">&nbsp;</div>
          </div>
        </div>
      {{/each}}

    </div> 
     
   </div>
    </script>

  </section>
  </body>
</html>
