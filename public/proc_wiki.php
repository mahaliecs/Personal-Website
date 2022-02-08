<!-- wiki core functions -->

<!DOCTYPE html>

<html>

    <head> </head>

    <body>
        <?php
            
            function proc_header($data) {
                if (preg_match("/^={6}|={6}$/",$data)) {
                    $h_text = preg_split("/^={6}|={6}$/", $data)[1];
                    echo "<h6>". $h_text ."</h6>\n";
                }
                else if (preg_match("/^={5}|={5}$/",$data)) {
                    $h_text = preg_split("/^={5}|={5}$/", $data)[1];
                    echo "<h5>". $h_text ."</h5>\n";
                }
                else if (preg_match("/^={4}|={4}$/",$data)) {
                    $h_text = preg_split("/^={4}|={4}$/", $data)[1];
                    echo "<h4>". $h_text ."</h4>\n";
                }
                else if (preg_match("/^={3}|={3}$/",$data)) {
                    $h_text = preg_split("/^={3}|={3}$/", $data)[1];
                    echo "<h3>". $h_text ."</h3>\n";
                }
                else if (preg_match("/^={2}|={2}$/",$data)) {
                    $h_text = preg_split("/^={2}|={2}$/", $data)[1];
                    echo "<h2>". $h_text ."</h2>\n";
                }
                else if (preg_match("/^={1}|={1}$/",$data)) {
                    $h_text = preg_split("/^={1}|={1}$/", $data)[1];
                    echo "<h1>".$h_text."</h1>\n";
                }
            }

            function proc_indent($data) {
                if (preg_match("/^:{2}/", $data)) {
                    $indent_text = ltrim($data, "::");
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$indent_text."<br>"; 
                }
                else if (preg_match("/^:{1}/", $data)) {
                    $indent_text = ltrim($data, ":");
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;".$indent_text."<br>";
                }
            }

            function proc_unordered_lists($data, $pos_val,$symbol) {
                if ($pos_val == 1) {
                    $ul_text = ltrim($data, $symbol);
                    echo "<ul>\n";
                    echo "<li>".$ul_text."</li>\n";
                }
                else if ($pos_val == 2) {
                    $ul_text = ltrim($data, $symbol);
                    echo "<li>".$ul_text."</li>\n";
                }
                else if ($pos_val == 3) {
                    $ul_text = ltrim($data, $symbol);
                    echo "</ul>\n";
                    echo "<li>".$ul_text."</li>\n";
                }
            }

            function proc_ordered_lists($data,$pos_val,$symbol) {
                if ($pos_val == 1) {
                    $ol_text = ltrim($data, $symbol);
                    echo "<ol>\n";
                    echo "<li>".$ol_text."</li>\n";
                }
                else if ($pos_val == 2) {
                    $ol_text = ltrim($data, $symbol);
                    echo "<li>".$ol_text."</li>\n";
                }
                else if ($pos_val == 3) {
                    $ol_text = ltrim($data, $symbol);
                    echo "</ol>\n";
                    echo "<li>".$ol_text."</li>\n";
                }
            }

            function proc_italics_bold($data) {
                if (preg_match_all("/'/", $data) == 4) {
                    $text_list = preg_split("/'{2}/", $data);
                    $italic_text = $text_list[1];
                    for ($i=0;$i<count($text_list);++$i) {
                        if ($text_list[$i] == $italic_text) {
                            echo "<i>". $italic_text ."</i>\n";
                        }
                        else {
                            echo $text_list[$i];
                        }
                    }
                }
                else if (preg_match_all("/'/", $data) == 6) {
                    $text_list = preg_split("/'{3}/", $data);
                    $bold_text = $text_list[1];
                    for ($i=0;$i<count($text_list);++$i) {
                        if ($text_list[$i] == $bold_text) {
                            echo "<b>". $bold_text ."</b>\n";
                        }
                        else {
                            echo $text_list[$i];
                        }
                    }
                }
                else if (preg_match_all("/'/", $data)) {
                    $text_list = preg_split("/'{5}/", $data);
                    $bi_text = $text_list[1];
                    for ($i=0;$i<count($text_list);++$i) {
                        if ($text_list[$i] == $bi_text) {
                            echo "<b> <i>". $bi_text ."</i> </b>\n";
                        }
                        else {
                            echo $text_list[$i];
                        }
                    }
                }
            }

            function proc_images($data) {
                if (preg_match("/\[{2}/", $data) and preg_match("/\]{2}/", $data)) {
                    $img_text = preg_split("/^\[{2}|\]{2}$|:|\||=/", $data);
                    $source_url = $img_text[2];
                    if ($img_text[3] == "px") {
                        $img_size = $img_text[4];
                    }
                    else if ($img_text[4] == "px") {
                        $img_size = preg_split("/\||[px]/",$data)[2];
                    }
                    echo "<img src=\"".$source_url."\" height=\"".$img_size."\">\n";
                }
            }

            function proc_links($data) {
                if (preg_match("/^http/", $data)) {
                    echo "<a href=\"".$data."\">".$data."</a>\n\n";
                }
                else if (preg_match("/^\[/", $data) and preg_match("/\]$/", $data)) {
                    $link_text = preg_split("/^\[|\s+|\]$/",$data);
                    $link_url = $link_text[1];
                    $link_title = "";
                    for ($i = 2;$i<count($link_text);++$i) {
                        $link_title = $link_title.$link_text[$i]." ";
                    }
                    echo "<a href=\"".$link_url."\">".$link_title."</a>\n";
                }
            }

            function place_tag($data, $prev_data, $symbol) {
                # if beginning - symbol in data but not prev_data, set place_in_lines=1
                $pattern = "/^".$symbol."[^".$symbol."]+/";
                if (preg_match($pattern, $data) and !preg_match($pattern, $prev_data)) {
                    if (preg_match("/^".$symbol."{2}[^".$symbol."]+/", $prev_data)) {
                        $place_in_lines = 3;
                    }
                    else {
                        $place_in_lines = 1;
                    }
                }
                # if middle - symbol in data & prev_data, set place_in_lines=2
                else if (preg_match($pattern, $data) and preg_match($pattern, $prev_data)) {
                    $place_in_lines = 2;
                }
                # if end - symbol in prev_data but not data, set place_in_lines=3
                else if (!preg_match($pattern, $data) and preg_match($pattern, $prev_data)) {
                    $place_in_lines = 3;
                }
                return $place_in_lines;
            }

            # function definition: use the exact interface in your code.
            function proc_wikitext ($filename) {
                
                $handle = fopen($filename,"r") or die("Cannot open " . $filename);
                while ($data = fgets($handle)) {

                    # process headers - output html h1-h6
                    if (preg_match("/^=|=$/",$data)) {
                        proc_header($data);
                    }

                    #horizontal rule
                    if ($data == "----\n") {
                        echo "<hr>\n";
                    }

                    #line breaks & paragraphs
                    if (preg_match("/^\w/", $data) and preg_match("/^\s/", $prev_data) and !preg_match("/[\[\]'']/",$data)) {
                        echo "<p>".$data;
                    }
                    else if (preg_match("/^\w/", $data) and preg_match("/^\w/", $prev_data)) {
                        echo $data;
                    }
                    else if (preg_match("/^\s/", $data) and preg_match("/^\w/", $prev_data)) {
                        echo "</p>";
                    }

                    #indent (only first 2 levels)
                    if (preg_match("/^:/",$data)) {
                        proc_indent($data);
                    }
                    
                    #unordered lists (only first 2 levels)
                    
                    if (preg_match("/^[^\*]/",$data) and preg_match("/^\*[^\*]+/",$prev_data)) {
                        echo "</ul>\n";
                    }
                    else if ((preg_match("/^\*[^\*]+/",$data) | preg_match("/^\*[^\*]+/",$prev_data)) and !preg_match("/^\*{2}[^\*]+/",$data)) {
                        $place_in_ol = place_tag($data, $prev_data, "\*");
                        proc_unordered_lists($data, $place_in_ol, "* ");
                    }
                    else if (preg_match("/^\*{2}[^\*]+/",$data) | preg_match("/^\*{2}[^\*]+/",$prev_data)) {
                        $place_in_ol = place_tag($data,$prev_data, "\*{2}");
                        proc_unordered_lists($data, $place_in_ol, "** ");
                    }

                    #ordered lists (only first 2 levels)
                    if (preg_match("/^[^#]/",$data) and preg_match("/^#[^#]+/",$prev_data)) {
                        echo "</ol>\n";
                    }
                    else if ((preg_match("/^#[^#]+/",$data) | preg_match("/^#[^#]+/",$prev_data)) and !preg_match("/^#{2}[^#]+/",$data)) {
                        $place_in_ol = place_tag($data, $prev_data, "#");
                        proc_ordered_lists($data, $place_in_ol, "# ");
                    }
                    else if (preg_match("/^#{2}[^#]+/",$data) | preg_match("/^#{2}[^#]+/",$prev_data)) {
                        $place_in_ol = place_tag($data,$prev_data, "#{2}");
                        proc_ordered_lists($data, $place_in_ol, "## ");
                    }


                    #italics & bold
                    if (preg_match("/'{2}/",$data)) {
                        proc_italics_bold($data);
                    }

                    #links
                    if (preg_match("/^http|^\[http/", $data)) {
                        proc_links($data);
                    }

                    #images
                    if (preg_match("/\[{2}/", $data) and preg_match("/\]{2}/", $data)) {
                        proc_images($data);
                    }

                    $prev_data = $data;

                }
            }
        ?>
    </body>

</html>