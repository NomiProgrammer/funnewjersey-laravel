<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script>
        var pm_tag = 's3c';
        var pm_pid = "23751-12f1f0fc";
    </script>
    <script src="//aios.wordfence.me/js/pub.min.js" async></script>

    @php

        $canonical = url()->current();
    @endphp
    <!-- End Google Tag Manager -->
    <link rel="canonical" href="<?= $canonical ?>" />
    <?php if (isset($_GET['itinerary'])) {
    ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css"><?php } ?>
    <?php
    $page = get_current_page();
    if (!isset($sub_title)) {
        $sub_title = isset($page['title']) ? $page['title'] : lang_key('list_your_ad');
    }
    $seo = isset($page['seo_settings']) && $page['seo_settings'] != '' ? (array) json_decode($page['seo_settings']) : [];
    if (!isset($meta_title)) {
        $meta_title = isset($seo['meta_title']) ? $seo['meta_title'] : get_settings('site_settings', 'key_words', 'car dealership,car listing, house, car');
    }
    if (!isset($meta_desc)) {
        $meta_desc = isset($seo['meta_description']) ? $seo['meta_description'] : get_settings('site_settings', 'meta_description', '');
    }
    if (!isset($key_words)) {
        $key_words = isset($seo['key_words']) ? $seo['key_words'] : get_settings('site_settings', 'key_words', 'car dealership,car listing, house, car');
    }
    if (!isset($crawl_after)) {
        $crawl_after = isset($seo['crawl_after']) ? $seo['crawl_after'] : get_settings('site_settings', 'crawl_after', 3);
    }
    ?>
    <?php
    if (isset($post)) {
        echo isset($post) ? social_sharing_meta_tags_for_post($post) : '';
    } elseif (isset($blog_meta)) {
        echo isset($blog_meta) ? social_sharing_meta_tags_for_blog($blog_meta) : '';
    }
    ?>
    <?php
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($actual_link);
    $path_parts = explode('/', $parts['path']);
    $county1 = $path_parts[4];
    $city1 = $path_parts[5];
    $category1 = $path_parts[6];
    $region1 = $path_parts[7];
    $state = 0;
    if ($county1 != 0) {
        $county = $path_parts[4];
    } else {
        $county = 0;
    }
    if ($city1 != 0) {
        $city = $path_parts[5];
    } else {
        $city = 0;
    }
    if ($category1 != 0) {
        $category = $path_parts[6];
    } else {
        $category = 0;
    }
    if ($region1 != 0) {
        $region = $path_parts[7];
    } else {
        $region = 0;
    }
    ?>
    <title><?php if (isset($data)) {
                $servername = "localhost";
                $username = "funnewjersey_database_new";
                $password = "?VS#%!Wy-X7+";
                $dbname = "funnewjersey_database_new";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM dbc_categories WHERE id=" . $data['category'] . " AND metatitle != ''";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if ($data['state'] > 0) {
                            $variables1 = array("state" => "" . get_location_name_by_id($data['state']) . "");
                        } else {
                            $variables1 = array("state" => "");
                        }
                        if ($data['region'] > 0) {
                            if ($data['region'] == 1) {
                                $variables4 = array("region" => "Northern ");
                            }
                            if ($data['region'] == 2) {
                                $variables4 = array("region" => "Central ");
                            }
                            if ($data['region'] == 3) {
                                $variables4 = array("region" => "Southern ");
                            }
                        } else {
                            $variables4 = array("region" => "");
                        }
                        if ($data['city'] > 0) {
                            $variables2 = array("city" => "" . get_location_name_by_id($data['city']) . ", ");
                        } else {
                            $variables2 = array("city" => "");
                        }
                        if ($data['county'] > 0) {

                            $variables3 = array("county" => "" . get_location_name_by_id($data['county']) . ", ");
                        } else {
                            $variables3 = array("county" => "");
                        }
                        $variables = array("category" => "" . get_category_title_by_id($data['category']) . "");
                        $string = $row['metatitle'];
                        $result33 = array_merge(
                            is_array($variables1) ? $variables1 : [],
                            is_array($variables2) ? $variables2 : [],
                            is_array($variables3) ? $variables3 : [],
                            is_array($variables4) ? $variables4 : [],
                            is_array($variables)  ? $variables  : []
                        );
                        foreach ($result33 as $key => $value) {
                            $string = str_replace('{' . strtoupper($key) . '}', $value, $string);
                        }
                        if ($data['city'] > 0) {
                            echo $string;
                        } elseif ($data['county'] > 0) {
                            echo $string;
                        } elseif ($data['region'] > 0) {

                            echo $string;
                        } elseif ($data['state'] > 0) {

                            echo $string;
                        } else {
                            echo str_replace(' in ', '', $string);
                        }
                    }
                } else {
                    echo '';
                    if ($data['category'] > 0) {
                        echo get_category_title_by_id($data['category']);
                    } else {
                        echo "Fun Things to Do";
                    }
                    if (($data['city'] >= 1 || $data['county'] >= 1 || $data['region'] >= 1 || $data['state'] >= 1)) {
                        echo ' in ';
                    }
                    if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                echo ", ";
                                            }
                                            if ($data['region'] > 0) {
                                                if ($data['region'] == 1) {
                                                    echo "Northern ";
                                                }
                                                if ($data['region'] == 2) {

                                                    echo "Central ";
                                                }
                                                if ($data['region'] == 3) {

                                                    echo "Southern ";
                                                }
                                            }

                                            echo get_location_name_by_id($data['state']);
                                            echo ' - List of the best ';
                                            if ($data['category'] > 0) {
                                                echo get_category_title_by_id($data['category']);
                                            } else {
                                                echo "Fun Things to Do";
                                            }
                                            echo ' ';
                                            if (isset($data['city'], $data['county'], $data['region'], $data['state'])) {
                                                echo " in ";
                                            }
                                            if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                        echo ", ";
                                                                    }

                                                                    if ($data['region'] > 0) {

                                                                        if ($data['region'] == 1) {

                                                                            echo "Northern ";
                                                                        }
                                                                        if ($data['region'] == 2) {

                                                                            echo "Central ";
                                                                        }
                                                                        if ($data['region'] == 3) {

                                                                            echo "Southern ";
                                                                        }
                                                                    }
                                                                    echo get_location_name_by_id($data['state']);
                                                                }
                                                            } elseif (strpos($_SERVER['REQUEST_URI'], 'microblog') !== false) {








                                                                $servername = "localhost";
                                                                $username = "funnewjersey_database_new";
                                                                $password = "?VS#%!Wy-X7+";
                                                                $dbname = "funnewjersey_database_new";

                                                                // Create connection
                                                                $conn77 = new mysqli($servername, $username, $password, $dbname);
                                                                // Check connection
                                                                if ($conn77->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }
                                                                $blogcat = intval($_GET["catid"]);
                                                                $sqlg = "SELECT * FROM dbc_post_categories WHERE id=$blogcat ";
                                                                $resultg = $conn77->query($sqlg);

                                                                if ($resultg->num_rows > 0) {
                                                                    // output data of each row
                                                                    while ($rowg = $resultg->fetch_assoc()) {





                                                                        echo $rowg['metatitle'];
                                                                    }
                                                                }
                                                            } elseif (strpos($_SERVER['REQUEST_URI'], 'post-detail') !== false) {




                                                                $blogpostid = $blogpost->id;


                                                                $servername = "localhost";
                                                                $username = "funnewjersey_database_new";
                                                                $password = "?VS#%!Wy-X7+";
                                                                $dbname = "funnewjersey_database_new";

                                                                // Create connection
                                                                $conn77 = new mysqli($servername, $username, $password, $dbname);
                                                                // Check connection
                                                                if ($conn77->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }

                                                                $sqlg = "SELECT * FROM dbc_blog WHERE id=$blogpostid ";
                                                                $resultg = $conn77->query($sqlg);

                                                                if ($resultg->num_rows > 0) {
                                                                    // output data of each row
                                                                    while ($rowg = $resultg->fetch_assoc()) {





                                                                        echo $rowg['bmetatitle'];
                                                                    }
                                                                }
                                                            } elseif ($category > 0) {





                                                                $servername = "localhost";
                                                                $username = "funnewjersey_database_new";
                                                                $password = "?VS#%!Wy-X7+";
                                                                $dbname = "funnewjersey_database_new";
                                                                // Create connection
                                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                                // Check connection
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }

                                                                $sqls = "SELECT * FROM dbc_metas
                                                                WHERE category = " . $this->db->escape($category) . "
                                                                AND metatitle != ''
                                                                AND status = 1
                                                                AND (
                                                                   (county = " . $this->db->escape($county) . " AND county > 0)
                                                                   OR (city = " . $this->db->escape($city) . " AND city > 0)
                                                                   OR (region = " . $this->db->escape($region) . " AND region > 0)
                                                                )
                                                                LIMIT 1";

                                                                $results = $conn->query($sqls);

                                                                if ($results->num_rows > 0) {
                                                                    // output data of each row
                                                                    while ($rows = $results->fetch_assoc()) {

                                                                        echo $rows['metatitle'];
                                                                    }
                                                                } else {


















                                                                    $sql = "SELECT * FROM dbc_categories WHERE id='$category' AND metatitle != ''";
                                                                    $result = $conn->query($sql);

                                                                    if ($result->num_rows > 0) {
                                                                        // output data of each row
                                                                        while ($row = $result->fetch_assoc()) {

                                                                            if ($state > 0) {
                                                                                $variables1 = array("state" => "" . get_location_name_by_id($state) . "");
                                                                            } else {
                                                                                $variables1 = array("state" => "");
                                                                            }
                                                                            if ($region > 0) {
                                                                                if ($region == 1) {

                                                                                    $variables4 = array("region" => "Northern ");
                                                                                }
                                                                                if ($region == 2) {

                                                                                    $variables4 = array("region" => "Central ");
                                                                                }
                                                                                if ($region == 3) {

                                                                                    $variables4 = array("region" => "Southern ");
                                                                                }
                                                                            } else {
                                                                                $variables4 = array("region" => "");
                                                                            }


                                                                            if ($city > 0) {
                                                                                $variables2 = array("city" => "" . get_location_name_by_id($city) . ", ");
                                                                            } else {
                                                                                $variables2 = array("city" => "");
                                                                            }
                                                                            if ($county > 0) {

                                                                                $variables3 = array("county" => "" . get_location_name_by_id($county) . ", ");
                                                                            } else {
                                                                                $variables3 = array("county" => "");
                                                                            }

                                                                            $variables = array("category" => "" . get_category_title_by_id($category) . "");





                                                                            $string = $row['metatitle'];
                                                                            $result33 = array_merge($variables1, $variables2, $variables3, $variables4, $variables);

                                                                            foreach ($result33 as $key => $value) {
                                                                                $string = str_replace('{' . strtoupper($key) . '}', $value, $string);
                                                                            }
                                                                            if ($city > 0) {
                                                                                echo $string;
                                                                            } elseif ($county > 0) {
                                                                                echo $string;
                                                                            } elseif ($region > 0) {

                                                                                echo $string;
                                                                            } elseif ($state > 0) {

                                                                                echo $string;
                                                                            } else {
                                                                                echo str_replace(' in ', '', $string);
                                                                            }
                                                                        }
                                                                    } else {





                                                                        echo '';
                                                                        if ($category > 0) {
                                                                            echo get_category_title_by_id($category);
                                                                        } else {
                                                                            echo "Fun Things to Do";
                                                                        }
                                                                        if (($city >= 1 || $county >= 1 || $region >= 1 || $state >= 1)) {
                                                                            echo ' in ';
                                                                        }
                                                                        if ($city > 0) {  ?><?php echo get_location_name_by_id($city);
                                                                                            echo ", ";
                                                                                        }
                                                                                        if ($region > 0) {

                                                                                            if ($region == 1) {

                                                                                                echo "Northern ";
                                                                                            }
                                                                                            if ($region == 2) {

                                                                                                echo "Central ";
                                                                                            }
                                                                                            if ($region == 3) {

                                                                                                echo "Southern ";
                                                                                            }
                                                                                        }

                                                                                        echo get_location_name_by_id($state);
                                                                                        echo ' - List of the best ';
                                                                                        if ($category > 0) {
                                                                                            echo get_category_title_by_id($category);
                                                                                        } else {
                                                                                            echo "Fun Things to Do";
                                                                                        }
                                                                                        echo ' ';
                                                                                        if (isset($city, $county, $region, $state)) {
                                                                                            echo " in ";
                                                                                        }
                                                                                        if ($city > 0) {  ?><?php echo get_location_name_by_id($city);
                                                                                                            echo ", ";
                                                                                                        }

                                                                                                        if ($region > 0) {

                                                                                                            if ($region == 1) {

                                                                                                                echo "Northern ";
                                                                                                            }
                                                                                                            if ($region == 2) {

                                                                                                                echo "Central ";
                                                                                                            }
                                                                                                            if ($region == 3) {

                                                                                                                echo "Southern ";
                                                                                                            }
                                                                                                        }
                                                                                                        echo get_location_name_by_id($state);
                                                                                                    }
                                                                                                }
                                                                                            } elseif (isset($location_id)) {


                                                                                                if (get_location_metatitle_by_id($location_id) != "") {
                                                                                                    echo get_location_metatitle_by_id($location_id);
                                                                                                } else {



                                                                                                    echo "Find the Absolute Best Things to Do in and Around ";
                                                                                                    echo get_location_name_by_id($location_id);
                                                                                                    echo " NJ";
                                                                                                }

                                                                                                            ?>


        <?php
                                                                                            } elseif (isset($countries)) {

                                                                                                echo 'Fun things to do in ';
                                                                                                echo get_location_name_by_id($location_id);
                                                                                            } elseif (isset($post)) {
                                                                                                $post = $post->row();
                                                                                                if ($post->metatitle) {

                                                                                                    echo $post->metatitle;
                                                                                                } else {

                                                                                                    echo get_post_data_by_lang($post, 'title');
                                                                                                    echo ', ' . get_category_title_by_id($post->category) . ', in ';

                                                                                                    echo get_location_name_by_id($post->city);
                                                                                                    echo ", ";
                                                                                                    echo get_location_name_by_id($post->state);
                                                                                                    echo ", ";
                                                                                                    echo get_location_name_by_id($post->country);
                                                                                                }
                                                                                            } elseif (isset($user)) {

                                                                                                $actual_link2 = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                                                                                                $parts2 = parse_url($actual_link2);
                                                                                                $path_parts2 = explode('/', $parts2['path']);
                                                                                                $userid = $path_parts2[3];

                                                                                                echo "" . get_user_fullname_by_id($userid) . "'s Profile Page | FunNewJersey.com";
                                                                                            } elseif (isset($category_id)) {


                                                                                                echo get_category_metatitle_by_id($category_id);
                                                                                            } elseif (isset($tag)) {


                                                                                                echo get_tag_metatitle_by_id($tag);
                                                                                            } else {


                                                                                                if ($county > 0) {



                                                                                                    if ($county == 1) {

                                                                                                        echo "Things to See and Do in Northern NJ | Attractions in North Jersey";
                                                                                                    }

                                                                                                    if ($county == 2) {

                                                                                                        echo "Top Attractions and Things to Do in and Around Central NJ";
                                                                                                    }


                                                                                                    if ($county == 3) {

                                                                                                        echo "Best Things to do in Southern NJ | Where to Go & What to Do";
                                                                                                    }
                                                                                                } else {


                                                                                                    ///homepage
                                                                                                    echo $meta_title;
                                                                                                }
                                                                                            } ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if ($location_id == 778 || $location_id == 779) { ?>
    <meta name="robots" content="noindex" />
    <?php } ?>


    <?php if ($post->nofollow > 0) { ?>


    <meta name="robots" content="noindex, nofollow" />

    <?php } ?>

    <meta name="keywords"
        content="<?php if (isset($data)) {


                                        $servername = "localhost";
                                        $username = "funnewjersey_database_new";
                                        $password = "?VS#%!Wy-X7+";
                                        $dbname = "funnewjersey_database_new";
                                        // Create connection
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        // Check connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT * FROM dbc_categories WHERE id=" . $data['category'] . " AND metakeywords != ''";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {



                                                if ($data['state'] > 0) {
                                                    $variables1 = array("state" => "" . get_location_name_by_id($data['state']) . "");
                                                } else {
                                                    $variables1 = array("state" => "");
                                                }
                                                if ($data['city'] > 0) {
                                                    $variables2 = array("city" => "" . get_location_name_by_id($data['city']) . " ");
                                                } else {
                                                    $variables2 = array("city" => "");
                                                }

                                                if ($data['region'] > 0) {
                                                    $variables21 = array("region" => "" . get_location_name_by_id($data['region']) . " ");
                                                } else {
                                                    $variables21 = array("region" => "");
                                                }
                                                if ($data['county'] > 0) {

                                                    $variables3 = array("county" => "" . get_location_name_by_id($data['county']) . " ");
                                                } else {
                                                    $variables3 = array("county" => "");
                                                }

                                                $variables = array("category" => "" . get_category_title_by_id($data['category']) . "");
                                                $string = $row['metakeywords'];
                                                $result33 = array_merge($variables1, $variables2, $variables21, $variables3, $variables);

                                                foreach ($result33 as $key => $value) {
                                                    $string = str_replace('{' . strtoupper($key) . '}', $value, $string);
                                                }

                                                if ($data['city'] > 0) {
                                                    echo $string;
                                                } elseif ($data['county'] > 0) {
                                                    echo $string;
                                                } elseif ($data['region'] > 0) {

                                                    echo $string;
                                                } elseif ($data['state'] > 0) {

                                                    echo $string;
                                                } else {
                                                    echo str_replace(' in ', '', $string);
                                                }
                                            }
                                        } else {
                                            echo '';
                                            if ($data['category'] > 0) {
                                                echo get_category_title_by_id($data['category']);
                                            } else {
                                                echo "Fun Things to Do";
                                            }
                                            if (isset($data['city'], $data['county'], $data['state'])) {
                                                echo ' in ';
                                            }
                                            if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                        echo ", ";
                                                                    }
                                                                    echo get_location_name_by_id($data['state']) . ',  ';

                                                                    if ($data['category'] > 0) {
                                                                        echo get_category_title_by_id($data['category']);
                                                                    } else {
                                                                        echo "Fun Things to Do";
                                                                    }
                                                                    echo ' for hire in ';
                                                                    if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                                                echo ", ";
                                                                                            }
                                                                                            echo get_location_name_by_id($data['state']) . ', best ';
                                                                                            if ($data['category'] > 0) {
                                                                                                echo get_category_title_by_id($data['category']);
                                                                                            } else {
                                                                                                echo "Fun Things to Do";
                                                                                            }
                                                                                            if (isset($data['city'], $data['county'], $data['state'])) {
                                                                                                echo ' in ';
                                                                                            }
                                                                                            if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                                                                        echo ", ";
                                                                                                                    }
                                                                                                                    if ($data['region'] > 0) {

                                                                                                                        if ($data['region'] == 1) {

                                                                                                                            echo "Northern ";
                                                                                                                        }
                                                                                                                        if ($data['region'] == 2) {

                                                                                                                            echo "Central ";
                                                                                                                        }
                                                                                                                        if ($data['region'] == 3) {

                                                                                                                            echo "Southern ";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    echo get_location_name_by_id($data['state']) . ', ';

                                                                                                                    if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                                                                                                echo ", ";
                                                                                                                                            }

                                                                                                                                            echo get_location_name_by_id($data['state']) . ' ';
                                                                                                                                            if ($data['category'] > 0) {
                                                                                                                                                echo get_category_title_by_id($data['category']);
                                                                                                                                            } else {
                                                                                                                                                echo "Fun Things to Do";
                                                                                                                                            }
                                                                                                                                            echo ' ';
                                                                                                                                        }
                                                                                                                                    } elseif ($category > 0) {











                                                                                                                                        $servername = "localhost";
                                                                                                                                        $username = "funnewjersey_database_new";
                                                                                                                                        $password = "?VS#%!Wy-X7+";
                                                                                                                                        $dbname = "funnewjersey_database_new";

                                                                                                                                        // Create connection
                                                                                                                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                                                                                                                        // Check connection
                                                                                                                                        if ($conn->connect_error) {
                                                                                                                                            die("Connection failed: " . $conn->connect_error);
                                                                                                                                        }



                                                                                                                                        $sqls = "SELECT * FROM dbc_metas WHERE category='$category' AND metakeywords != '' AND status = 1 AND (county='$county' AND county > 0 OR city ='$city' AND city > 0 OR region = '$region' AND region > 0) LIMIT 1";
                                                                                                                                        $results = $conn->query($sqls);

                                                                                                                                        if ($results->num_rows > 0) {
                                                                                                                                            // output data of each row
                                                                                                                                            while ($rows = $results->fetch_assoc()) {

                                                                                                                                                echo $rows['metakeywords'];
                                                                                                                                            }
                                                                                                                                        } else {




                                                                                                                                            $sql = "SELECT * FROM dbc_categories WHERE id='$category' AND metakeywords != ''";
                                                                                                                                            $result = $conn->query($sql);

                                                                                                                                            if ($result->num_rows > 0) {
                                                                                                                                                // output data of each row
                                                                                                                                                while ($row = $result->fetch_assoc()) {

                                                                                                                                                    if ($state > 0) {
                                                                                                                                                        $variables1 = array("state" => "" . get_location_name_by_id($state) . "");
                                                                                                                                                    } else {
                                                                                                                                                        $variables1 = array("state" => "");
                                                                                                                                                    }
                                                                                                                                                    if ($region > 0) {
                                                                                                                                                        if ($region == 1) {

                                                                                                                                                            $variables4 = array("region" => "Northern ");
                                                                                                                                                        }
                                                                                                                                                        if ($region == 2) {

                                                                                                                                                            $variables4 = array("region" => "Central ");
                                                                                                                                                        }
                                                                                                                                                        if ($region == 3) {

                                                                                                                                                            $variables4 = array("region" => "Southern ");
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        $variables4 = array("region" => "");
                                                                                                                                                    }


                                                                                                                                                    if ($city > 0) {
                                                                                                                                                        $variables2 = array("city" => "" . get_location_name_by_id($city) . ", ");
                                                                                                                                                    } else {
                                                                                                                                                        $variables2 = array("city" => "");
                                                                                                                                                    }
                                                                                                                                                    if ($county > 0) {

                                                                                                                                                        $variables3 = array("county" => "" . get_location_name_by_id($county) . ", ");
                                                                                                                                                    } else {
                                                                                                                                                        $variables3 = array("county" => "");
                                                                                                                                                    }

                                                                                                                                                    $variables = array("category" => "" . get_category_title_by_id($category) . "");





                                                                                                                                                    $string = $row['metakeywords'];
                                                                                                                                                    $result33 = array_merge($variables1, $variables2, $variables3, $variables4, $variables);

                                                                                                                                                    foreach ($result33 as $key => $value) {
                                                                                                                                                        $string = str_replace('{' . strtoupper($key) . '}', $value, $string);
                                                                                                                                                    }
                                                                                                                                                    if ($city > 0) {
                                                                                                                                                        echo $string;
                                                                                                                                                    } elseif ($county > 0) {
                                                                                                                                                        echo $string;
                                                                                                                                                    } elseif ($region > 0) {

                                                                                                                                                        echo $string;
                                                                                                                                                    } elseif ($state > 0) {

                                                                                                                                                        echo $string;
                                                                                                                                                    } else {
                                                                                                                                                        echo str_replace(' in ', '', $string);
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            } else {





                                                                                                                                                echo '';
                                                                                                                                                if ($category > 0) {
                                                                                                                                                    echo get_category_title_by_id($category);
                                                                                                                                                } else {
                                                                                                                                                    echo "Fun Things to Do";
                                                                                                                                                }
                                                                                                                                                if (($city >= 1 || $county >= 1 || $region >= 1 || $state >= 1)) {
                                                                                                                                                    echo ' in ';
                                                                                                                                                }
                                                                                                                                                if ($city > 0) {  ?><?php echo get_location_name_by_id($city);
                                                                                                                                                                    echo ", ";
                                                                                                                                                                }
                                                                                                                                                                if ($region > 0) {

                                                                                                                                                                    if ($region == 1) {

                                                                                                                                                                        echo "Northern ";
                                                                                                                                                                    }
                                                                                                                                                                    if ($region == 2) {

                                                                                                                                                                        echo "Central ";
                                                                                                                                                                    }
                                                                                                                                                                    if ($region == 3) {

                                                                                                                                                                        echo "Southern ";
                                                                                                                                                                    }
                                                                                                                                                                }

                                                                                                                                                                echo get_location_name_by_id($state);
                                                                                                                                                                echo ' - List of the best ';
                                                                                                                                                                if ($category > 0) {
                                                                                                                                                                    echo get_category_title_by_id($category);
                                                                                                                                                                } else {
                                                                                                                                                                    echo "Fun Things to Do";
                                                                                                                                                                }
                                                                                                                                                                echo ' ';
                                                                                                                                                                if (isset($city, $county, $region, $state)) {
                                                                                                                                                                    echo " in ";
                                                                                                                                                                }
                                                                                                                                                                if ($city > 0) {  ?><?php echo get_location_name_by_id($city);
                                                                                                                                                                                    echo ", ";
                                                                                                                                                                                }

                                                                                                                                                                                if ($region > 0) {

                                                                                                                                                                                    if ($region == 1) {

                                                                                                                                                                                        echo "Northern ";
                                                                                                                                                                                    }
                                                                                                                                                                                    if ($region == 2) {

                                                                                                                                                                                        echo "Central ";
                                                                                                                                                                                    }
                                                                                                                                                                                    if ($region == 3) {

                                                                                                                                                                                        echo "Southern ";
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                                echo get_location_name_by_id($state);
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    } elseif (isset($location_id)) {








                                                                                                                                                                        if (get_location_metakeywords_by_id($location_id) != "") {
                                                                                                                                                                            echo get_location_metakeywords_by_id($location_id);
                                                                                                                                                                        } else {



                                                                                                                                                                            echo " things to do in ";
                                                                                                                                                                            echo get_location_name_by_id($location_id);
                                                                                                                                                                            echo " NJ, fun things to do in ";
                                                                                                                                                                            echo get_location_name_by_id($location_id);
                                                                                                                                                                            echo " NJ";
                                                                                                                                                                        }




                                                                                                                                                                                    ?>
<?php








                                                                                                                                                                    } elseif (isset($countries)) {

                                                                                                                                                                        echo 'Fun Things to Do in ' . get_location_name_by_id($location_id) . ', Find the Best Things to do in ' . get_location_name_by_id($location_id) . '';
                                                                                                                                                                    } elseif (isset($post)) {
                                                                                                                                                                        if ($post->metakeywords) {

                                                                                                                                                                            echo $post->metakeywords;
                                                                                                                                                                        } else {
                                                                                                                                                                            echo get_post_data_by_lang($post, 'title');
                                                                                                                                                                            echo " ";
                                                                                                                                                                            echo get_location_name_by_id($post->city) . ' ' . get_location_name_by_id($post->state) . ' ' . get_location_name_by_id($post->country) . ' ';
                                                                                                                                                                        }
                                                                                                                                                                    } elseif (isset($user)) {



                                                                                                                                                                        echo "" . get_user_fullname_by_id($userid) . "'s Profile Page";
                                                                                                                                                                    } elseif (isset($category_id)) {


                                                                                                                                                                        echo get_category_metakeywords_by_id($category_id);
                                                                                                                                                                    } elseif (isset($tag)) {


                                                                                                                                                                        echo get_tag_keywords_by_id($tag);
                                                                                                                                                                    } else {





                                                                                                                                                                        if ($county > 0) {



                                                                                                                                                                            if ($county == 1) {

                                                                                                                                                                                echo "Things to do in North Jersey, Northern NJ attractions";
                                                                                                                                                                            }

                                                                                                                                                                            if ($county == 2) {

                                                                                                                                                                                echo "Things to do in central NJ,  attractions in Central NJ";
                                                                                                                                                                            }


                                                                                                                                                                            if ($county == 3) {

                                                                                                                                                                                echo "Things to do in South Jersey, best places to visit in Southern NJ";
                                                                                                                                                                            }
                                                                                                                                                                        } else {

                                                                                                                                                                            echo $key_words;
                                                                                                                                                                        }
                                                                                                                                                                    } ?>

" />
    <meta name="description"
        content="<?php if (isset($data)) {


                                            $servername = "localhost";
                                            $username = "funnewjersey_database_new";
                                            $password = "?VS#%!Wy-X7+";
                                            $dbname = "funnewjersey_database_new";

                                            // Create connection
                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            // Check connection
                                            if ($conn->connect_error) {
                                                die("Connection failed: " . $conn->connect_error);
                                            }

                                            $sql = "SELECT * FROM dbc_categories WHERE id=" . $data['category'] . " AND metadescription != ''";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {



                                                    if ($data['state'] > 0) {
                                                        $variables1 = array("state" => "" . get_location_name_by_id($data['state']) . "");
                                                    } else {
                                                        $variables1 = array("state" => "");
                                                    }
                                                    if ($data['region'] > 0) {
                                                        if ($data['region'] == 1) {

                                                            $variables4 = array("region" => "Northern ");
                                                        }
                                                        if ($data['region'] == 2) {

                                                            $variables4 = array("region" => "Central ");
                                                        }
                                                        if ($data['region'] == 3) {

                                                            $variables4 = array("region" => "Southern ");
                                                        }
                                                    } else {
                                                        $variables4 = array("region" => "");
                                                    }



                                                    if ($data['city'] > 0) {
                                                        $variables2 = array("city" => "" . get_location_name_by_id($data['city']) . ", ");
                                                    } else {
                                                        $variables2 = array("city" => "");
                                                    }
                                                    if ($data['county'] > 0) {

                                                        $variables3 = array("county" => "" . get_location_name_by_id($data['county']) . ", ");
                                                    } else {
                                                        $variables3 = array("county" => "");
                                                    }

                                                    $variables = array("category" => "" . get_category_title_by_id($data['category']) . "");
                                                    $string = $row['metadescription'];
                                                    $result33 = array_merge(
                                                        is_array($variables1) ? $variables1 : [],
                                                        is_array($variables2) ? $variables2 : [],
                                                        is_array($variables3) ? $variables3 : [],
                                                        is_array($variables4) ? $variables4 : [],
                                                        is_array($variables)  ? $variables  : []
                                                    );
                                                    foreach ($result33 as $key => $value) {
                                                        $string = str_replace('{' . strtoupper($key) . '}', $value, $string);
                                                    }

                                                    if ($data['city'] > 0) {
                                                        echo $string;
                                                    } elseif ($data['county'] > 0) {
                                                        echo $string;
                                                    } elseif ($data['region'] > 0) {

                                                        echo $string;
                                                    } elseif ($data['state'] > 0) {

                                                        echo $string;
                                                    } else {
                                                        echo str_replace(' in ', '', $string);
                                                    }
                                                }
                                            } else {
                                                echo 'Find ';
                                                if ($data['category'] > 0) {
                                                    echo get_category_title_by_id($data['category']);
                                                } else {
                                                    echo "Fun Things to Do";
                                                }
                                                echo ' ';
                                                if (isset($data['city'], $data['county'], $data['state'])) {
                                                    echo " in ";
                                                }
                                                if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                            echo ", ";
                                                                        }
                                                                        echo get_location_name_by_id($data['state']) . '. ';
                                                                        if ($data['city'] > 0) {  ?><?php echo get_location_name_by_id($data['city']);
                                                                                                    echo ", ";
                                                                                                }
                                                                                                if ($data['region'] > 0) {

                                                                                                    if ($data['region'] == 1) {

                                                                                                        echo "Northern ";
                                                                                                    }
                                                                                                    if ($data['region'] == 2) {

                                                                                                        echo "Central ";
                                                                                                    }
                                                                                                    if ($data['region'] == 3) {

                                                                                                        echo "Southern ";
                                                                                                    }
                                                                                                }
                                                                                                echo get_location_name_by_id($data['state']);
                                                                                                if ($data['category'] > 0) {
                                                                                                    echo " ";
                                                                                                    echo get_category_title_by_id($data['category']);
                                                                                                } else {
                                                                                                    echo "Fun Things to Do";
                                                                                                }
                                                                                                '
';
                                                                                            }
                                                                                        } elseif (strpos($_SERVER['REQUEST_URI'], 'microblog') !== false) {







                                                                                            $servername = "localhost";
                                                                                            $username = "funnewjersey_database_new";
                                                                                            $password = "?VS#%!Wy-X7+";
                                                                                            $dbname = "funnewjersey_database_new";
                                                                                            // Create connection
                                                                                            $conn77 = new mysqli($servername, $username, $password, $dbname);
                                                                                            // Check connection
                                                                                            if ($conn77->connect_error) {
                                                                                                die("Connection failed: " . $conn->connect_error);
                                                                                            }
                                                                                            $blogcat = intval($_GET["catid"]);
                                                                                            $sqlg = "SELECT * FROM dbc_post_categories WHERE id=$blogcat ";
                                                                                            $resultg = $conn77->query($sqlg);

                                                                                            if ($resultg->num_rows > 0) {
                                                                                                // output data of each row
                                                                                                while ($rowg = $resultg->fetch_assoc()) {





                                                                                                    echo $rowg['metadesc'];
                                                                                                }
                                                                                            }
                                                                                        } elseif (strpos($_SERVER['REQUEST_URI'], 'post-detail') !== false) {




                                                                                            $blogpostid = $blogpost->id;



                                                                                            $servername = "localhost";
                                                                                            $username = "funnewjersey_database_new";
                                                                                            $password = "?VS#%!Wy-X7+";
                                                                                            $dbname = "funnewjersey_database_new";

                                                                                            // Create connection
                                                                                            $conn77 = new mysqli($servername, $username, $password, $dbname);
                                                                                            // Check connection
                                                                                            if ($conn77->connect_error) {
                                                                                                die("Connection failed: " . $conn->connect_error);
                                                                                            }

                                                                                            $sqlg = "SELECT * FROM dbc_blog WHERE id=$blogpostid ";
                                                                                            $resultg = $conn77->query($sqlg);

                                                                                            if ($resultg->num_rows > 0) {
                                                                                                // output data of each row
                                                                                                while ($rowg = $resultg->fetch_assoc()) {





                                                                                                    echo $rowg['bmetadescription'];
                                                                                                }
                                                                                            }
                                                                                        } elseif ($category > 0) {




                                                                                            $servername = "localhost";
                                                                                            $username = "funnewjersey_database_new";
                                                                                            $password = "?VS#%!Wy-X7+";
                                                                                            $dbname = "funnewjersey_database_new";

                                                                                            // Create connection
                                                                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                                                                            // Check connection
                                                                                            if ($conn->connect_error) {
                                                                                                die("Connection failed: " . $conn->connect_error);
                                                                                            }






                                                                                            $sqls = "SELECT * FROM dbc_metas WHERE category='$category'  AND metadesc != '' AND status = 1 AND (county='$county' AND county > 0 OR city = '$city' AND city > 0 OR region = '$region' AND region > 0) LIMIT 1";
                                                                                            $results = $conn->query($sqls);

                                                                                            if ($results->num_rows > 0) {
                                                                                                // output data of each row
                                                                                                while ($rows = $results->fetch_assoc()) {

                                                                                                    echo $rows['metadesc'];
                                                                                                }
                                                                                            } else {







                                                                                                $sql = "SELECT * FROM dbc_categories WHERE id='$category' AND metadescription != ''";
                                                                                                $result = $conn->query($sql);

                                                                                                if ($result->num_rows > 0) {
                                                                                                    // output data of each row
                                                                                                    while ($row = $result->fetch_assoc()) {

                                                                                                        if ($state > 0) {
                                                                                                            $variables1 = array("state" => "" . get_location_name_by_id($state) . "");
                                                                                                        } else {
                                                                                                            $variables1 = array("state" => "");
                                                                                                        }
                                                                                                        if ($region > 0) {
                                                                                                            if ($region == 1) {

                                                                                                                $variables4 = array("region" => "Northern ");
                                                                                                            }
                                                                                                            if ($region == 2) {

                                                                                                                $variables4 = array("region" => "Central ");
                                                                                                            }
                                                                                                            if ($region == 3) {

                                                                                                                $variables4 = array("region" => "Southern ");
                                                                                                            }
                                                                                                        } else {
                                                                                                            $variables4 = array("region" => "");
                                                                                                        }


                                                                                                        if ($city > 0) {
                                                                                                            $variables2 = array("city" => "" . get_location_name_by_id($city) . ", ");
                                                                                                        } else {
                                                                                                            $variables2 = array("city" => "");
                                                                                                        }
                                                                                                        if ($county > 0) {

                                                                                                            $variables3 = array("county" => "" . get_location_name_by_id($county) . ", ");
                                                                                                        } else {
                                                                                                            $variables3 = array("county" => "");
                                                                                                        }

                                                                                                        $variables = array("category" => "" . get_category_title_by_id($category) . "");





                                                                                                        $string = $row['metadescription'];
                                                                                                        $result33 = array_merge($variables1, $variables2, $variables3, $variables4, $variables);

                                                                                                        foreach ($result33 as $key => $value) {
                                                                                                            $string = str_replace('{' . strtoupper($key) . '}', $value, $string);
                                                                                                        }
                                                                                                        if ($city > 0) {
                                                                                                            echo $string;
                                                                                                        } elseif ($county > 0) {
                                                                                                            echo $string;
                                                                                                        } elseif ($region > 0) {

                                                                                                            echo $string;
                                                                                                        } elseif ($state > 0) {

                                                                                                            echo $string;
                                                                                                        } else {
                                                                                                            echo str_replace(' in ', '', $string);
                                                                                                        }
                                                                                                    }
                                                                                                } else {





                                                                                                    echo '';
                                                                                                    if ($category > 0) {
                                                                                                        echo get_category_title_by_id($category);
                                                                                                    } else {
                                                                                                        echo "Fun Things to Do";
                                                                                                    }
                                                                                                    if (($city >= 1 || $county >= 1 || $region >= 1 || $state >= 1)) {
                                                                                                        echo ' in ';
                                                                                                    }
                                                                                                    if ($city > 0) {  ?><?php echo get_location_name_by_id($city);
                                                                                                                        echo ", ";
                                                                                                                    }
                                                                                                                    if ($region > 0) {

                                                                                                                        if ($region == 1) {

                                                                                                                            echo "Northern ";
                                                                                                                        }
                                                                                                                        if ($region == 2) {

                                                                                                                            echo "Central ";
                                                                                                                        }
                                                                                                                        if ($region == 3) {

                                                                                                                            echo "Southern ";
                                                                                                                        }
                                                                                                                    }

                                                                                                                    echo get_location_name_by_id($state);
                                                                                                                    echo ' - List of the best ';
                                                                                                                    if ($category > 0) {
                                                                                                                        echo get_category_title_by_id($category);
                                                                                                                    } else {
                                                                                                                        echo "Fun Things to Do";
                                                                                                                    }
                                                                                                                    echo ' ';
                                                                                                                    if (isset($city, $county, $region, $state)) {
                                                                                                                        echo " in ";
                                                                                                                    }
                                                                                                                    if ($city > 0) {  ?><?php echo get_location_name_by_id($city);
                                                                                                                                        echo ", ";
                                                                                                                                    }

                                                                                                                                    if ($region > 0) {

                                                                                                                                        if ($region == 1) {

                                                                                                                                            echo "Northern ";
                                                                                                                                        }
                                                                                                                                        if ($region == 2) {

                                                                                                                                            echo "Central ";
                                                                                                                                        }
                                                                                                                                        if ($region == 3) {

                                                                                                                                            echo "Southern ";
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    echo get_location_name_by_id($state);
                                                                                                                                }
                                                                                                                            }
                                                                                                                        } elseif (isset($location_id)) {



                                                                                                                            if (get_location_metadescription_by_id($location_id) != "") {
                                                                                                                                echo get_location_metadescription_by_id($location_id);
                                                                                                                            } else {



                                                                                                                                echo " ";

                                                                                                                                echo " Find fun things to do and unique places to visit in ";
                                                                                                                                echo get_location_name_by_id($location_id);
                                                                                                                                echo " NJ. Attractions are pulled from all of our site categories to give you a great broad diverse selection.";
                                                                                                                            }



                                                                                                                                        ?>
<?php


                                                                                                                        } elseif (isset($countries)) {

                                                                                                                            echo $meta_desc;
                                                                                                                        } elseif (isset($post)) {
                                                                                                                            if ($post->metadescription) {

                                                                                                                                echo $post->metadescription;
                                                                                                                            } else {

                                                                                                                                echo 'See company information, hours of operation, availability, and pricing about ' . get_post_data_by_lang($post, 'title') . ', ' . get_category_title_by_id($post->category) . ', in ' . get_location_name_by_id($post->city) . ', ' . get_location_name_by_id($post->state) . ', ' . get_location_name_by_id($post->country) . '. ';
                                                                                                                            }
                                                                                                                        } elseif (isset($category_id)) {


                                                                                                                            echo get_category_metadesc_by_id($category_id);
                                                                                                                        } elseif (isset($user)) {



                                                                                                                            echo "See " . get_user_fullname_by_id($userid) . "'s business profile page and listings that he has uploaded on FunNewJersey.com. " . get_user_fullname_by_id($userid) . " is a verified registered user with access to our backend.";
                                                                                                                        } elseif (isset($tag)) {


                                                                                                                            echo get_tag_desc_by_id($tag);
                                                                                                                        } else {

                                                                                                                            if ($county > 0) {



                                                                                                                                if ($county == 1) {

                                                                                                                                    echo "We’ve compiled the ultimate list of the best fun activities & attractions in the Northern region of the Garden State! Find hundreds of things to do in North Jersey.";
                                                                                                                                }

                                                                                                                                if ($county == 2) {

                                                                                                                                    echo "Complete list of all things to do in and around Central NJ. Find fun attractions, day trip ideas, kid-friendly spots, services and more. All sorted by category.";
                                                                                                                                }


                                                                                                                                if ($county == 3) {

                                                                                                                                    echo "Find the best places to visit and things to do in Southern NJ. Your guide to attractions, services, nightlife and more. Search all of our listings by category.";
                                                                                                                                }
                                                                                                                            } else {
                                                                                                                                echo $meta_desc;
                                                                                                                            }
                                                                                                                        } ?>">

    <meta name="revisit-after" content="<?php echo $crawl_after; ?> days">

    <link rel="icon" type="image/png" href="<?php echo theme_url(); ?>/assets/img/favicon.png">
    <?php require_once 'includes_top.php'; ?>

    <?php
    
    $top_bar_bg_color = get_settings('banner_settings', 'top_bar_bg_color', '#fdfdfd');
    
    $bg_color = get_settings('banner_settings', 'menu_bg_color', '#ffffff');
    
    $text_color = get_settings('banner_settings', 'menu_text_color', '#666');
    
    $active_text_color = get_settings('banner_settings', 'active_menu_text_color', '#32c8de');
    
    ?>

    <style>
        .intrinsic-container {
            position: relative;
            height: 0;
            overflow: hidden;
        }

        /* 16x9 Aspect Ratio */
        .intrinsic-container-16x9 {
            padding-bottom: 56.25%;
        }

        /* 4x3 Aspect Ratio */
        .intrinsic-container-4x3 {
            padding-bottom: 75%;
        }

        .intrinsic-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #tooltip {
            display: inline;
            position: relative;
        }

        #tooltip:hover:after {
            background: #333;
            background: rgba(0, 0, 75, .8);
            border-radius: 5px;
            bottom: 26px;
            color: #fff;
            content: attr(title);
            left: 20%;
            text-align: center;
            padding: 5px;
            position: absolute;
            z-index: 999999;
            width: 120px;
        }

        #tooltip:hover:before {
            border: solid;
            border-color: #333 transparent;
            border-width: 6px 6px 0 6px;
            bottom: 20px;
            content: "";
            left: 50%;
            position: absolute;
            z-index: 9999999;
        }

        .top-bar {
            background: <?php echo $top_bar_bg_color; ?>;
        }

        a.fill-div {
            display: block;
            height: 100%;
            width: 100%;
            text-decoration: none;
        }

        .header-2 {
            background: url(<?php echo base_url(); ?>assets/topbg.png);
        }


        .header-2 .navy>ul>li>ul {
            background: <?php echo $bg_color; ?>;
            background-color: #fff;
            font-weight: normal;
        }

        .header-2 .navy>ul>li>a {
            color: <?php echo $text_color; ?>;
            font-weight: normal;
        }

        #mapimage {
            display: inline-block;
        }

        #countyblock {
            border-right: 3px solid #173769;
            display: inline-block;
        }

        @media (max-width: 785px) {
            .header-2 .navy>ul>li>a {
                color: #333;
                font-weight: normal;
            }

            #countyblock {
                border-right: none;
                display: none;
            }

            #category-form {
                display: none;
            }

            #mapimage {
                display: none;
            }
        }

        .header-2 .navy ul ul li a {
            color: #333;
            font-weight: normal;
        }

        .header-2 .navy>ul>li>a:hover {
            color: <?php echo $active_text_color; ?>;
            font-weight: normal;
        }

        .header-2 .navy ul ul li a:hover {
            color: <?php echo $active_text_color; ?>;
            font-weight: normal;
        }

        .header-2 .navy>ul>.active>a {
            color: <?php echo $active_text_color; ?>;
            font-weight: normal;
        }

        .header-2 .navy ul ul .active a {
            color: <?php echo $active_text_color; ?>;
            font-weight: normal;
        }






        .header-2 .navy2>ul>li>ul {
            font-weight: normal;
        }

        .header-2 .navy2>ul>li>a {
            font-weight: normal;
        }

        .header-2 .navy2 ul ul li a {
            font-weight: normal;
        }

        .header-2 .navy2>ul>li>a:hover {
            font-weight: normal;
        }

        .header-2 .navy2 ul ul li a:hover {
            font-weight: normal;
        }

        .header-2 .navy2>ul>.active>a {
            font-weight: normal;
        }

        .header-2 .navy2 ul ul .active a {
            font-weight: normal;
        }

        .headerstyle {
            font-weight: bold;
            font-family: 'chunkfiveroman', sans-serif;
            color: #173769 !important;
            font-size: 28px;
        }

        @font-face {
            font-family: 'chunkfiveroman';
            src: url('<?php echo base_url(); ?>assets/fonts/chunkfive-webfont.eot');
            src: url('<?php echo base_url(); ?>assets/fonts/chunkfive-webfont.eot?#iefix') format('embedded-opentype'),
                url('<?php echo base_url(); ?>assets/fonts/chunkfive-webfont.woff2') format('woff2'),
                url('<?php echo base_url(); ?>assets/fonts/chunkfive-webfont.woff') format('woff'),
                url('<?php echo base_url(); ?>assets/fonts/chunkfive-webfont.ttf') format('truetype'),
                url('<?php echo base_url(); ?>assets/fonts/chunkfive-webfont.svg#chunkfiveroman') format('svg');
            font-weight: normal;
            font-style: normal;

        }

        .real-estate .re-big-form {
            padding: 15px 0 0 0;
            <?php
            if (get_settings('banner_settings', 'show_bg_image', '0') == 1) {
            ?>background: <?php echo get_settings('banner_settings', 'search_panel_bg_color', '#222222'); ?> url(<?php echo base_url('uploads/banner/' . get_settings('banner_settings', 'search_bg', 'heading-back.jpg')); ?>);
            height: 380px;
            background-position: bottom center;
            <?php
            } else {
            ?>background: <?php echo get_settings('banner_settings', 'search_panel_bg_color', '#222222'); ?>;
            <?php
            }
            ?>
        }

        .desktopgrid {
            display: block;
        }

        #da-slider {
            min-height: 450px;
        }

        .mobilegrid {
            display: none;
        }


        .page-heading-two h1 {
            font-size: 24px !important;
        }


        .sharethis-inline-share-buttons {

            float: right;
        }


        @media (max-width: 767px) {


            .sharethis-inline-share-buttons {

                float: left;
            }



            .page-heading-two h1 {
                font-size: 18px !important;
            }

            #blogslider {
                height: 750px;

            }

            .desktopgrid {
                display: block;
            }

            .page-heading-two {
                margin-top: 30px;
                text-align: center;
            }

            #da-slider {
                min-height: 250px;
            }

            .mobilegrid {
                display: block;
            }

            .real-estate .re-big-form {
                background: none;
            }


            .banneradclass img {
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }

            .banneradclass {
                text-align: center !important;
            }


            #homeheadersearch {
                display: block !important;
                float: left !important;
                margin: 5px !important;
            }
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>slider/dist/gallery.prefixed.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>slider/dist/gallery.theme.css">
    <script type="text/javascript">
        var old_ie = 0;
    </script>
    <!--[if lte IE 8]> <script type="text/javascript">
        old_ie = 1;
    </script> < ![endif]-->

    <link rel="stylesheet" href="<?php echo base_url(); ?>sweetalert-master/dist/sweetalert.css">
















    <?php if (isset($_GET['itinerary'])) {


    ?>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=adsense"></script>-->
    <script type="text/javascript">
        // ROUTE PLANNER : GOOGLE MAPS CUSTOM JAVASCRIPT Ver. 3.0
        // WRITTEN BY : ZINCKSOFT.COM
        // EMAIL : INFO@ZINCKSOFT.COM
        // WRITTEN FOR : CODECANYON
        // DATED : 01/01/2016


        // NAMESPACE
        var _ZNRPL = {
            <?php
                // use the value in $uniqueid to pull from the db


                if (isset($_GET['itinerary'])) {
                    $itinerary = $_GET['itinerary'];

                    $servername = "localhost";
                    $username = "funnewjersey_database_new";
                    $password = "?VS#%!Wy-X7+";
                    $dbname = "funnewjersey_database_new";
                    // Create connection
                    $conn2 = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql2 = "SELECT n.listing_id, n.uid, n.itinerary_id as itinerary_id, n.id as nid, p.id as id, p.latitude as latitude, p.longitude as longitude, p.country as country, p.title as ptitle FROM dbc_itineraries as n LEFT JOIN dbc_posts as p ON p.id = n.listing_id WHERE n.itinerary_id = $itinerary LIMIT 1";
                    $result2 = $conn2->query($sql2);

                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {

                            $i = 1;
                            $i <= 10;
                            $i++; ?>
            latitude: <?php echo $row2['latitude']; ?>,
            longitude: <?php echo $row2['longitude']; ?>,
            <?php }
                    }
                } ?>
            start: "",
            end: "",
            getgeo: true,
            adsense: false,
            publisherid: "ca-google-maps_apidocs",
            adformat: "BANNER",
            adposition: "RIGHT_BOTTOM",
            adbackgroundColor: '#c4d4f3',
            adborderColor: '#173769',
            adtitleColor: '#173769',
            adtextColor: '#173769',
            adurlColor: '#173769',
            map: "",
            adUnit: "",
            directionsDisplay: "",
            directionsService: "",
            distance_unit: "MI",
            enable_pricing: true,
            unit_price: 0.14,
            currency_symbole: "$"
        };

        var intTextBox = 0;
        var waypoints = [];

        $(document).ready(function() {

            if (_ZNRPL.getgeo == true) {
                navigator.geolocation.getCurrentPosition(handle_geolocation_query);

                function handle_geolocation_query(position) {

                    _ZNRPL.latitude = position.coords.latitude;

                    _ZNRPL.longitude = position.coords.longitude;

                    _ZNRPL_Get_Address(_ZNRPL.latitude, _ZNRPL.longitude);

                }

            }

        });


        function _ZNRPL_Get_Address(lat, lng) {
            geocoder = new google.maps.Geocoder();

            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {

                        document.getElementById('start').value = results[0].formatted_address;


                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });

        }



        //FUNCTION TO ADD TEXT BOX ELEMENT
        function _ZNRPL_Add_Element() {


            <?php
                // use the value in $uniqueid to pull from the db


                if (isset($_GET['itinerary'])) {
                    $itinerary = $_GET['itinerary'];

                    $servername = "localhost";
                    $username = "funnewjersey_database_new";
                    $password = "?VS#%!Wy-X7+";
                    $dbname = "funnewjersey_database_new";

                    // Create connection
                    $conn2 = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql2 = "SELECT n.listing_id, n.uid, n.itinerary_id as itinerary_id, n.id as nid, p.id as id, p.latitude as latitude, p.longitude as longitude, p.country as country, p.title as ptitle FROM dbc_itineraries as n LEFT JOIN dbc_posts as p ON p.id = n.listing_id WHERE n.itinerary_id = $itinerary";
                    $result2 = $conn2->query($sql2);

                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {

                            $i = 1;
                            $i <= 10;
                            $i++; ?>
            intTextBox = intTextBox + 1;

            var contentID = document.getElementById('multiple-destination');
            var newTBDiv = document.createElement('div');
            newTBDiv.setAttribute(
                'id', 'strText' + intTextBox);

            newTBDiv.innerHTML =
                "<div style='margin-top:5px;margin-bottom:5px;'><div class='form-group'><label class='sr-only' for='start'>Next Location :</label><input type='text' class='form-control' id='start" +
                intTextBox +
                "' placeholder='<?php echo $row2['latitude']; ?>, <?php echo $row2['longitude']; ?>' value='<?php echo $row2['latitude']; ?>, <?php echo $row2['longitude']; ?>'></div><button type='button' class='btn btn-success' onClick='_ZNRPL_Add_Element();'style='margin-right:5px;margin-left:5px;'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button><button type='button' class='btn btn-danger' onClick='_ZNRPL_Remove_Element();'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></button><span style='margin-left:15px;'><strong><?php echo substr($row2['ptitle'], 7, -2); ?></strong></span></div>";
            contentID.appendChild(newTBDiv);
            <?php }
                    }
                } ?>

        }

        //FUNCTION TO REMOVE TEXT BOX ELEMENT
        function _ZNRPL_Remove_Element() {
            if (intTextBox != 0) {
                var contentID = document.getElementById('multiple-destination');
                contentID.removeChild(document.getElementById(

                    'strText' + intTextBox));
                intTextBox = intTextBox - 1;

            }

        }




        function _ZNRPL_Waypoints() {

            if (intTextBox != 0) {
                waypoints = [];
                var j = 1;
                for (var i = 0; i < intTextBox; i++) {
                    var address = document.getElementById('start' + j).value;
                    if (address !== "") {
                        waypoints.push({
                            location: address,
                            stopover: true
                        });
                    }

                    j++;
                }

            }

        }



        var rendererOptions = {
            draggable: true
        };
        _ZNRPL.directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);;
        directionsService = new google.maps.DirectionsService();


        function arp_initialize() {

            var centerpoint = new google.maps.LatLng(_ZNRPL.latitude, _ZNRPL.longitude);
            var mapOptions = {
                zoom: 7,
                center: centerpoint
            };


            _ZNRPL.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            _ZNRPL.directionsDisplay.setMap(_ZNRPL.map);
            _ZNRPL.directionsDisplay.setPanel(document.getElementById("directionsPanel"));

            //Traffic Layer Added
            var trafficLayer = new google.maps.TrafficLayer();

            // Setting a listener that will toggle the Traffic layer
            google.maps.event.addDomListener(document.getElementById("TrafficToggle"), 'click', function() {
                if (trafficLayer.getMap() != null) {
                    trafficLayer.setMap(null);
                } else {
                    trafficLayer.setMap(_ZNRPL.map);
                }
            });


            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            _ZNRPL.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);


            // Bias the SearchBox results towards current map's viewport.
            _ZNRPL.map.addListener('bounds_changed', function() {
                searchBox.setBounds(_ZNRPL.map.getBounds());
            });

            //Reset the inpout box on click
            input.addEventListener('click', function() {
                input.value = "";
            });


            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                infos = [];


                places.forEach(function(place) {
                    // prepare new Marker object
                    var mark = new google.maps.Marker({
                        position: place.geometry.location,
                        map: _ZNRPL.map,
                        title: place.name
                    });
                    markers.push(mark);

                    // prepare info window
                    var infowindow = new google.maps.InfoWindow({
                        content: '<font><b>' + place.name +
                            '</b><br />Rating: ' + place.rating + '<br />Vicinity: ' + place
                            .vicinity + '</font>'
                    });

                    // add event handler to current marker
                    google.maps.event.addListener(mark, 'click', function() {
                        clearInfos();
                        infowindow.open(_ZNRPL.map, mark);
                    });
                    infos.push(infowindow);

                });

            });

            google.maps.event.addListener(_ZNRPL.directionsDisplay, 'directions_changed', function() {
                computeTotalDistance(_ZNRPL.directionsDisplay.getDirections());
            });

            if (_ZNRPL.adsense == true) {
                var adUnitDiv = document.createElement('div');
                var adUnitOptions = {
                    format: google.maps.adsense.AdFormat[_ZNRPL.adformat],
                    position: google.maps.ControlPosition[_ZNRPL.adposition],
                    backgroundColor: _ZNRPL.adbackgroundColor,
                    borderColor: _ZNRPL.adborderColor,
                    titleColor: _ZNRPL.adtitleColor,
                    textColor: _ZNRPL.adtextColor,
                    urlColor: _ZNRPL.adurlColor,
                    publisherId: _ZNRPL.publisherid,
                    map: _ZNRPL.map,
                    visible: true
                };
                var adUnit = new google.maps.adsense.AdUnit(adUnitDiv, adUnitOptions);
            }


        }

        function calcRoute() {
            if (isEmpty(_ZNRPL.start)) {
                _ZNRPL.start = document.getElementById('start').value;
            }

            if (isEmpty(_ZNRPL.end)) {
                _ZNRPL.end = document.getElementById('end').value;
            }

            if (intTextBox != 0) {
                _ZNRPL_Waypoints();
            }

            if (_ZNRPL.distance_unit == "Miles") {
                var unitSystem = google.maps.UnitSystem.IMPERIAL;
            } else {
                var unitSystem = google.maps.UnitSystem.METRIC;
            }

            var selectedMode = document.getElementById('mode').value;

            var request = {
                origin: _ZNRPL.start,
                destination: _ZNRPL.end,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: google.maps.TravelMode[selectedMode],
                unitSystem: unitSystem
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    _ZNRPL.directionsDisplay.setDirections(response);
                }
            });

            GenrateShareLink();
        }

        google.maps.event.addDomListener(window, 'load', arp_initialize);

        google.maps.event.addDomListener(window, "resize", function() {
            var center = _ZNRPL.map.getCenter();
            google.maps.event.trigger(_ZNRPL.map, "resize");
            _ZNRPL.map.setCenter(center);
        });

        function computeTotalDistance(result) {
            var total = 0;
            var myroute = result.routes[0];
            for (var i = 0; i < myroute.legs.length; i++) {
                total += myroute.legs[i].distance.value;
            }
            if (_ZNRPL.distance_unit == "Miles") {
                total = total / 1000.0;
                total = Math.round(total * 0.621371);
            } else {
                total = Math.round(total / 1000.0);
            }

            document.getElementById('total').innerHTML = total + ' ' + _ZNRPL.distance_unit;


            if (_ZNRPL.enable_pricing == true) {

                var total_price = 0;

                total_price = total * _ZNRPL.unit_price;

                document.getElementById('trip_cost').innerHTML = '<strong>Total Distance : </strong>' + total + ' ' + _ZNRPL
                    .distance_unit + ' <br/>  ' + ' <strong>Total Cost :</strong> ' + _ZNRPL.currency_symbole + ' ' +
                    round_cost(total_price, 2) + '<br/>' + '<strong>Per ' + _ZNRPL.distance_unit + ' Cost : </strong>' +
                    _ZNRPL.currency_symbole + ' ' + _ZNRPL.unit_price;
            }

        }


        function round_cost(num, decimals) {
            var t = Math.pow(10, decimals);
            return (Math.round((num * t) + (decimals > 0 ? 1 : 0) * (Math.sign(num) * (10 / Math.pow(100, decimals)))) / t)
                .toFixed(decimals);
        }

        function GenrateShareLink() {

            _ZNRPL.start = document.getElementById('start').value;
            _ZNRPL.end = document.getElementById('end').value;

            var safestart = _ZNRPL.start.replace(" ", "+");

            var safeend = _ZNRPL.end.replace(" ", "+");

            var sharelink = "https://maps.google.com?saddr=" + safestart + "&daddr=" + safeend;

            document.getElementById('share').innerHTML = "<a href='" + sharelink +
                "' target='_blank' class='btn btn-success text-right'><i class='glyphicon glyphicon-link'></i></a>";


        }

        function isEmpty(str) {
            return (!str || 0 === str.length);

        }


        // Places code here
        var markers = Array();
        var infos = Array();

        function findPlaces() {

            var type = document.getElementById('pac-input').value;
            var radius = distance(_ZNRPL.map.getBounds().getNorthEast().lat(), _ZNRPL.map.getBounds().getNorthEast().lng(),
                _ZNRPL.map.getBounds().getSouthWest().lat(), _ZNRPL.map.getBounds().getSouthWest().lng());;
            var keyword = '';
            var ctr = _ZNRPL.map.getCenter();
            var cur_location = new google.maps.LatLng(ctr.lat(), ctr.lng());

            // prepare request to Places
            var request = {
                location: cur_location,
                radius: radius,
                types: [type]
            };
            if (keyword) {
                request.keyword = [keyword];
            }

            // send request
            service = new google.maps.places.PlacesService(_ZNRPL.map);
            service.nearbySearch(request, createMarkers);
        }



        // create markers (from 'findPlaces' function)
        function createMarkers(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {

                // if we have found something - clear map (overlays)
                clearOverlays();

                // and create new markers by search result
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            } else if (status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                alert('Sorry, nothing is found');
            }
        }


        // clear overlays function
        function clearOverlays() {
            if (markers) {
                for (i in markers) {
                    markers[i].setMap(null);
                }
                markers = [];
                infos = [];
            }
        }

        // clear infos function
        function clearInfos() {
            if (infos) {
                for (i in infos) {
                    if (infos[i].getMap()) {
                        infos[i].close();
                    }
                }
            }
        }


        // creare single marker function
        function createMarker(obj) {

            // prepare new Marker object
            var mark = new google.maps.Marker({
                position: obj.geometry.location,
                map: _ZNRPL.map,
                title: obj.name
            });
            markers.push(mark);

            // prepare info window
            var infowindow = new google.maps.InfoWindow({
                content: '<font><b>' + obj.name +
                    '</b><br />Rating: ' + obj.rating + '<br />Vicinity: ' + obj.vicinity + '</font>'
            });

            // add event handler to current marker
            google.maps.event.addListener(mark, 'click', function() {
                clearInfos();
                infowindow.open(_ZNRPL.map, mark);
            });
            infos.push(infowindow);
        }

        // Calcuate Distance
        function distance(lat1, lon1, lat2, lon2) {
            var R = 6371; // km (change this constant to get miles)
            var dLat = (lat2 - lat1) * Math.PI / 180;
            var dLon = (lon2 - lon1) * Math.PI / 180;
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            if (d > 1) {
                return Math.round(d) * 1000;
            } else if (d <= 1) {
                return Math.round(d * 1000);
            } else {
                return d;
            }
        }
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">












    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=adsense"></script>-->
    <script type="text/javascript">
        // ROUTE PLANNER : GOOGLE MAPS CUSTOM JAVASCRIPT Ver. 3.0
        // WRITTEN BY : ZINCKSOFT.COM
        // EMAIL : INFO@ZINCKSOFT.COM
        // WRITTEN FOR : CODECANYON
        // DATED : 01/01/2016


        // NAMESPACE
        var _ZNRPL = {
            <?php
                // use the value in $uniqueid to pull from the db


                if (isset($_GET['itinerary'])) {
                    $itinerary = $_GET['itinerary'];

                    $servername = "localhost";
                    $username = "funnewjersey_database_new";
                    $password = "?VS#%!Wy-X7+";
                    $dbname = "funnewjersey_database_new";
                    // Create connection
                    $conn2 = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql2 = "SELECT n.listing_id, n.uid, n.itinerary_id as itinerary_id, n.id as nid, p.id as id, p.latitude as latitude, p.longitude as longitude, p.country as country, p.title as ptitle FROM dbc_itineraries as n LEFT JOIN dbc_posts as p ON p.id = n.listing_id WHERE n.itinerary_id = $itinerary LIMIT 1";
                    $result2 = $conn2->query($sql2);

                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {

                            $i = 1;
                            $i <= 10;
                            $i++; ?>
            latitude: <?php echo $row2['latitude']; ?>,
            longitude: <?php echo $row2['longitude']; ?>,
            <?php }
                    }
                } ?>
            start: "",
            end: "",
            getgeo: true,
            adsense: false,
            publisherid: "ca-google-maps_apidocs",
            adformat: "BANNER",
            adposition: "RIGHT_BOTTOM",
            adbackgroundColor: '#c4d4f3',
            adborderColor: '#173769',
            adtitleColor: '#173769',
            adtextColor: '#173769',
            adurlColor: '#173769',
            map: "",
            adUnit: "",
            directionsDisplay: "",
            directionsService: "",
            distance_unit: "MI",
            enable_pricing: true,
            unit_price: 0.14,
            currency_symbole: "$"
        };

        var intTextBox = 0;
        var waypoints = [];

        $(document).ready(function() {

            if (_ZNRPL.getgeo == true) {
                navigator.geolocation.getCurrentPosition(handle_geolocation_query);

                function handle_geolocation_query(position) {

                    _ZNRPL.latitude = position.coords.latitude;

                    _ZNRPL.longitude = position.coords.longitude;

                    _ZNRPL_Get_Address(_ZNRPL.latitude, _ZNRPL.longitude);

                }

            }

        });


        function _ZNRPL_Get_Address(lat, lng) {
            geocoder = new google.maps.Geocoder();

            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {

                        document.getElementById('start').value = results[0].formatted_address;


                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });

        }



        //FUNCTION TO ADD TEXT BOX ELEMENT
        function _ZNRPL_Add_Element() {


            <?php
                // use the value in $uniqueid to pull from the db


                if (isset($_GET['itinerary'])) {
                    $itinerary = $_GET['itinerary'];

                    $servername = "localhost";
                    $username = "funnewjersey_database_new";
                    $password = "?VS#%!Wy-X7+";
                    $dbname = "funnewjersey_database_new";

                    // Create connection
                    $conn2 = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql2 = "SELECT n.listing_id, n.uid, n.itinerary_id as itinerary_id, n.id as nid, p.id as id, p.latitude as latitude, p.longitude as longitude, p.country as country, p.title as ptitle FROM dbc_itineraries as n LEFT JOIN dbc_posts as p ON p.id = n.listing_id WHERE n.itinerary_id = $itinerary";
                    $result2 = $conn2->query($sql2);

                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {

                            $i = 1;
                            $i <= 10;
                            $i++; ?>
            intTextBox = intTextBox + 1;

            var contentID = document.getElementById('multiple-destination');
            var newTBDiv = document.createElement('div');
            newTBDiv.setAttribute(
                'id', 'strText' + intTextBox);

            newTBDiv.innerHTML =
                "<div style='margin-top:5px;margin-bottom:5px;'><div class='form-group'><label class='sr-only' for='start'>Next Location :</label><input type='text' class='form-control' id='start" +
                intTextBox +
                "' placeholder='<?php echo $row2['latitude']; ?>, <?php echo $row2['longitude']; ?>' value='<?php echo $row2['latitude']; ?>, <?php echo $row2['longitude']; ?>'></div><button type='button' class='btn btn-success' onClick='_ZNRPL_Add_Element();'style='margin-right:5px;margin-left:5px;'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button><button type='button' class='btn btn-danger' onClick='_ZNRPL_Remove_Element();'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></button><span style='margin-left:15px;'><strong><?php echo substr($row2['ptitle'], 7, -2); ?></strong></span></div>";
            contentID.appendChild(newTBDiv);
            <?php }
                    }
                } ?>

        }

        //FUNCTION TO REMOVE TEXT BOX ELEMENT
        function _ZNRPL_Remove_Element() {
            if (intTextBox != 0) {
                var contentID = document.getElementById('multiple-destination');
                contentID.removeChild(document.getElementById(

                    'strText' + intTextBox));
                intTextBox = intTextBox - 1;

            }

        }




        function _ZNRPL_Waypoints() {

            if (intTextBox != 0) {
                waypoints = [];
                var j = 1;
                for (var i = 0; i < intTextBox; i++) {
                    var address = document.getElementById('start' + j).value;
                    if (address !== "") {
                        waypoints.push({
                            location: address,
                            stopover: true
                        });
                    }

                    j++;
                }

            }

        }



        var rendererOptions = {
            draggable: true
        };
        _ZNRPL.directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);;
        directionsService = new google.maps.DirectionsService();


        function arp_initialize() {

            var centerpoint = new google.maps.LatLng(_ZNRPL.latitude, _ZNRPL.longitude);
            var mapOptions = {
                zoom: 7,
                center: centerpoint
            };


            _ZNRPL.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            _ZNRPL.directionsDisplay.setMap(_ZNRPL.map);
            _ZNRPL.directionsDisplay.setPanel(document.getElementById("directionsPanel"));

            //Traffic Layer Added
            var trafficLayer = new google.maps.TrafficLayer();

            // Setting a listener that will toggle the Traffic layer
            google.maps.event.addDomListener(document.getElementById("TrafficToggle"), 'click', function() {
                if (trafficLayer.getMap() != null) {
                    trafficLayer.setMap(null);
                } else {
                    trafficLayer.setMap(_ZNRPL.map);
                }
            });


            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            _ZNRPL.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);


            // Bias the SearchBox results towards current map's viewport.
            _ZNRPL.map.addListener('bounds_changed', function() {
                searchBox.setBounds(_ZNRPL.map.getBounds());
            });

            //Reset the inpout box on click
            input.addEventListener('click', function() {
                input.value = "";
            });


            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                infos = [];


                places.forEach(function(place) {
                    // prepare new Marker object
                    var mark = new google.maps.Marker({
                        position: place.geometry.location,
                        map: _ZNRPL.map,
                        title: place.name
                    });
                    markers.push(mark);

                    // prepare info window
                    var infowindow = new google.maps.InfoWindow({
                        content: '<font><b>' + place.name +
                            '</b><br />Rating: ' + place.rating + '<br />Vicinity: ' + place
                            .vicinity + '</font>'
                    });

                    // add event handler to current marker
                    google.maps.event.addListener(mark, 'click', function() {
                        clearInfos();
                        infowindow.open(_ZNRPL.map, mark);
                    });
                    infos.push(infowindow);

                });

            });

            google.maps.event.addListener(_ZNRPL.directionsDisplay, 'directions_changed', function() {
                computeTotalDistance(_ZNRPL.directionsDisplay.getDirections());
            });

            if (_ZNRPL.adsense == true) {
                var adUnitDiv = document.createElement('div');
                var adUnitOptions = {
                    format: google.maps.adsense.AdFormat[_ZNRPL.adformat],
                    position: google.maps.ControlPosition[_ZNRPL.adposition],
                    backgroundColor: _ZNRPL.adbackgroundColor,
                    borderColor: _ZNRPL.adborderColor,
                    titleColor: _ZNRPL.adtitleColor,
                    textColor: _ZNRPL.adtextColor,
                    urlColor: _ZNRPL.adurlColor,
                    publisherId: _ZNRPL.publisherid,
                    map: _ZNRPL.map,
                    visible: true
                };
                var adUnit = new google.maps.adsense.AdUnit(adUnitDiv, adUnitOptions);
            }


        }

        function calcRoute() {
            if (isEmpty(_ZNRPL.start)) {
                _ZNRPL.start = document.getElementById('start').value;
            }

            if (isEmpty(_ZNRPL.end)) {
                _ZNRPL.end = document.getElementById('end').value;
            }

            if (intTextBox != 0) {
                _ZNRPL_Waypoints();
            }

            if (_ZNRPL.distance_unit == "Miles") {
                var unitSystem = google.maps.UnitSystem.IMPERIAL;
            } else {
                var unitSystem = google.maps.UnitSystem.METRIC;
            }

            var selectedMode = document.getElementById('mode').value;

            var request = {
                origin: _ZNRPL.start,
                destination: _ZNRPL.end,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: google.maps.TravelMode[selectedMode],
                unitSystem: unitSystem
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    _ZNRPL.directionsDisplay.setDirections(response);
                }
            });

            GenrateShareLink();
        }

        google.maps.event.addDomListener(window, 'load', arp_initialize);

        google.maps.event.addDomListener(window, "resize", function() {
            var center = _ZNRPL.map.getCenter();
            google.maps.event.trigger(_ZNRPL.map, "resize");
            _ZNRPL.map.setCenter(center);
        });

        function computeTotalDistance(result) {
            var total = 0;
            var myroute = result.routes[0];
            for (var i = 0; i < myroute.legs.length; i++) {
                total += myroute.legs[i].distance.value;
            }
            if (_ZNRPL.distance_unit == "Miles") {
                total = total / 1000.0;
                total = Math.round(total * 0.621371);
            } else {
                total = Math.round(total / 1000.0);
            }

            document.getElementById('total').innerHTML = total + ' ' + _ZNRPL.distance_unit;


            if (_ZNRPL.enable_pricing == true) {

                var total_price = 0;

                total_price = total * _ZNRPL.unit_price;

                document.getElementById('trip_cost').innerHTML = '<strong>Total Distance : </strong>' + total + ' ' + _ZNRPL
                    .distance_unit + ' <br/>  ' + ' <strong>Total Cost :</strong> ' + _ZNRPL.currency_symbole + ' ' +
                    round_cost(total_price, 2) + '<br/>' + '<strong>Per ' + _ZNRPL.distance_unit + ' Cost : </strong>' +
                    _ZNRPL.currency_symbole + ' ' + _ZNRPL.unit_price;
            }

        }


        function round_cost(num, decimals) {
            var t = Math.pow(10, decimals);
            return (Math.round((num * t) + (decimals > 0 ? 1 : 0) * (Math.sign(num) * (10 / Math.pow(100, decimals)))) / t)
                .toFixed(decimals);
        }

        function GenrateShareLink() {

            _ZNRPL.start = document.getElementById('start').value;
            _ZNRPL.end = document.getElementById('end').value;

            var safestart = _ZNRPL.start.replace(" ", "+");

            var safeend = _ZNRPL.end.replace(" ", "+");

            var sharelink = "https://maps.google.com?saddr=" + safestart + "&daddr=" + safeend;

            document.getElementById('share').innerHTML = "<a href='" + sharelink +
                "' target='_blank' class='btn btn-success text-right'><i class='glyphicon glyphicon-link'></i></a>";


        }

        function isEmpty(str) {
            return (!str || 0 === str.length);

        }


        // Places code here
        var markers = Array();
        var infos = Array();

        function findPlaces() {

            var type = document.getElementById('pac-input').value;
            var radius = distance(_ZNRPL.map.getBounds().getNorthEast().lat(), _ZNRPL.map.getBounds().getNorthEast().lng(),
                _ZNRPL.map.getBounds().getSouthWest().lat(), _ZNRPL.map.getBounds().getSouthWest().lng());;
            var keyword = '';
            var ctr = _ZNRPL.map.getCenter();
            var cur_location = new google.maps.LatLng(ctr.lat(), ctr.lng());

            // prepare request to Places
            var request = {
                location: cur_location,
                radius: radius,
                types: [type]
            };
            if (keyword) {
                request.keyword = [keyword];
            }

            // send request
            service = new google.maps.places.PlacesService(_ZNRPL.map);
            service.nearbySearch(request, createMarkers);
        }



        // create markers (from 'findPlaces' function)
        function createMarkers(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {

                // if we have found something - clear map (overlays)
                clearOverlays();

                // and create new markers by search result
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            } else if (status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                alert('Sorry, nothing is found');
            }
        }


        // clear overlays function
        function clearOverlays() {
            if (markers) {
                for (i in markers) {
                    markers[i].setMap(null);
                }
                markers = [];
                infos = [];
            }
        }

        // clear infos function
        function clearInfos() {
            if (infos) {
                for (i in infos) {
                    if (infos[i].getMap()) {
                        infos[i].close();
                    }
                }
            }
        }


        // creare single marker function
        function createMarker(obj) {

            // prepare new Marker object
            var mark = new google.maps.Marker({
                position: obj.geometry.location,
                map: _ZNRPL.map,
                title: obj.name
            });
            markers.push(mark);

            // prepare info window
            var infowindow = new google.maps.InfoWindow({
                content: '<font><b>' + obj.name +
                    '</b><br />Rating: ' + obj.rating + '<br />Vicinity: ' + obj.vicinity + '</font>'
            });

            // add event handler to current marker
            google.maps.event.addListener(mark, 'click', function() {
                clearInfos();
                infowindow.open(_ZNRPL.map, mark);
            });
            infos.push(infowindow);
        }

        // Calcuate Distance
        function distance(lat1, lon1, lat2, lon2) {
            var R = 6371; // km (change this constant to get miles)
            var dLat = (lat2 - lat1) * Math.PI / 180;
            var dLon = (lon2 - lon1) * Math.PI / 180;
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            if (d > 1) {
                return Math.round(d) * 1000;
            } else if (d <= 1) {
                return Math.round(d * 1000);
            } else {
                return d;
            }
        }
    </script>
    <script>
        var pm_tag = 's3c';
        var pm_pid = "23751-12f1f0fc";
    </script>
    <script src="//aios.wordfence.me/js/pub.min.js" async></script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #section-to-print,
            #section-to-print * {
                visibility: visible;
            }

            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>


    <?php } ?>

    <?php if (isset($post)) { ?>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.46.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.46.0/mapbox-gl.css' rel='stylesheet' />

    <style>
        .mapboxgl-popup {
            max-width: 200px;
        }

        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
        }

        .chart {
            min-width: 320px;
            max-width: 800px;
            height: 220px;
            margin: 0 auto;
        }
    </style>
    <?php } ?>







    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5e2b72b279d09a0012e27cb4&product=inline-share-buttons&cms=website'
        async='async'></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        .navbar-nav>li>.dropdown-menu {

            border-top-left-radius: 4px;
            border-top-right-radius: 4px;

            font-family: 'Open Sans', sans-serif;


        }

        .navbar-default .navbar-nav>li>a {
            width: 200px;
            font-weight: bold;
        }

        .mega-dropdown {
            position: static !important;
            width: 100%;
        }

        .mega-dropdown-menu {
            padding: 20px 0px;
            width: 100%;
            box-shadow: none;
            -webkit-box-shadow: none;
        }

        .mega-dropdown-menu:before {
            content: "";
            border-bottom: 15px solid #fff;
            border-right: 17px solid transparent;
            border-left: 17px solid transparent;
            position: absolute;
            top: -15px;
            left: 150px;
            z-index: 10;
        }

        .mega-dropdown-menu:after {
            content: "";
            border-bottom: 17px solid #ccc;
            border-right: 19px solid transparent;
            border-left: 19px solid transparent;
            position: absolute;
            top: -17px;
            left: 148px;
            z-index: 8;
        }

        .mega-dropdown-menu>li>ul {
            padding: 0;
            margin: 0;
        }

        .mega-dropdown-menu>li>ul>li {
            list-style: none;
        }

        .mega-dropdown-menu>li>ul>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.428571429;
            color: #999;
            white-space: normal;
        }

        .mega-dropdown-menu>li ul>li>a:hover,
        .mega-dropdown-menu>li ul>li>a:focus {
            text-decoration: none;
            color: #444;
            background-color: #f5f5f5;
        }

        .mega-dropdown-menu .dropdown-header {
            color: #428bca;
            font-size: 18px;
            font-weight: bold;
        }

        .mega-dropdown-menu form {
            margin: 3px 20px;
        }

        .mega-dropdown-menu .form-group {
            margin-bottom: 3px;
        }
    </style>




    <?php
    if (isset($category_id)) {
        echo stripslashes(get_category_headcode_by_id($category_id));
    }
    
    ?>









</head>



<?php
$CI = get_instance();
$curr_lang = get_current_lang();
if ($curr_lang == 'ar' || $curr_lang == 'fa' || $curr_lang == 'he' || $curr_lang == 'ur') {
?>
<link rel="stylesheet" href="<?php echo theme_url(); ?>/assets/css/rtl-fix.css">

<body class="home" dir="rtl">
    <?php
} else {
    ?>

    <body class="home" dir="<?php echo get_settings('site_settings', 'site_direction', 'ltr'); ?>" <?php if (isset($_GET['itinerary'])) {


                                                                                                        ?>onLoad='_ZNRPL_Add_Element();'
        <?php } ?>>
        <?php
    }
        ?>



        <!-- Outer Starts -->
        <div class="outer">
            <?php require_once 'header.php'; ?>

            <?php
            if ($alias == 'home') {
                if (constant('ENVIRONMENT') == 'demo') {
                    $banner_type = isset($banner_type) ? $banner_type : get_settings('banner_settings', 'banner_type', 'Layer Slider');
                } else {
                    $banner_type = get_settings('banner_settings', 'banner_type', 'Layer Slider');
                }
            
                if ($banner_type == 'Parallax Slider') {
                    require_once 'slider_view.php';
                } elseif ($banner_type == 'Layer Slider') {
                    require_once 'layer_slider.php';
                } else {
                    require_once 'map_view.php';
                }
            }
            ?>
            <!-- Main content starts -->
            <div class="main-block">
                <?php echo isset($content) ? $content : ''; ?>
            </div>

            <!-- Main content ends -->
            <?php require_once 'footer.php'; ?>


        </div>
        <?php require_once 'includes_bottom.php'; ?>
        <script src="<?php echo base_url(); ?>sweetalert-master/dist/sweetalert.min.js"></script>



        <!-- For Travis CI -->



        <?php
        if (isset($_COOKIE["loggedin"])) {
        ?>
        <script src="https://code.jquery.com/qunit/qunit-1.18.0.js"></script>

        <script src="<?php echo base_url(); ?>sweetalert-master/test/tests.js"></script>
        <?php } ?>
        <script>
            function SetCookie(c_name, value, expiredays) {
                var exdate = new Date()
                exdate.setDate(exdate.getDate() + (4 * 1000))
                document.cookie = c_name + "=" + escape(value) +
                    ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
            }
        </script>
        <?php
        if (isset($_COOKIE["saveevent"])) {
        ?>


        <script src="<?php echo base_url(); ?>sweetalert-master/test/tests2.js"></script>
        <?php } ?>
        <script type="text/javascript">
            window.ss360Config = {
                siteId: "www.funnewjersey.com_2",
                searchBox: {
                    selector: "#searchBox"
                }
            }
            var e = document.createElement("script");
            e.type = "text/javascript";
            e.async = !0;
            e.src = "https://cdn.sitesearch360.com/v13/sitesearch360-v13.min.js";
            document.getElementsByTagName("body")[0].appendChild(e);
        </script>
    </body>

</html>
