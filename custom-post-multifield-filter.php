<?php

/** 
 * Plugin Name: Custom Post Multifield Filter
 * Description: ACF and custom post type filter with autopopulating dropdowns
 * Author: Octophin Digital
 * Version: 1.0.0
 * Author URI: https://octophindigital.com/

*/

add_action('wp_enqueue_scripts', 'cpf_scripts');

function cpf_scripts() {
    wp_register_style( 'cpf', plugin_dir_url( __FILE__ ) . "/style.css" );
    wp_enqueue_style( 'cpf' );
    wp_enqueue_script( 'cpf', plugin_dir_url( __FILE__ ) . "/script.js");
}

function cpf_print ($options = null){

    $output = array();

    if(!$options){

        return;

    } else {

        $postTypeList = array();

        foreach ($options["content"] as $contentType){

            $type = $contentType["type"];

            $postTypeList[$type] = array(
                "posts" => array(),
                "filters" => array()
            );

            $posts = get_posts(array( 
                'numberposts'		=> -1,
                'post_type'		=> $type,
                'orderby' 		=> 'title',
              ));

            foreach ($posts as $post){

                // Get basic fields

                $indexedPost = array(
                    "title" => $post->post_title,
                    "link" => get_post_permalink($post)
                );

                // Get acf fields

                foreach ($contentType["fields"] as $field){

                    if(!isset($postTypeList[$type]["filters"][$field])){

                        $postTypeList[$type]["filters"][$field] = array();

                    }

                    $fieldValue = get_field($field, $post);

                    if($fieldValue){

                        $indexedPost[$field] = strval($fieldValue);
                       
                        // Add to possible field values for dropdown

                        if(!in_array($fieldValue, $postTypeList[$type]["filters"][$field])){

                            $postTypeList[$type]["filters"][$field][] = $fieldValue;

                        }
                        
                    }

                }

                $postTypeList[$type]["posts"][] = $indexedPost;

            }
        }

        // Include HTML

        include(plugin_dir_path( __FILE__ ) . "/template.php");

        echo "<script>";
        echo "runCpf(JSON.parse(`" . json_encode($postTypeList) . "`));";
        echo "</script>";

    }

};