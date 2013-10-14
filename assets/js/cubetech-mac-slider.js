jQuery(function() {

	var cubetechTimeOut;
	jQuery('.cubetech-mac-slider').mouseover( function() {
		clearTimeout(cubetechTimeOut);
	});
	jQuery('.cubetech-mac-slider').mouseout( function() {
		cubetechTimeOut = setTimeout(cubetechShowDiv, 5000);
	});
	jQuery('.cubetech-mac-slider-content').mouseover( function() {
		clearTimeout(cubetechTimeOut);
	});
	jQuery('.cubetech-mac-slider-content').mouseout( function() {
		cubetechTimeOut = setTimeout(cubetechShowDiv, 5000);
	});

	var present=1;
	var next=2;
	var total_slide=jQuery('.cubetech-mac-slider').children().length;

	cubetechTimeOut = setTimeout(cubetechShowDiv, 8000);
	
	jQuery('.cubetech-mac-slider-icon').first().fadeIn();
	jQuery('.cubetech-mac-slider-slide').first().fadeIn();
	jQuery('.cubetech-mac-slider-control').first().addClass('cubetech-mac-slider-control-active');

	function cubetechShowDiv() {
	    if(jQuery('.cubetech-mac-slider-icon').length) {
	    
	    	clearTimeout(cubetechTimeOut);

	        if(present > 0) {
		        jQuery("#cubetech-mac-slider-icon-"+present).fadeOut();
		        jQuery("#cubetech-mac-slider-slide-"+present).fadeOut();
		        jQuery("#cubetech-mac-slider-control-"+present).removeClass('cubetech-mac-slider-control-active');
		    } else {
			    jQuery('.cubetech-mac-slider-icon').fadeOut();
			    jQuery('.cubetech-mac-slider-slide').fadeOut();
		        jQuery('.cubetech-mac-slider-control').removeClass('cubetech-mac-slider-control-active');
		    }
	        jQuery("#cubetech-mac-slider-icon-"+next).fadeIn(1000);
	        jQuery("#cubetech-mac-slider-slide-"+next).fadeIn(1000);
		    jQuery("#cubetech-mac-slider-control-"+next).addClass('cubetech-mac-slider-control-active');
		    present=next;
	        next++;
	        if(present==total_slide)
	        {
	            present=0;
	            next=1;
	        }
	        
	        cubetechTimeOut = setTimeout(cubetechShowDiv, 8000);
	        
	    }
	}
	
	jQuery('.cubetech-mac-slider-control').click(function() {
		clearTimeout(cubetechTimeOut);
		var index = jQuery(this).index();
		next=index+1;
		present=0;
		cubetechShowDiv();
	});

});
