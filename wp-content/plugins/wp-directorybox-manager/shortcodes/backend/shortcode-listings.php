<?php
/**
 * Shortcode Name : wp_dp_listings
 *
 * @package	wp_dp_cs 
 */
if (!function_exists('wp_dp_cs_var_page_builder_wp_dp_listings')) {

    function wp_dp_cs_var_page_builder_wp_dp_listings($die = 0) {
        global $post, $wp_dp_html_fields, $wp_dp_cs_node, $wp_dp_form_fields;
        if (function_exists('wp_dp_cs_shortcode_names')) {
            $shortcode_element = '';
            $filter_element = 'filterdrag';
            $shortcode_view = '';
            $wp_dp_cs_output = array();
            $wp_dp_cs_PREFIX = 'wp_dp_listings';
            $wp_dp_cs_counter = isset($_POST['counter']) ? $_POST['counter'] : '';
            if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
                $wp_dp_cs_POSTID = '';
                $shortcode_element_id = '';
            } else {
                $wp_dp_cs_POSTID = isset($_POST['POSTID']) ? $_POST['POSTID'] : '';
                $shortcode_element_id = isset($_POST['shortcode_element_id']) ? $_POST['shortcode_element_id'] : '';
                $shortcode_str = stripslashes($shortcode_element_id);
                $parseObject = new ShortcodeParse();
                $wp_dp_cs_output = $parseObject->wp_dp_cs_shortcodes($wp_dp_cs_output, $shortcode_str, true, $wp_dp_cs_PREFIX);
            }
            $defaults = array(
                'listings_title' => '',
                'listings_excerpt_length' => '',
                'listings_title_limit' => '',
                'listings_subtitle' => '',
                'listings_title_alignment' => '',
                'wp_dp_listings_element_subtitle_color' => '',
                'wp_dp_listings_element_title_color' => '',
                'listing_type' => '',
                'listing_topmap' => '',
                'listing_map_position' => '',
                'listing_map_height' => '',
                'listing_view' => '',
                'listing_desc' => '',
                'listing_cus_fields' => '',
                'listing_sort_by' => 'no',
                'listing_layout_switcher' => 'no',
                'listing_layout_switcher_view' => '',
                'listing_search_keyword' => 'no',
                'listing_top_category' => 'no',
                'listing_top_category_count' => '',
                'listing_recent_switch' => 'no',
                'listing_recent_count' => '',
                'listing_footer' => 'no',
                'listing_urgent' => 'no',
                'listing_ads_switch' => 'no',
                'listing_price_filter' => '',
                'listing_filter_accordion' => 'no',
                'listing_enquiry_switch' => 'no',
                'listing_hide_switch' => 'no',
                'listing_notes_switch' => 'no',
                'listing_ads_after_list_count' => '5',
                'listing_location' => '',
                'posts_per_page' => '10',
                'pagination' => '',
                'search_box' => '',
                'filter_search_box' => '',
                'filter_location_box'=>'',
                'left_filter_count' => '',
                'draw_on_map_url' => '',
                'notifications_box' => 'yes',
                'listing_no_custom_fields' => '3',
                'wp_dp_listing_sidebar' => '',
                'listings_grid_column_size' => '',
                'wp_dp_listings_seperator_style' => '',
            );
            $defaults = apply_filters('wp_dp_listings_shortcode_admin_default_attributes', $defaults);
            // Apply filter on default attributes
            $defaults = apply_filters('wp_dp_shortcode_default_atts', $defaults, array('responsive_atts' => true));
            if (isset($wp_dp_cs_output['0']['atts'])) {
                $atts = $wp_dp_cs_output['0']['atts'];
            } else {
                $atts = array();
            }
            if (isset($wp_dp_cs_output['0']['content'])) {
                $listing_right_sidebar_content = $wp_dp_cs_output['0']['content'];
            } else {
                $listing_right_sidebar_content = '';
            }

            $wp_dp_listings_element_size = '100';
            foreach ($defaults as $key => $values) {
                if (isset($atts[$key])) {
                    $$key = $atts[$key];
                } else {
                    $$key = $values;
                }
            }
            $name = 'wp_dp_cs_var_page_builder_wp_dp_listings';
            $coloumn_class = 'column_' . $wp_dp_listings_element_size;
            if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                $shortcode_element = 'shortcode_element_class';
                $shortcode_view = 'cs-pbwp-shortcode';
                $filter_element = 'ajax-drag';
                $coloumn_class = '';
            }
            $listing_rand_id = rand(4444, 99999);
            wp_enqueue_script('wp_dp_cs-admin-upload');
            $listing_views = array(
                'grid' => wp_dp_plugin_text_srt('wp_dp_element_view_grid'),
                'list' => wp_dp_plugin_text_srt('wp_dp_element_view_list'),
             
            );
            ?>

            <div id="<?php echo esc_attr($name . $wp_dp_cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?>
                 <?php echo esc_attr($shortcode_view); ?>" item="wp_dp_listings" data="<?php echo wp_dp_cs_element_size_data_array_index($wp_dp_listings_element_size) ?>" >
                     <?php wp_dp_cs_element_setting($name, $wp_dp_cs_counter, $wp_dp_listings_element_size) ?>
                <div class="cs-wrapp-class-<?php echo intval($wp_dp_cs_counter) ?>
                     <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $wp_dp_cs_counter) ?>" data-shortcode-template="[wp_dp_listings {{attributes}}]{{content}}[/wp_dp_listings]" style="display: none;">
                    <div class="cs-heading-area" data-counter="<?php echo esc_attr($wp_dp_cs_counter) ?>">
                        <h5><?php echo wp_dp_plugin_text_srt('wp_dp_shortcode_listings_options'); ?></h5>
                        <a href="javascript:wp_dp_cs_frame_removeoverlay('<?php echo esc_js($name . $wp_dp_cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose">
                            <i class="icon-cross"></i>
                        </a>
                    </div>
                    <div class="cs-pbwp-content">
                        <div class="cs-wrapp-clone cs-shortcode-wrapp">
                            <?php
                            if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                wp_dp_cs_shortcode_element_size();
                            }

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_element_title'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_element_title_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listings_title),
                                    'id' => 'listings_title',
                                    'cust_name' => 'listings_title[]',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);


                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_element_sub_title'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_element_sub_title_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listings_subtitle),
                                    'id' => 'listings_subtitle',
                                    'cust_name' => 'listings_subtitle[]',
                                    'return' => true,
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_title_align'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_title_align_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listings_title_alignment),
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listings_title_alignment[]',
                                    'return' => true,
                                    'options' => array(
                                        'align-left' => wp_dp_plugin_text_srt('wp_dp_align_left'),
                                        'align-right' => wp_dp_plugin_text_srt('wp_dp_align_right'),
                                        'align-center' => wp_dp_plugin_text_srt('wp_dp_align_center'),
                                    ),
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_color'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_color_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $wp_dp_listings_element_title_color,
                                    'cust_name' => 'wp_dp_listings_element_title_color[]',
                                    'classes' => 'bg_color',
                                    'return' => true,
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_plugin_element_subtitle_color'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_plugin_element_subtitle_color_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $wp_dp_listings_element_subtitle_color,
                                    'cust_name' => 'wp_dp_listings_element_subtitle_color[]',
                                    'classes' => 'bg_color',
                                    'return' => true,
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_seperator'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_seperator_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($wp_dp_listings_seperator_style),
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'wp_dp_listings_seperator_style[]',
                                    'return' => true,
                                    'options' => array(
                                        '' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_seperator_style_none'),
                                        'classic' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_seperator_style_classic'),
                                        'zigzag' => wp_dp_plugin_text_srt('wp_dp_plugin_element_title_seperator_style_zigzag'),
                                    ),
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);


                            $wp_dp_post_listing_types = new Wp_dp_Post_Listing_Types();
                            $listing_types_array = $wp_dp_post_listing_types->wp_dp_types_array_callback(wp_dp_plugin_text_srt('wp_dp_shortcode_listings_all_types'));
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_listing_types'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_type),
                                    'id' => 'listing_type[]',
                                    'classes' => 'chosen-select',
                                    'cust_name' => 'listing_type[]',
                                    'return' => true,
                                    'options' => $listing_types_array
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            ?>
                            <script>
                                function listing_map_position<?php echo absint($listing_rand_id); ?>() {
                                    'use strict';
                                    var listing_topmap = jQuery("#<?php echo 'wp_dp_listing_view' . $listing_rand_id ?>").val();
                                    var listing_layout_switcher = jQuery("#<?php echo 'wp_dp_listing_layout_switcher' . $listing_rand_id ?>").val();
                                    var listing_layout_switcher_view = jQuery("#<?php echo 'wp_dp_listing_layout_switcher_view' . $listing_rand_id ?>").val();
                                    var condition = false;
                                    if (listing_topmap == 'map') {
                                        condition = true;
                                    } else if (listing_layout_switcher == 'yes') {

                                    }
                                    if (condition === false) {
                                        jQuery('.dynamic_map_position<?php echo absint($listing_rand_id); ?>').hide();
                                        jQuery('.dynamic_map_show_position<?php echo absint($listing_rand_id); ?>').show();
                                    } else {
                                        jQuery('.dynamic_map_show_position<?php echo absint($listing_rand_id); ?>').hide();
                                        jQuery('.dynamic_map_position<?php echo absint($listing_rand_id); ?>').show();
                                    }

                                    var view_value = jQuery('#wp_dp_listing_view<?php echo absint($listing_rand_id); ?>').val();

                                    if (view_value == 'grid-medern') {
                                        jQuery('#grid_modern_column_dymanic_<?php echo absint($listing_rand_id); ?>').show();
                                    } else {
                                        jQuery('#grid_modern_column_dymanic_<?php echo absint($listing_rand_id); ?>').hide();
                                    }



                                }
                            </script>
                            <?php
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_element_view'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_element_view_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_view),
                                    'id' => 'listing_view' . $listing_rand_id . '',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listing_view[]',
                                    'extra_atr' => 'onchange="listing_map_position' . $listing_rand_id . '()"',
                                    'return' => true,
                                    'options' => $listing_views
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $excerpt_length_hide_show = 'style="display:block;"';
                            

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_listing_description'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'excerpt_dynamic_fields' . $listing_rand_id . '',
                                'main_wraper_extra' => $excerpt_length_hide_show,
                                'field_params' => array(
                                    'std' => esc_attr($listing_desc),
                                    'id' => 'listing_view' . $listing_rand_id . '',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listing_desc[]',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_element_listing_excerpt_length'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_element_listing_excerpt_length_hint'),
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'excerpt_dynamic_fields' . $listing_rand_id . '',
                                'main_wraper_extra' => $excerpt_length_hide_show,
                                'field_params' => array(
                                    'std' => esc_attr($listings_excerpt_length),
                                    'id' => 'listings_excerpt_length',
                                    'cust_name' => 'listings_excerpt_length[]',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_listings_element_cs_fields'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_cus_fields),
                                    'id' => 'listing_view' . $listing_rand_id . '',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listing_cus_fields[]',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            ?>
                            <script>
                                function listing_layout_switcher_view<?php echo absint($listing_rand_id); ?>($listing_layout_switcher) {
                                    // only for slider view
                                    if ($listing_layout_switcher == 'no') {
                                        jQuery('.layout_dynamic_fields<?php echo absint($listing_rand_id); ?>').hide();
                                    } else {
                                        jQuery('.layout_dynamic_fields<?php echo absint($listing_rand_id); ?>').show();
                                    }
                                    listing_map_position<?php echo absint($listing_rand_id) ?>();
                                }
                                function listing_ads_count<?php echo absint($listing_rand_id); ?>($listing_ads_switcher) {
                                    if ($listing_ads_switcher == 'no') {
                                        jQuery('.listing_count_dynamic_fields<?php echo absint($listing_rand_id); ?>').hide();
                                    } else {
                                        jQuery('.listing_count_dynamic_fields<?php echo absint($listing_rand_id); ?>').show();
                                    }
                                }
                                function show_more_button_count<?php echo absint($listing_rand_id); ?>($show_more_button_switcher) {
                                    if ($show_more_button_switcher == 'no') {
                                        jQuery('.show_more_button_dynamic_fields<?php echo absint($listing_rand_id); ?>').hide();
                                    } else {
                                        jQuery('.show_more_button_dynamic_fields<?php echo absint($listing_rand_id); ?>').show();
                                    }
                                }
                            </script>
                            <?php
                            $grid_modern_size = ' style="display:none;"';
                            if (isset($listing_view) && $listing_view == 'grid-medern') {
                                $grid_modern_size = ' style="display:block;"';
                            }

                            echo '<div id="grid_modern_column_dymanic_' . absint($listing_rand_id) . '"' . $grid_modern_size . '>';

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_plugin_element_listings_grid_size'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_plugin_element_listings_grid_size_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listings_grid_column_size),
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listings_grid_column_size[]',
                                    'return' => true,
                                    'options' => array(
                                        '' => wp_dp_plugin_text_srt('wp_dp_plugin_element_listings_grid_size_4_column'),
                                        '3' => wp_dp_plugin_text_srt('wp_dp_plugin_element_listings_grid_size_3_column'),
                                    ),
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            echo '</div>';

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_title_length'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listings_title_limit),
                                    'id' => 'listings_title_limit',
                                    'cust_name' => 'listings_title_limit[]',
                                    'return' => true,
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_layout_switcher'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_layout_switcher),
                                    'id' => 'listing_layout_switcher' . $listing_rand_id . '',
                                    'cust_name' => 'listing_layout_switcher[]',
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => 'onchange="listing_layout_switcher_view' . $listing_rand_id . '(this.value)"',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            $layout_hide_string = '';
                            if ($listing_layout_switcher == 'no') {
                                $layout_hide_string = 'style="display:none;"';
                            }
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_layout_switcher_views'),
                                'desc' => '',
                                'label_desc' => '',
                                'multi' => true,
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'layout_dynamic_fields' . $listing_rand_id . '',
                                'main_wraper_extra' => $layout_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($listing_layout_switcher_view),
                                    'id' => 'listing_layout_switcher_view' . $listing_rand_id . '',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listing_layout_switcher_view[' . $listing_rand_id . '][]',
                                    'extra_atr' => 'onchange="listing_map_position' . $listing_rand_id . '()"',
                                    'return' => true,
                                    'options' => $listing_views
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            $topmap_position_hide_string = '';
                            $topmap_position_show_string = '';
                            if (( false === strpos($listing_layout_switcher_view, 'map') ) && $listing_view != 'map') {
                                $topmap_position_hide_string = 'style="display:none;"';
                                $topmap_position_show_string = 'style="display:block;"';
                            } else if ($listing_view == 'map') {
                                $topmap_position_show_string = 'style="display:none;"';
                            }

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_map_position'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'dynamic_map_position' . $listing_rand_id . '',
                                'main_wraper_extra' => $topmap_position_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($listing_map_position),
                                    'id' => 'listing_map_position[]',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'listing_map_position[]',
                                    'return' => true,
                                    'options' => array(
                                        'left' => wp_dp_plugin_text_srt('wp_dp_align_left'),
                                        'right' => wp_dp_plugin_text_srt('wp_dp_align_right'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_footer_disable'),
                                'desc' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_footer_disable_desc'),
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'dynamic_map_position' . $listing_rand_id . '',
                                'main_wraper_extra' => $topmap_position_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($listing_footer),
                                    'id' => 'listing_footer[]',
                                    'cust_name' => 'listing_footer[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_left_filters_sidebar'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($search_box),
                                    'id' => 'search_box[]',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'search_box[]',
                                    'extra_atr' => '',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_left_filters'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'dynamic_map_show_position' . $listing_rand_id . '',
                                'main_wraper_extra' => $topmap_position_show_string,
                                'field_params' => array(
                                    'std' => esc_attr($filter_search_box),
                                    'id' => 'filter_search_box[]',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'filter_search_box[]',
                                    'extra_atr' => 'onchange="left_filter_count' . $listing_rand_id . '(this.value)"',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_left_filters_location'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($filter_location_box),
                                    'id' => 'filter_location_box[]',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'filter_location_box[]',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            
                            


                            $left_filter_hide_string = '';
                            if ($search_box == 'no') {
                                $left_filter_hide_string = 'style="display:none;"';
                            }
                            ?>
                            <script>
                                function left_filter_count<?php echo intval($listing_rand_id); ?>($search_box) {
                                    if ($search_box == 'no') {
                                        jQuery('.left_filter_show_position<?php echo intval($listing_rand_id); ?>').hide();
                                    } else {
                                        jQuery('.left_filter_show_position<?php echo intval($listing_rand_id); ?>').show();
                                    }
                                }
                            </script><?php
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_left_filters_count'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'left_filter_show_position' . $listing_rand_id . '',
                                'main_wraper_extra' => $left_filter_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($left_filter_count),
                                    'id' => 'left_filter_count[]',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'left_filter_count[]',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_notifications_box'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($notifications_box),
                                    'id' => 'notifications_box[]',
                                    'classes' => 'chosen-select-no-single',
                                    'cust_name' => 'notifications_box[]',
                                    'return' => true,
                                    'options' => array(
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                    )
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $draw_field_display = ( $notifications_box == 'yes' ) ? 'block' : 'none';
                            echo '<div class="draw_on_map_url_field" style="display:' . $draw_field_display . ';">';
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_draw_on_map'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($draw_on_map_url),
                                    'id' => 'draw_on_map_url',
                                    'cust_name' => 'draw_on_map_url[]',
                                    'return' => true,
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);
                            echo '</div>';

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_members_sort_by'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_sort_by),
                                    'id' => 'listing_sort_by[]',
                                    'cust_name' => 'listing_sort_by[]',
                                    'classes' => 'chosen-select-no-single',
                                    'return' => true,
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_cs_opt_array = array(
                                'std' => absint($listing_rand_id),
                                'id' => '',
                                'cust_name' => "listing_layout_switcher_id[]",
                                'required' => false
                            );
                            $wp_dp_form_fields->wp_dp_form_hidden_render($wp_dp_cs_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_pro_search_keyword_criteria'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_pro_search_keyword_criteria_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_search_keyword),
                                    'id' => 'listing_search_keyword[]',
                                    'cust_name' => 'listing_search_keyword[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            ?>
                            <script>

                                function listing_top_category_count<?php echo absint($listing_rand_id); ?>($listing_top_category) {
                                    if ($listing_top_category == 'no') {
                                        jQuery('.listing_top_category_count_dynamic_fields<?php echo absint($listing_rand_id); ?>').hide();
                                    } else {
                                        jQuery('.listing_top_category_count_dynamic_fields<?php echo absint($listing_rand_id); ?>').show();
                                    }
                                }
                                function listing_recent_count<?php echo absint($listing_rand_id); ?>($listing_recent_switch) {
                                    if ($listing_recent_switch == 'no') {
                                        jQuery('.listing_recent_count_dynamic_fields<?php echo absint($listing_rand_id); ?>').hide();
                                    } else {
                                        jQuery('.listing_recent_count_dynamic_fields<?php echo absint($listing_rand_id); ?>').show();
                                    }
                                }
                            </script>
                            <?php
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_list_meta_top_category'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_top_category),
                                    'id' => 'listing_top_category[]',
                                    'cust_name' => 'listing_top_category[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => 'onchange="listing_top_category_count' . $listing_rand_id . '(this.value)"',
                                    'options' => array(
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                    ),
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            $listing_top_category_count_hide_string = '';
                            if ($listing_top_category == 'no') {
                                $listing_top_category_count_hide_string = 'style="display:none;"';
                            }
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_top_category_count'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'listing_top_category_count_dynamic_fields' . $listing_rand_id . '',
                                'main_wraper_extra' => $listing_top_category_count_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($listing_top_category_count),
                                    'id' => 'listing_top_category_count',
                                    'cust_name' => 'listing_top_category_count[]',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_list_meta_listing_recent_switch'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_list_meta_listing_recent_hint'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_recent_switch),
                                    'id' => 'listing_recent_switch[]',
                                    'cust_name' => 'listing_recent_switch[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => 'onchange="listing_recent_count' . $listing_rand_id . '(this.value)"',
                                    'options' => array(
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                    ),
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            $listing_recent_count_hide_string = '';
                            if ($listing_recent_switch == 'no') {
                                $listing_recent_count_hide_string = 'style="display:none;"';
                            }
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_list_meta_listing_recent_numbers'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'listing_recent_count_dynamic_fields' . $listing_rand_id . '',
                                'main_wraper_extra' => $listing_recent_count_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($listing_recent_count),
                                    'id' => 'listing_recent_count',
                                    'cust_name' => 'listing_recent_count[]',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);


                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_listing_urgent'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_urgent),
                                    'id' => 'listing_urgent[]',
                                    'cust_name' => 'listing_urgent[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'options' => array(
                                        'all' => wp_dp_plugin_text_srt('wp_dp_options_all'),
                                        'only-urgent' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_only_urgent'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_number_of_custom_fields'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'main_wraper' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_no_custom_fields),
                                    'id' => 'listing_no_custom_fields',
                                    'cust_name' => 'listing_no_custom_fields[]',
                                    'return' => true,
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);

                            do_action('wp_dp_compare_listings_element_field', $atts);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_ads_switch'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_ads_switch),
                                    'id' => 'listing_ads_switch[]',
                                    'cust_name' => 'listing_ads_switch[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => 'onchange="listing_ads_count' . $listing_rand_id . '(this.value)"',
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            $listing_count_hide_string = '';
                            if ($listing_ads_switch == 'no') {
                                $listing_count_hide_string = 'style="display:none;"';
                            }

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_count'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_count_hint'),
                                'echo' => true,
                                'main_wraper' => true,
                                'main_wraper_class' => 'listing_count_dynamic_fields' . $listing_rand_id . '',
                                'main_wraper_extra' => $listing_count_hide_string,
                                'field_params' => array(
                                    'std' => esc_attr($listing_ads_after_list_count),
                                    'id' => 'listing_ads_after_list_count',
                                    'cust_name' => 'listing_ads_after_list_count[]',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_right_sidebar_content'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => force_balance_tags($listing_right_sidebar_content),
                                    'id' => 'listing_right_sidebar_content',
                                    'cust_name' => 'listing_right_sidebar_content[]',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_textarea_field($wp_dp_opt_array);

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_enquiry_option'),
                                'desc' => '',
                                'label_desc' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_enquiry_option_desc'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_enquiry_switch),
                                    'id' => 'listing_enquiry_switch[]',
                                    'cust_name' => 'listing_enquiry_switch[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => '',
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

                            

                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_listing_element_price_filter'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_price_filter),
                                    'id' => 'listing_price_filter[]',
                                    'cust_name' => 'listing_price_filter[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => '',
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            
                            
                            $wp_dp_opt_array = array(
                                'name' => wp_dp_plugin_text_srt('wp_dp_listing_element_filters_toggle'),
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($listing_filter_accordion),
                                    'id' => 'listing_filter_accordion[]',
                                    'cust_name' => 'listing_filter_accordion[]',
                                    'return' => true,
                                    'classes' => 'chosen-select-no-single',
                                    'extra_atr' => '',
                                    'options' => array(
                                        'no' => wp_dp_plugin_text_srt('wp_dp_listing_no'),
                                        'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'),
                                    )
                                ),
                            );
                            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);
                            
                            ?>
                            <script>
                                jQuery(document).ready(function () {
                                    jQuery(".save_listing_locations_<?php echo absint($listing_rand_id); ?>").click(function () {
                                        var MY_SELECT = jQuery('#wp_dp_listing_locations_<?php echo absint($listing_rand_id); ?>').get(0);
                                        var selection = ChosenOrder.getSelectionOrder(MY_SELECT);
                                        var listing_location_value = '';
                                        var comma = '';
                                        jQuery(selection).each(function (i) {
                                            listing_location_value = listing_location_value + comma + selection[i];
                                            comma = ',';
                                        });
                                        jQuery('#listing_location_<?php echo absint($listing_rand_id); ?>').val(listing_location_value);
                                    });

                                });
                            </script>
            <?php
            $saved_listing_location = $listing_location;
            $listing_location_options = array(
                'country' => wp_dp_plugin_text_srt('wp_dp_options_country'),
                'state' => wp_dp_plugin_text_srt('wp_dp_options_state'),
                'city' => wp_dp_plugin_text_srt('wp_dp_options_city'),
                'town' => wp_dp_plugin_text_srt('wp_dp_options_town'),
                'address' => wp_dp_plugin_text_srt('wp_dp_options_town_complete_address'),
            );

            if ($saved_listing_location != '') {
                $listing_locations = explode(',', $saved_listing_location);
                foreach ($listing_locations as $listing_loc) {
                    $get_listing_locations[$listing_loc] = $listing_location_options[$listing_loc];
                }
            }
            if ($get_listing_locations) {
                $listing_location_options = array_unique(array_merge($get_listing_locations, $listing_location_options));
            } else {
                $listing_location_options = $listing_location_options;
            }

            $wp_dp_opt_array = array(
                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_location_filter'),
                'desc' => '',
                'label_desc' => '',
                'multi' => true,
                'echo' => true,
                'field_params' => array(
                    'std' => $saved_listing_location,
                    'id' => 'listing_locations_' . $listing_rand_id . '',
                    'classes' => 'chosen-select-no-single',
                    'cust_name' => 'listing_locations[]',
                    'return' => true,
                    'options' => $listing_location_options,
                ),
            );
            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

            $wp_dp_cs_opt_array = array(
                'std' => $listing_location,
                'cust_id' => 'listing_location_' . $listing_rand_id . '',
                'cust_name' => "listing_location[]",
                'required' => false
            );
            $wp_dp_form_fields->wp_dp_form_hidden_render($wp_dp_cs_opt_array);





            $pagination_options = array('no' => wp_dp_plugin_text_srt('wp_dp_listing_no'), 'yes' => wp_dp_plugin_text_srt('wp_dp_listing_yes'));
            $wp_dp_opt_array = array(
                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_members_pagination'),
                'desc' => '',
                'label_desc' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($pagination),
                    'id' => 'pagination',
                    'classes' => 'chosen-select-no-single',
                    'cust_name' => 'pagination[]',
                    'return' => true,
                    'options' => $pagination_options
                ),
            );

            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

            $wp_dp_opt_array = array(
                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_members_posts_per_page'),
                'desc' => '',
                'label_desc' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($posts_per_page),
                    'id' => 'posts_per_page',
                    'cust_name' => 'posts_per_page[]',
                    'return' => true,
                ),
            );

            $wp_dp_html_fields->wp_dp_text_field($wp_dp_opt_array);


            $sidebar_list = array('' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_no_sidebar'));
            foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
                $sidebar_list[$sidebar['id']] = $sidebar['name'];
            }

            $wp_dp_opt_array = array(
                'name' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_sidebar'),
                'desc' => '',
                'label_desc' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($wp_dp_listing_sidebar),
                    'classes' => 'chosen-select-no-single',
                    'cust_name' => 'wp_dp_listing_sidebar[]',
                    'return' => true,
                    'options' => $sidebar_list
                ),
            );

            $wp_dp_html_fields->wp_dp_select_field($wp_dp_opt_array);

            // add responsive fields				
            do_action('wp_dp_shortcode_fields_render', $wp_dp_cs_output, array('responsive_fields' => true));


            $wp_dp_cs_opt_array = array(
                'std' => absint($listing_rand_id),
                'id' => '',
                'cust_id' => 'listing_counter',
                'cust_name' => 'listing_counter[]',
                'required' => false
            );
            $wp_dp_form_fields->wp_dp_form_hidden_render($wp_dp_cs_opt_array);
            ?>
                        </div>
                            <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements insert-bg">
                                <li class="to-field">
                                    <a class="insert-btn cs-main-btn" onclick="javascript:wp_dp_cs_shortcode_insert_editor('<?php echo str_replace('wp_dp_cs_var_page_builder_', '', $name); ?>', '<?php echo esc_js($name . $wp_dp_cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo wp_dp_plugin_text_srt('wp_dp_insert'); ?></a>
                                </li>
                            </ul>
                            <div id="results-shortocde"></div>
            <?php } else { ?>

                            <?php
                            $wp_dp_cs_opt_array = array(
                                'std' => 'wp_dp_listings',
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => '',
                                'extra_atr' => '',
                                'cust_id' => 'wp_dp_cs_orderby' . $wp_dp_cs_counter,
                                'cust_name' => 'wp_dp_cs_orderby[]',
                                'required' => false
                            );
                            $wp_dp_form_fields->wp_dp_form_hidden_render($wp_dp_cs_opt_array);
                            $wp_dp_cs_opt_array = array(
                                'name' => '',
                                'desc' => '',
                                'label_desc' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => wp_dp_plugin_text_srt('wp_dp_save'),
                                    'cust_id' => 'wp_dp_listings_save',
                                    'cust_type' => 'button',
                                    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                    'classes' => 'cs-wp_dp_cs-admin-btn save_listing_locations_' . $listing_rand_id . '',
                                    'cust_name' => 'wp_dp_listings_save',
                                    'return' => true,
                                ),
                            );

                            $wp_dp_html_fields->wp_dp_text_field($wp_dp_cs_opt_array);
                        }
                        ?>
                    </div>
                </div>
                <script type="text/javascript">
                    popup_over();
                    chosen_selectionbox();
                </script>
            </div>

            <?php
        }
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_wp_dp_cs_var_page_builder_wp_dp_listings', 'wp_dp_cs_var_page_builder_wp_dp_listings');
}

if (!function_exists('wp_dp_cs_save_page_builder_data_wp_dp_listings_callback')) {

    /**
     * Save data for wp_dp_listings shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function wp_dp_cs_save_page_builder_data_wp_dp_listings_callback($args) {

        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        $shortcode_data = '';
        if ($widget_type == "wp_dp_listings" || $widget_type == "cs_wp_dp_listings") {
            $wp_dp_cs_bareber_wp_dp_listings = '';

            $page_element_size = $data['wp_dp_listings_element_size'][$counters['wp_dp_cs_global_counter_wp_dp_listings']];
            $current_element_size = $data['wp_dp_listings_element_size'][$counters['wp_dp_cs_global_counter_wp_dp_listings']];

            if (isset($data['wp_dp_cs_widget_element_num'][$counters['wp_dp_cs_counter']]) && $data['wp_dp_cs_widget_element_num'][$counters['wp_dp_cs_counter']] == 'shortcode') {
                $shortcode_str = stripslashes(( $data['shortcode']['wp_dp_listings'][$counters['wp_dp_cs_shortcode_counter_wp_dp_listings']]));

                $element_settings = 'wp_dp_listings_element_size="' . $current_element_size . '"';
                $reg = '/wp_dp_listings_element_size="(\d+)"/s';
                $shortcode_str = preg_replace($reg, $element_settings, $shortcode_str);
                $shortcode_data = $shortcode_str;
                $counters['wp_dp_cs_shortcode_counter_wp_dp_listings'] ++;
            } else {
                $element_settings = 'wp_dp_listings_element_size="' . htmlspecialchars($data['wp_dp_listings_element_size'][$counters['wp_dp_cs_global_counter_wp_dp_listings']]) . '"';
                $wp_dp_cs_bareber_wp_dp_listings = '[wp_dp_listings ' . $element_settings . ' ';
                if (isset($data['listings_title'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listings_title'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listings_title="' . htmlspecialchars($data['listings_title'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listings_title_alignment'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listings_title_alignment'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listings_title_alignment="' . htmlspecialchars($data['listings_title_alignment'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listings_grid_column_size'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listings_grid_column_size'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listings_grid_column_size="' . htmlspecialchars($data['listings_grid_column_size'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_price_filter'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_price_filter'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_price_filter="' . htmlspecialchars($data['listing_price_filter'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_filter_accordion'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_filter_accordion'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_filter_accordion="' . htmlspecialchars($data['listing_filter_accordion'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['wp_dp_listings_element_subtitle_color'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['wp_dp_listings_element_subtitle_color'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'wp_dp_listings_element_subtitle_color="' . htmlspecialchars($data['wp_dp_listings_element_subtitle_color'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['wp_dp_listings_element_title_color'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['wp_dp_listings_element_title_color'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'wp_dp_listings_element_title_color="' . htmlspecialchars($data['wp_dp_listings_element_title_color'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }

                if (isset($data['listings_title_limit'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listings_title_limit'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listings_title_limit="' . htmlspecialchars($data['listings_title_limit'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listings_subtitle'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listings_subtitle'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listings_subtitle="' . htmlspecialchars($data['listings_subtitle'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_type'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_type'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_type="' . htmlspecialchars($data['listing_type'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_topmap'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_topmap'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_topmap="' . htmlspecialchars($data['listing_topmap'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_map_position'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_map_position'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_map_position="' . htmlspecialchars($data['listing_map_position'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_map_height'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_map_height'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_map_height="' . htmlspecialchars($data['listing_map_height'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_view'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_view'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_view="' . htmlspecialchars($data['listing_view'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_desc'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_desc'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_desc="' . htmlspecialchars($data['listing_desc'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }

                if (isset($data['listing_cus_fields'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_cus_fields'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_cus_fields="' . htmlspecialchars($data['listing_cus_fields'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_sort_by'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_sort_by'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_sort_by="' . htmlspecialchars($data['listing_sort_by'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_layout_switcher'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_layout_switcher'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_layout_switcher="' . htmlspecialchars($data['listing_layout_switcher'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['filter_search_box'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['filter_search_box'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'filter_search_box="' . htmlspecialchars($data['filter_search_box'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['filter_location_box'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['filter_location_box'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'filter_location_box="' . htmlspecialchars($data['filter_location_box'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($_POST['listing_layout_switcher_id'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $_POST['listing_layout_switcher_id'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $listing_layout_switcher_id = $_POST['listing_layout_switcher_id'][$counters['wp_dp_cs_counter_wp_dp_listings']];
                    if (isset($_POST['listing_layout_switcher_view'][$listing_layout_switcher_id]) && $_POST['listing_layout_switcher_view'][$listing_layout_switcher_id] != '') {
                        if (is_array($_POST['listing_layout_switcher_view'][$listing_layout_switcher_id])) {
                            $wp_dp_cs_bareber_wp_dp_listings .= ' listing_layout_switcher_view="' . implode(',', $_POST['listing_layout_switcher_view'][$listing_layout_switcher_id]) . '" ';
                        }
                    }
                }
                // saving admin field using filter for add on
                $wp_dp_cs_bareber_wp_dp_listings .= apply_filters('wp_dp_save_listings_shortcode_admin_fields', $wp_dp_cs_bareber_wp_dp_listings, $data, $counters['wp_dp_cs_counter_wp_dp_listings']);
                if (isset($data['listing_search_keyword'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_search_keyword'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_search_keyword="' . htmlspecialchars($data['listing_search_keyword'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['wp_dp_listings_seperator_style'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['wp_dp_listings_seperator_style'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'wp_dp_listings_seperator_style="' . htmlspecialchars($data['wp_dp_listings_seperator_style'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_top_category'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_top_category'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_top_category="' . htmlspecialchars($data['listing_top_category'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_top_category_count'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_top_category_count'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_top_category_count="' . htmlspecialchars($data['listing_top_category_count'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_recent_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_recent_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_recent_switch="' . htmlspecialchars($data['listing_recent_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_recent_count'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_recent_count'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_recent_count="' . htmlspecialchars($data['listing_recent_count'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_footer'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_footer'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_footer="' . htmlspecialchars($data['listing_footer'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_urgent'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_urgent'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_urgent="' . htmlspecialchars($data['listing_urgent'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_no_custom_fields'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_no_custom_fields'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_no_custom_fields="' . htmlspecialchars($data['listing_no_custom_fields'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_ads_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_ads_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_ads_switch="' . htmlspecialchars($data['listing_ads_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_enquiry_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_enquiry_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_enquiry_switch="' . htmlspecialchars($data['listing_enquiry_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_hide_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_hide_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_hide_switch="' . htmlspecialchars($data['listing_hide_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_notes_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_notes_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_notes_switch="' . htmlspecialchars($data['listing_notes_switch'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
               
                if (isset($data['listing_ads_after_list_count'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_ads_after_list_count'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_ads_after_list_count="' . htmlspecialchars($data['listing_ads_after_list_count'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }

                if (isset($data['posts_per_page'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['posts_per_page'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'posts_per_page="' . htmlspecialchars($data['posts_per_page'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['pagination'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['pagination'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'pagination="' . htmlspecialchars($data['pagination'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_counter'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_counter'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_counter="' . htmlspecialchars($data['listing_counter'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['search_box'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['search_box'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'search_box="' . htmlspecialchars($data['search_box'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['left_filter_count'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['left_filter_count'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'left_filter_count="' . htmlspecialchars($data['left_filter_count'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['notifications_box'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['notifications_box'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'notifications_box="' . htmlspecialchars($data['notifications_box'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['draw_on_map_url'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['draw_on_map_url'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'draw_on_map_url="' . htmlspecialchars($data['draw_on_map_url'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listing_location'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_location'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listing_location="' . htmlspecialchars($data['listing_location'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['listings_excerpt_length'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listings_excerpt_length'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'listings_excerpt_length="' . htmlspecialchars($data['listings_excerpt_length'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }
                if (isset($data['wp_dp_listing_sidebar'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['wp_dp_listing_sidebar'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= 'wp_dp_listing_sidebar="' . htmlspecialchars($data['wp_dp_listing_sidebar'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . '" ';
                }

                // Apply filter on default attributes Saving
                $section_title = apply_filters('wp_dp_shortcode_default_atts_save', $wp_dp_cs_bareber_wp_dp_listings, $data, $counters['wp_dp_cs_counter_wp_dp_listings'], array('responsive_atts' => true));
                $wp_dp_cs_bareber_wp_dp_listings = $section_title;

                $wp_dp_cs_bareber_wp_dp_listings .= ']';
                if (isset($data['listing_right_sidebar_content'][$counters['wp_dp_cs_counter_wp_dp_listings']]) && $data['listing_right_sidebar_content'][$counters['wp_dp_cs_counter_wp_dp_listings']] != '') {
                    $wp_dp_cs_bareber_wp_dp_listings .= htmlspecialchars($data['listing_right_sidebar_content'][$counters['wp_dp_cs_counter_wp_dp_listings']], ENT_QUOTES) . ' ';
                }
                $wp_dp_cs_bareber_wp_dp_listings .= '[/wp_dp_listings]';
                echo wp_dp_cs_allow_special_char($wp_dp_cs_bareber_wp_dp_listings);
                $shortcode_data .= $wp_dp_cs_bareber_wp_dp_listings;
                $counters['wp_dp_cs_counter_wp_dp_listings'] ++;
            }
            $counters['wp_dp_cs_global_counter_wp_dp_listings'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter('wp_dp_cs_save_page_builder_data_wp_dp_listings', 'wp_dp_cs_save_page_builder_data_wp_dp_listings_callback');
}

if (!function_exists('wp_dp_cs_load_shortcode_counters_wp_dp_listings_callback')) {

    /**
     * Populate wp_dp_listings shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function wp_dp_cs_load_shortcode_counters_wp_dp_listings_callback($counters) {
        $counters['wp_dp_cs_global_counter_wp_dp_listings'] = 0;
        $counters['wp_dp_cs_shortcode_counter_wp_dp_listings'] = 0;
        $counters['wp_dp_cs_counter_wp_dp_listings'] = 0;
        return $counters;
    }

    add_filter('wp_dp_cs_load_shortcode_counters', 'wp_dp_cs_load_shortcode_counters_wp_dp_listings_callback');
}



if (!function_exists('wp_dp_cs_element_list_populate_wp_dp_listings_callback')) {

    /**
     * Populate wp_dp_listings shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function wp_dp_cs_element_list_populate_wp_dp_listings_callback($element_list) {
        $element_list['wp_dp_listings'] = wp_dp_plugin_text_srt('wp_dp_shortcode_listings_heading');
        return $element_list;
    }

    add_filter('wp_dp_cs_element_list_populate', 'wp_dp_cs_element_list_populate_wp_dp_listings_callback');
}

if (!function_exists('wp_dp_cs_shortcode_names_list_populate_wp_dp_listings_callback')) {

    /**
     * Populate wp_dp_listings shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function wp_dp_cs_shortcode_names_list_populate_wp_dp_listings_callback($shortcode_array) {
        $shortcode_array['wp_dp_listings'] = array(
            'title' => wp_dp_plugin_text_srt('wp_dp_shortcode_listings_heading'),
            'name' => 'wp_dp_listings',
            'icon' => 'icon-house',
            'categories' => 'typography',
        );

        return $shortcode_array;
    }

    add_filter('wp_dp_cs_shortcode_names_list_populate', 'wp_dp_cs_shortcode_names_list_populate_wp_dp_listings_callback');
} 