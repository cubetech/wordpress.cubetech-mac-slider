jQuery(function() {

	var cubetechTimeOut;
	jQuery('.cubetech-mac-slider').mouseover( function() {
		clearTimeout(cubetechTimeOut);
	});
	jQuery('.cubetech-mac-slider').mouseout( function() {
		cubetechTimeOut = setTimeout(cubetechShowDiv, 2500);
	});
	jQuery('.cubetech-mac-slider-content').mouseover( function() {
		clearTimeout(cubetechTimeOut);
	});
	jQuery('.cubetech-mac-slider-content').mouseout( function() {
		cubetechTimeOut = setTimeout(cubetechShowDiv, 2500);
	});

	var present=1;
	var next=2;
	var total_slide=jQuery('.cubetech-mac-slider').children().length;

	cubetechTimeOut = setTimeout(cubetechShowDiv, 5000);
	
	jQuery('.cubetech-mac-slider-icon').first().fadeIn();
	jQuery('.cubetech-mac-slider-slide').first().fadeIn();

	function cubetechShowDiv() {
	    if(jQuery('.cubetech-icon-slider-icon').length) {

	        if(present > 0) {
		        jQuery("#cubetech-mac-slider-icon-"+present).fadeOut();
		        jQuery("#cubetech-mac-slider-slide-"+present).fadeOut();
		    } else {
			    jQuery('.cubetech-mac-slider-icon').last().fadeOut();
			    jQuery('.cubetech-mac-slider-slide').last().fadeOut();
		    }
	        jQuery("#cubetech-mac-slider-icon-"+next).fadeIn(1000);
	        jQuery("#cubetech-mac-slider-slide-"+next).fadeIn(1000);
	        present++;
	        next++;
	        if(present==total_slide)
	        {
	            present=0;
	            next=1;
	        }
	        
	        cubetechTimeOut = setTimeout(cubetechShowDiv, 5000);
	        
	    }
	}
	
	jQuery('li.cubetech-mac-slider-icon').hover(function() {
		var cubetechHoverID = jQuery(this).index();
		jQuery('.cubetech-mac-slider-slide').not(':eq(' + cubetechHoverID + ')').fadeOut(100);
		jQuery('.cubetech-mac-slider-thumb-second').not(':eq(' + cubetechHoverID + ')').fadeOut(100);
		jQuery('.cubetech-mac-slider-thumb-active-icon').not(':eq(' + cubetechHoverID + ')').removeClass('cubetech-mac-slider-thumb-active');
		jQuery('.cubetech-mac-slider-icon').not(':eq(' + cubetechHoverID + ')').removeClass('cubetech-mac-slider-active');

		jQuery('.cubetech-mac-slider-slide').eq(cubetechHoverID).fadeIn(200);
		jQuery('.cubetech-mac-slider-thumb-second').eq(cubetechHoverID).fadeIn(200);
		jQuery('.cubetech-mac-slider-thumb-active-icon').eq(cubetechHoverID).addClass('cubetech-mac-slider-thumb-active');
		jQuery('.cubetech-mac-slider-icon').eq(cubetechHoverID).addClass('cubetech-mac-slider-active');
	});

});