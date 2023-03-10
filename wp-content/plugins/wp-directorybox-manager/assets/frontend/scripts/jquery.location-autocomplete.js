jQuery(document).ready(function (jQuery) {
    jQuery.fn.extend({
        cityAutocomplete: function (options) {

            return this.each(function () {

                var input = jQuery(this), opts = jQuery.extend({}, jQuery.cityAutocomplete);
                var input_id = input.data('id');
                
                var autocompleteService = new google.maps.places.AutocompleteService();

                var predictionsDropDown = jQuery('<div class="wp_dp_location_autocomplete" class="city-autocomplete"></div>').appendTo(jQuery(this).parent());

               var currentLocationWrapper = jQuery('<div class="current-location-wrapper" style="display: none;"></div>');
                predictionsDropDown.append(currentLocationWrapper);

                var predictionsLoader = jQuery('<div class="location-loader-wrapper" style="display: none;"><i class="fancy-spinner"></i></div>');
                if( predictionsDropDown.closest('.wp-dp-locations-fields-group').find('label').length > 0 ){
                    predictionsDropDown.closest('.wp-dp-locations-fields-group').find('label').append(predictionsLoader);
                } else {
                    predictionsDropDown.closest('.wp-dp-locations-fields-group').append(predictionsLoader);
                }
                
                var cross_icon = jQuery('.wp-dp-input-cross'+ input_id);

                var currentLocationWrapper = jQuery('<div class="current-location-wrapper" style="display: none;"></div>');
                predictionsDropDown.append(currentLocationWrapper);

                var predictionsGoogleWrapper = jQuery('<div class="location-google-wrapper" style="display: none;"></div>');
                predictionsDropDown.append(predictionsGoogleWrapper);

                var predictionsDBWrapper = jQuery('<div class="location-db-wrapper" style="display: none;"></div>');
                predictionsDropDown.append(predictionsDBWrapper);

                var plugin_url = input.parent(".wp_dp_searchbox_div").data('locationadminurl');

                var last_query = '';
                var new_query = '';
                var xhr = '';
                input.click(function () {
                    cross_icon.hide();
                    predictionsLoader.show();
                    predictionsGoogleWrapper.hide();
                    currentLocationWrapper.hide();
                    predictionsDBWrapper.hide(); 
                    
                    input.attr('placeholder', 'destination, city, address');
                    updateGooglePredictions();
                    predictionsDropDown.show();
                });
//                blur(function () {
//                    input.attr('placeholder', 'Location');
//                });
                input.keyup(function () {
                    new_query = input.val();
                    // Min Number of characters
                    var num_of_chars = 0;
                    if (new_query.length > num_of_chars) {
                        predictionsDropDown.show();
                        predictionsGoogleWrapper.hide();
                        currentLocationWrapper.hide();
                        predictionsDBWrapper.hide();
                        predictionsLoader.show();

                        if (input.hasClass('wp-dp-locations-field-geo' + input_id)) {
                            var params = {
                                input: new_query,
                                bouns: 'upperbound',
                                //types: ['address'],
                                componentRestrictions: '', //{country: window.country_code}
                            };
                            //params.componentRestrictions = ''; //{country: window.country_code}
                            autocompleteService.getPlacePredictions(params, updateGooglePredictions);
                        }
                        updateDBPredictions();
                    } else {
                        predictionsDropDown.hide();
                    }
                    $("input.search_type").val('custom');
                });

                function updateGooglePredictions(predictions, status) {
                    var input_id = input.data('id');
                    var google_results = '';
                    currentLocationWrapper.show();
                    // var dataString = 'action=get_current_locations_for_search';
                    var dataString = 'action=current_location_for_field&input_id=' + input_id;

                    jQuery.ajax({
                        type: "POST",
                        url: wp_dp_globals.ajax_url,
                        data: dataString,
                        success: function (data) {
                            var results = jQuery.parseJSON(data);
                            if (results.current_location !== '') {
                                currentLocationWrapper.empty();
                                currentLocationWrapper.append(results.current_location).show();
                            } else {
                                currentLocationWrapper.hide();
                            }

                            if (google.maps.places.PlacesServiceStatus.OK == status) {
                                // AJAX GET ADDRESS FROM GOOGLE
                                google_results += '<div class="address_headers"><strong>Address</strong></div>'
                                jQuery.each(predictions, function (i, prediction) {
                                    google_results += '<div class="wp_dp_google_suggestions"><i class="icon-location-arrow"></i>' + jQuery.fn.cityAutocomplete.transliterate(prediction.description) + '<span style="display:none">' + jQuery.fn.cityAutocomplete.transliterate(prediction.description) + '</span></div>';
                                });
                                predictionsLoader.hide();
                                if( input.val() != '' ){
                                    cross_icon.show();
                                }
                                predictionsGoogleWrapper.empty().append(google_results).show();
                            } else {
                                predictionsLoader.hide();
                                if( input.val() != '' ){
                                    cross_icon.show();
                                }
                            }
                        }
                    });


                }

                function updateDBPredictions() {
                    if (last_query == new_query) {
                        return;
                    }
                    last_query = new_query;
                    // AJAX GET STATE / PROVINCE.
                    var dataString = 'action=get_locations_for_search' + '&keyword=' + new_query;
                    if (xhr != '') {
                        xhr.abort();
                    }
                    xhr = jQuery.ajax({
                        type: "POST",
                        url: wp_dp_globals.ajax_url,
                        data: dataString,
                        success: function (data) {
                            var results = jQuery.parseJSON(data);
                            if (results.current_location !== '') {
                                currentLocationWrapper.empty();
                                currentLocationWrapper.append(results.current_location).show();
                            }
                            if (results != '') {
                                // Set label for suggestions.
                                var labels_str = "";
                                if (typeof results.title != "undefined") {
                                    labels_str = results.title.join(" / ");
                                }
                                var locations_str = "";
                                // Populate suggestions.
                                if (typeof results.locations_for_display != "undefined") {
                                    var data = results.locations_for_display;
                                    $.each(data, function (key1, val1) {
                                        if (results.location_levels_to_show[0] == true && typeof val1.item != "undefined") {
                                            locations_str += '<div class="wp_dp_google_suggestions wp_dp_location_parent"><i class="icon-location-arrow"></i>' + val1.item.name + '<span style="display:none">' + val1.item.slug + '</span></div>';
                                        }
                                        if (val1.children.length > 0) {
                                            $.each(val1.children, function (key2, val2) {
                                                if (results.location_levels_to_show[1] == true && typeof val2.item != "undefined") {
                                                    locations_str += '<div class="wp_dp_google_suggestions wp_dp_location_child"><i class="icon-location-arrow"></i>' + val2.item.name + '<span style="display:none">' + val2.item.slug + '</span></div>';
                                                }
                                                if (val2.children.length > 0) {
                                                    $.each(val2.children, function (key3, val3) {
                                                        if (results.location_levels_to_show[2] == true && typeof val3.item != "undefined") {
                                                            locations_str += '<div class="wp_dp_google_suggestions wp_dp_location_child"><i class="icon-location-arrow"></i>' + val3.item.name + '<span style="display:none">' + val3.item.slug + '</span></div>';
                                                        }
                                                        if (val3.children.length > 0) {
                                                            $.each(val3.children, function (key4, val4) {
                                                                if (results.location_levels_to_show[3] == true && typeof val4.item != "undefined") {
                                                                    locations_str += '<div class="wp_dp_google_suggestions wp_dp_location_child"><i class="icon-location-arrow"></i>' + val4.item.name + '<span style="display:none">' + val4.item.slug + '</span></div>';
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                    predictionsDBWrapper.empty();
                                    if (locations_str != "") {
                                        predictionsLoader.hide();
                                        if( input.val() != '' ){
                                            cross_icon.show();
                                        }
                                        predictionsDBWrapper.append('<div class="address_headers"><strong>' + labels_str + '</strong></div>' + locations_str).show();
                                    } else {
                                        predictionsLoader.hide();
                                        if( input.val() != '' ){
                                            cross_icon.show();
                                        }
                                    }
                                }
                            }

                        }
                    });
                }

                predictionsDropDown.delegate('div.wp_dp_google_suggestions', 'click', function () {
                    
                    if (jQuery(this).text() != "ADDRESS" && jQuery(this).text() != "STATE / PROVINCE" && jQuery(this).text() != "COUNTRY") {
                        // address with slug			
                      //  var wp_dp_address_html = jQuery(this).text();
                        // slug only
                        var wp_dp_address_slug = jQuery(this).find('span').html();
                        cross_icon.show();
                        // remove slug
                        jQuery(this).find('span').remove();
                        input.val(jQuery(this).text());
                        input.next('.search_keyword').val(wp_dp_address_slug);
                        jQuery("input.search_type").val('autocomplete');
                        input.next('.search_type').val('autocomplete');
                        predictionsDropDown.hide();
                        if( input.parents().find( 'form[name="wp-dp-top-map-form"]' ).length > 0 ) {
                            var id = input.parents().find( 'form[name="wp-dp-top-map-form"]' ).data('id');
                            wp_dp_top_serach_trigger( id );
                        }
                        input.next('.search_keyword').closest("form.side-loc-srch-form").submit();
                        
                    }
                });
                
                

                jQuery(document).mouseup(function (e) {
                    input.attr('placeholder', 'Location');
                    predictionsDropDown.hide();
                });

                jQuery(window).resize(function () {
                    updatePredictionsDropDownDisplay(predictionsDropDown, input);
                });
                updatePredictionsDropDownDisplay(predictionsDropDown, input);
                return input;
            });
        }
    });
    jQuery.fn.cityAutocomplete.transliterate = function (s) {
        s = String(s);
        var char_map = {
            // Latin
            '??': 'A', '????': 'A', '??': 'A', '??': 'A', '??': 'A', '??': 'A', '??': 'AE', '??': 'C',
            '??': 'E', '??': 'E', '??': 'E', '??': 'E', '??': 'I', '????': 'I', '??': 'I', '????': 'I',
                    '????': 'D', '??': 'N', '??': 'O', '??': 'O', '??': 'O', '??': 'O', '??': 'O', '????': 'O',
            '??': 'O', '??': 'U', '??': 'U', '??': 'U', '??': 'U', '??': 'U', '????': 'Y', '??': 'TH',
            '??': 'ss',
            '??': 'a', '??': 'a', '??': 'a', '??': 'a', '??': 'a', '??': 'a', '??': 'ae', '??': 'c',
            '??': 'e', '??': 'e', '??': 'e', '??': 'e', '??': 'i', '??': 'i', '??': 'i', '??': 'i',
            '??': 'd', '??': 'n', '??': 'o', '??': 'o', '??': 'o', '??': 'o', '??': 'o', '??': 'o',
            '??': 'o', '??': 'u', '??': 'u', '??': 'u', '??': 'u', '??': 'u', '??': 'y', '??': 'th',
            '??': 'y',
            // Latin symbols
            '??': '(c)',
            // Greek
            '??': 'A', '??': 'B', '??': 'G', '??': 'D', '??': 'E', '??': 'Z', '??': 'H', '??': '8',
            '??': 'I', '??': 'K', '??': 'L', '??': 'M', '????': 'N', '??': '3', '??': 'O', '??': 'P',
            '??': 'R', '??': 'S', '??': 'T', '??': 'Y', '??': 'F', '??': 'X', '??': 'PS', '??': 'W',
            '??': 'A', '??': 'E', '??': 'I', '??': 'O', '??': 'Y', '??': 'H', '????': 'W', '??': 'I',
            '??': 'Y',
            '??': 'a', '??': 'b', '??': 'g', '??': 'd', '??': 'e', '??': 'z', '??': 'h', '??': '8',
            '??': 'i', '??': 'k', '??': 'l', '??': 'm', '??': 'n', '??': '3', '??': 'o', '??': 'p',
            '????': 'r', '??': 's', '??': 't', '??': 'y', '??': 'f', '??': 'x', '??': 'ps', '??': 'w',
            '??': 'a', '??': 'e', '??': 'i', '??': 'o', '????': 'y', '??': 'h', '??': 'w', '??': 's',
            '??': 'i', '??': 'y', '??': 'y', '????': 'i',
                    // Turkish
                    '??': 'S', '??': 'I', '??': 'C', '??': 'U', '??': 'O', '??': 'G',
            '??': 's', '??': 'i', '??': 'c', '??': 'u', '??': 'o', '??': 'g',
            // Russian
            '????': 'A', '??': 'B', '??': 'V', '??': 'G', '??': 'D', '??': 'E', '????': 'Yo', '??': 'Zh',
            '??': 'Z', '??': 'I', '??': 'J', '??': 'K', '??': 'L', '??': 'M', '????': 'N', '??': 'O',
            '??': 'P', '??': 'R', '??': 'S', '??': 'T', '??': 'U', '??': 'F', '??': 'H', '??': 'C',
            '??': 'Ch', '??': 'Sh', '??': 'Sh', '??': '', '??': 'Y', '??': '', '??': 'E', '??': 'Yu',
            '??': 'Ya',
            '??': 'a', '??': 'b', '??': 'v', '??': 'g', '??': 'd', '??': 'e', '??': 'yo', '??': 'zh',
            '??': 'z', '??': 'i', '??': 'j', '??': 'k', '??': 'l', '??': 'm', '??': 'n', '??': 'o',
            '??': 'p', '??': 'r', '????': 's', '??': 't', '??': 'u', '??': 'f', '??': 'h', '??': 'c',
            '??': 'ch', '??': 'sh', '??': 'sh', '??': '', '??': 'y', '??': '', '????': 'e', '??': 'yu',
            '????': 'ya',
                    // Ukrainian
                    '??'
                    : 'Ye', '??': 'I', '??': 'Yi', '????': 'G',
            '??'
                    : 'ye', '??': 'i', '??': 'yi', '??': 'g',
            // Czech
            '??'
                    : 'C', '??': 'D', '??': 'E', '??': 'N', '??': 'R', '??': 'S', '??': 'T', '??': 'U',
            '??'
                    : 'Z',
            '????'
                    : 'c', '????': 'd', '??': 'e', '??': 'n', '??': 'r', '??': 's', '??': 't', '??': 'u',
            '??'
                    : 'z',
            // Polish
            '??'
                    : 'A', '??': 'C', '??': 'e', '????': 'L', '??': 'N', '??': 'o', '??': 'S', '??': 'Z',
            '??'
                    : 'Z',
            '??'
                    : 'a', '??': 'c', '??': 'e', '??': 'l', '??': 'n', '??': 'o', '??': 's', '??': 'z',
            '??'
                    : 'z',
            // Latvian
            '??'
                    : 'A', '??': 'C', '??': 'E', '??': 'G', '??': 'i', '??': 'k', '??': 'L', '??': 'N',
            '??'
                    : 'S', '??': 'u', '??': 'Z',
                    '????'
                    : 'a', '????': 'c', '??': 'e', '??': 'g', '??': 'i', '??': 'k', '??': 'l', '??': 'n',
            '??'
                    : 's', '??': 'u', '??': 'z'
        };
        for (var k in char_map) {
            //s = s.replace(new RegExp(k, 'g'), char_map[k]);
        }
        return s;
    };
    function updatePredictionsDropDownDisplay(dropDown, input) {
        if (typeof (input.offset()) !== 'undefined') {
            dropDown.css({
                'width': input.outerWidth(),
                'left': input.offset().left,
                'top': input.offset().top + input.outerHeight()
            });
        }
    }

    jQuery('input.wp_dp_search_location_field').cityAutocomplete();

    jQuery(document).on('click', '.wp_dp_searchbox_div', function () {
        jQuery('.wp_dp_search_location_field').prop('disabled', false);
    });

    jQuery(document).on('click', 'form', function () {
        var src_loc_val = jQuery(this).find('.wp_dp_search_location_field');
        src_loc_val.next('.search_keyword').val(src_loc_val.val());
    });
//    jQuery(document).on('click', '.wp-dp-location-field', function () {
//        var $this = jQuery(this);
//       var input_id = $this.data('id');
//        $this.closest('.wp_dp_searchbox_div').find('.wp_dp_location_autocomplete').show();
//        var dataString = 'action=current_location_for_field&input_id=' + input_id; ;
//        jQuery.ajax({
//            type: "POST",
//            url: wp_dp_globals.ajax_url,
//            data: dataString,
//            success: function (data) {  
//                $this.closest('.wp_dp_searchbox_div').find('.wp_dp_location_autocomplete').html(data);
//               // jQuery(this).closest('.wp_dp_searchbox_div').find('.wp_dp_location_autocomplete').show();
//
//            }
//        });
//       
//    });
    //if (jQuery(".main-header .field-holder.search-input.with-search-country .search-country input").length != "") {
    // $('.main-header .field-holder.search-input.with-search-country .search-country input').focus(function() {
    //  $(this).attr('placeholder', 'destination, city, address')
    // }).blur(function() {
    //  $(this).attr('placeholder', 'Location')
    // });
    //}
}(jQuery));