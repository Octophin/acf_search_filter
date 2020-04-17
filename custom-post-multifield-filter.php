<?php

/** 
 * Plugin Name: Custom Post Multifield Filter
 * Description: ACF and custom post type filter with autopopulating dropdowns
 * Author: Octophin Digital
 * Version: 2.0.0
 * Author URI: https://octophindigital.com/

 */

add_action('wp_enqueue_scripts', 'cpf_scripts');

function cpf_scripts()
{
    wp_register_style('cpf', plugin_dir_url(__FILE__) . "/style.css");
    wp_enqueue_style('cpf');
    wp_enqueue_script('cpf', plugin_dir_url(__FILE__) . "/script.js", [], null, true);
}

function cpf_print($options = null)
{

    $output = array();

    if (!$options) {

        return;
    } else {

        $groups = array();

        foreach ($options as $groupName => $contentTypes) {

            $groups[$groupName] = array();

            foreach ($contentTypes as $contentType) {

                // Add the content type to the group

                $type = $contentType["type"];
                $typeLabel = $contentType["label"];

                $groups[$groupName][$typeLabel] = array(
                    "posts" => array(),
                    "filters" => array()
                );

                $posts = get_posts(array(
                    'numberposts'        => -1,
                    'post_type'        => $type,
                    'orderby'         => 'title',
                ));

                foreach ($posts as $post) {

                    // Get basic fields

                    $indexedPost = array(
                        "title" => $post->post_title,
                        "link" => get_post_permalink($post)
                    );

                    // Get acf fields

                    foreach ($contentType["fields"] as $fieldLabel => $field) {

                        if (!isset($groups[$groupName][$typeLabel]["filters"][$fieldLabel])) {

                            $groups[$groupName][$typeLabel]["filters"][$fieldLabel] = array();
                        }

                        $fieldValue = get_field($field, $post);

                        if ($fieldValue) {

                            $indexedPost[$fieldLabel] = strval($fieldValue);

                            // Add to possible field values for dropdown

                            if (!in_array($fieldValue, $groups[$groupName][$typeLabel]["filters"][$fieldLabel])) {

                                $groups[$groupName][$typeLabel]["filters"][$fieldLabel][] = $fieldValue;
                            }
                        }
                    }

                    $groups[$groupName][$typeLabel]["posts"][] = $indexedPost;
                }
            }
        }

        // Include HTML

        include(plugin_dir_path(__FILE__) . "/template.php");

        echo "<script>";
        echo "window.cpf = JSON.parse(`" . json_encode($groups) . "`);";
        echo "</script>";
    }
}
