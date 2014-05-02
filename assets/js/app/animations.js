define(["jquery"], function($) {
		

	$(document).ready(function() { 
		
	$(".overlay-trigger").on("mouseenter",function(){
			$(this).children("div.grid-list-overlay").slideDown("fast");
		});
	$(".overlay-trigger").on("mouseleave",function(){
			$(this).children("div.grid-list-overlay").slideUp("fast");
	});


	 $('#reg').click(function(e) {
        $('.overlay').show();
        $('#wrapper').show();
        $('html, body').animate({ scrollTop: $('#wrapper').offset().top }, 'slow');
      });

	 $(document).on('keydown', function (e) {
          if (e.keyCode == 27) { // ESC
            $('.overlay').hide();
            $('#wrapper').hide();
      } });
	});
});