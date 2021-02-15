	function initialize() {
					var center = new google.maps.LatLng(falcons_data.ins_lat ,falcons_data.ins_lng);
					//var center = new google.maps.LatLng(49, 2.56);
					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 14,
						center: center,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					var markers = [];
					var infowindow = new google.maps.InfoWindow();
					var dirs =falcons_data.dirs;
					
					if(dirs!=''){
					 for (i = 0; i < dirs.length; i++) {
						//for(var i=0;i<5;i++){
							//console.log(dirs[i);							
							var latLng = new google.maps.LatLng(dirs[i].lat,dirs[i].lng);
							var marker = new google.maps.Marker({
								position: latLng,
								map: map,
								icon: dirs[i].marker_icon,
							});
							markers.push(marker);
								 google.maps.event.addListener(marker, 'click', (function(marker, i) {
									return function() {
											//infowindow.setContent('<div id="map-marker-info " ><a href="'+dirs[i].link +'">'+dirs[i].image+'<h5>'+ dirs[i].title //+'</h5><span class="address">'+dirs[i].address+'</span></a></div>');											
											infowindow.setContent('<div id="map-marker-info" style="overflow: auto; cursor: default; clear: both; position: relative; border-radius: 4px; padding: 15px; border-color: rgb(255, 255, 255); border-style: solid; background-color: rgb(255, 255, 255); border-width: 1px; width: 275px; min-height: 130px;"><div style="overflow: hidden;" class="map-marker-info"><a  style="text-decoration: none;" href="'+dirs[i].link +'">	<span style="background-image: url('+dirs[i].image+')" class="list-cover has-image"></span><span class="address"><strong>'+dirs[i].title +'</strong></span> <span class="address" style="margin-top:15px">'+dirs[i].address+'</span></a></div></div>');
										infowindow.open(map, marker);
									}
								})(marker, i));
						}
					}
					var markerCluster = new MarkerClusterer(map, markers);
				
				}	
				function cs_toggle_street_view(btn) {
				  var toggle = panorama.getVisible();
				  if (toggle == false) {
					if(btn == 'streetview'){
					  panorama.setVisible(true);
					}
				  } else {
					if(btn == 'mapview'){
					  panorama.setVisible(false);
					}
				  }
				}
                google.maps.event.addDomListener(window, 'load', initialize);					
				
				//google.maps.event.trigger(map, 'resize');					
					jQuery("#search_toggle_div").on('click', function(e) {
						setTimeout(function(){
								initialize();	
								google.maps.event.trigger(map, 'resize');
						},500)							
					});

	
function initialize_address() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
			google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            
            document.getElementById('city').value = place.name;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng(); 
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize_address);
jQuery('input[name="range"]').on("change", function() { 
		//jQuery(this).next().html(jQuery(this).val() + '%');
		jQuery('#rvalue').html(jQuery(this).val());
		jQuery('#range_value').val(jQuery(this).val());
		//console.log(jQuery(this).val());
});

function toggle_top_map(divId) {	
  jQuery("#"+divId).toggle('slow');
  //var t_map= jQuery('#map_toggle_div').html();
  //if(t_map=='Map'){ jQuery('#map_toggle_div').html('Hide Map');}else{jQuery('#map_toggle_div').html('Map');}
       
  setTimeout(
  function() 
  {
	 initialize();	
	google.maps.event.trigger(map, 'resize');
  }, 500);
  
  
  
}
function toggle_top_search(divId) {	
  	
  jQuery("#"+divId).toggle('slow');
   //var t_map= jQuery('#search_toggle_div').html();
 // if(t_map=='Search'){ jQuery('#search_toggle_div').html('Hide Search');}else{jQuery('#search_toggle_div').html('Search');}
  
  initialize();	
  google.maps.event.trigger(map, 'resize');
 
}
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
})
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
    

