define(["jquery","domready"], function(jq,domReady) {
		

	domReady(function() { 
	jq(".overlay-trigger").mouseenter(function(e){
			jq(e).children("div.grid-list-overlay").slideDown("fast");
		});
	jq(".overlay-trigger").mouseleave(function(e){
			jq(e).children("div.grid-list-overlay").slideUp("fast");
	});


	 jq('#reg').click(function(e) {
        jq('.overlay').show();
        jq('#wrapper').show();
        jq('html, body').animate({ scrollTop: jq('#wrapper').offset().top }, 'slow');
      });

	 jq(document).on('keydown', function (e) {
          if (e.keyCode == 27) { // ESC
            jq('.overlay').hide();
            jq('#wrapper').hide();
      } });
	});
});