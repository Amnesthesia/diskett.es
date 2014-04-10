define(["jquery"], function(jq) {
		


	jq(".overlay-trigger").mouseenter(function(){
			jq(this).children("div.grid-list-overlay").show({duration: 800, easing: 'linear'});
		});
	jq(".overlay-trigger").mouseleave(function(){
			jq(this).children("div.grid-list-overlay").slideUp("fast");
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