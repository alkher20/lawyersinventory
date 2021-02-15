
jQuery( function( $ ) {


    "use strict";
    // console.log(marker_location);

        var contactPageZoom = parseInt(8); 

         // var styles = [
    
         //            {"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},
         //            {"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},
         //            {"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},
         //            {"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},
         //            {"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},
         //            {"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},
         //            {"featureType":"administrative.province","stylers":[{"visibility":"off"}]},
         //            {"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},
         //            {"lightness":-25},{"saturation":-100}]},
         //            {"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}
         //        ]


	/*start google map*/
// if(current_page == 'templates/contact-us.php'){
        new Maplace({
            map_div: '#contact-map',
            locations: marker_location,
            start: 1,           
            map_options: {
                navigationControl: false,                
                scrollwheel: false,  
                zoom: contactPageZoom,
            },

            // styles: { 

            //         'Night': [
            //         {
            //             featureType: 'all',
            //             stylers: [{ invert_lightness: 'true' }]
            //         }
            //     ],
            //     // 'Greyscale':  styles
            // }

        }).Load(); 

// }



});
