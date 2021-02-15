function send_message_iv(){		
		var formc = jQuery("#message-pop");
		if (jQuery.trim(jQuery("#message-content",formc).val()) == "") {
                  alert("Please put your message");
        } else {    
			var ajaxurl = falcons_data.ajaxurl;	
			var loader_image =  falcons_data.loading_image;
				jQuery('#update_message_popup').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_message_send",	
					"form_data":	jQuery("#message-pop").serialize(), 					
				};				
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){											
						jQuery('#update_message_popup').html(response.msg );
						jQuery("#message-pop").trigger('reset');						
					}
				});
		}	
	}
function send_message_claim(){	
			
		var isLogged = falcons_data.current_user_id;                            
        if (isLogged=="0") {                   
                alert(falcons_data.Login_claim);
        } else { 	
			
			var form = jQuery("#message-claim");			
			if (jQuery.trim(jQuery("#message-content", form).val()) == "") {
                  alert("Please put your message");
			} else {
				var ajaxurl = falcons_data.ajaxurl;	
				var loader_image =  falcons_data.loading_image;
				jQuery('#update_message_claim').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_claim_send",	
					"form_data":	jQuery("#message-claim").serialize(), 					
				};				
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){ 											
						jQuery('#update_message_claim').html('   '+response.msg );
						jQuery("#message-claim").trigger('reset');
						
					}
				});
			}
		}	
	
	}
function save_favorite(id) {       
		
		  var isLogged = falcons_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(falcons_data.login_favorite);
                } else { 
						
						var ajaxurl = falcons_data.ajaxurl;
						var search_params={
							"action"  : 	"iv_directories_save_favorite",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								jQuery("#fav_dir"+id).html('<a data-toggle="tooltip" data-placement="bottom" title="'+falcons_data.Add_to_Favorites+'" href="javascript:;" onclick="save_unfavorite('+id+')" ><span class="hide-sm"><i class="fa fa-heart  red-heart fa-lg"></i>&nbsp;&nbsp; </span></a>');
							
								
							}
						});
						
				}  
				
    }
	function save_unfavorite(id) {
		  var isLogged = falcons_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(falcons_data.login_message);
                } else { 
						
						var ajaxurl = falcons_data.ajaxurl;								
						var search_params={
							"action"  : 	"iv_directories_save_un_favorite",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								jQuery("#fav_dir"+id).html('<a data-toggle="tooltip" data-placement="bottom" title="'+falcons_data.Add_to_Favorites+'" href="javascript:;" onclick="save_favorite('+id+')" ><span class="hide-sm"><i class="fa fa-heart fa-lg "></i>&nbsp;&nbsp; </span></a>');
							
								
							}
						});
						
				}  
				
    }	

(function($, window, document, undefined) {
    var slider = $('.cbp-slider');
    slider.find('.cbp-slider-item').addClass('cbp-item');
    slider.cubeportfolio({
        layoutMode: 'slider',
        mediaQueries: [{
            width: 1,
            cols: 1
        }],
        gapHorizontal: 0,
        gapVertical: 0,
        caption: '',
    });
})(jQuery, window, document);
(function($, window, document, undefined) {
    'use strict';
    // init cubeportfolio
    var singlePage = jQuery('#js-singlePage-container').children('div');
    jQuery('#js-grid-slider-projects').cubeportfolio({
        layoutMode: 'slider',
        drag: true,
        auto: false,
        autoTimeout: 4000,
        autoPauseOnHover: true,
        showNavigation: true,
        showPagination: true,
        rewindNav: false,
        scrollByPage: false,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 1500,
            cols: 5
        }, {
            width: 1100,
            cols: 4
        }, {
            width: 800,
            cols: 3
        }, {
            width: 480,
            cols: 2
        }, {
            width: 320,
            cols: 1
        }],
        gapHorizontal: 0,
        gapVertical: 25,
        caption: 'overlayBottomReveal',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,
        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        // singlePage popup
        singlePageDelegate: '.cbp-singlePage',
        singlePageDeeplinking: true,
        singlePageStickyNavigation: true,
        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
        singlePageAnimation: 'fade',
        singlePageCallback: function(url, element) {
            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
            var indexElement = $(element).parents('.cbp-item').index(),
                item = singlePage.eq(indexElement);
            this.updateSinglePage(item.html());},
    });
})(jQuery, window, document);

function save_rating(post_id,rating_text,rating_value) {
		
		  var isLogged = falcons_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(falcons_data.login_review);
                } else { 
						
						var ajaxurl = falcons_data.ajaxurl;								
						var search_params={
							"action"  : 	"iv_directories_save_rating",	
							"data": "id=" + post_id+"&rating_text="+rating_text+"&rating_value="+rating_value,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								var ii=0;
								for(ii=0; ii<=5; ii++){									
									jQuery("#"+rating_text+"_"+ii).removeClass("fa-star");
									jQuery("#"+rating_text+"_"+ii).addClass("fa-star-o");									
								}	
								
								for(ii=0; ii<=rating_value; ii++){
									jQuery("#"+rating_text+"_"+ii).removeClass("fa-star-o");
									jQuery("#"+rating_text+"_"+ii).removeClass("fa-star");
									jQuery("#"+rating_text+"_"+ii).addClass("fa-star");	
								}	
								 
								
							}
						});
						
				}  
				
    }	    
    
