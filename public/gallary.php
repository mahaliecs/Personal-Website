<!DOCTYPE html>

<html>

    <head> 
        <title> Hallie's Website </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"><link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">

    </head>

    <style>
        .navbar {
            background-color: rgb(89, 114, 161);
            font-family: 'Space Mono', monospace;
        }
        .navbar ul {
            list-style-type: none;
            float: right;
            display: inline-block;
        }
        .navbar li {
            float: right;
            padding-top: 1em;
        }
        .navbar a {
            color: white;
            text-align: center;
            padding: 1em 1em;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: white;
            color: rgb(89, 114, 161);
        }
        .list {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            max-width: 100%;
            height: auto;
            padding-left: 1em;
            padding-right: 1em;
            padding-top: 1em;
            padding-bottom: 1em;
        }
        .matrix {
            display: block;
            margin-left: auto;
            margin-right: auto;
            max-width: 100%;
            object-fit: cover;
            padding-left: 1em;
            padding-right: 1em;
            padding-top: 1em;
            padding-bottom: 1em;
        }
        .matrix {
            margin: 5px;
            float: left;
        }
        .details {
            border-collapse: collapse;
            border: 1px solid rgb(89, 114, 161);
            width: 85%;
            font-size: 0.9em;
        }
        .details th {
            background-color: rgb(89, 114, 161);
            color: white;
            border-collapse: collapse;
            border: 1px solid rgb(89, 114, 161);
        }
        .details td {
            border-collapse: collapse;
            border: 1px solid rgb(89, 114, 161);
        }
        body {
            font-family: 'Space Mono', monospace;
        }
    </style>

    <header>
        <nav class="navbar">
            <ul>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="gallary.php">Gallary</a></li>
                <li><a href="csv_test.php">CSV</a></li>
                <li><a href="wiki_test.php">Wikitext</a></li>
                <li><a class="active" href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <body>
        <br> <br>  
        <form action="gallary.php" method="get">
            <label for="view">choose a layout: </label>
            <select id="view" name="view">
                <option value="list">List</option>
                <option value="matrix">Matrix</option>
                <option value="details">Details</option>
            </select>
            <br>
            <label for="sort">sort by: </label>
            <select id="sort" name="sort">
                <option value="orig">Original</option>
                <option value="date_newest">Newest-Oldest</option>
                <option value="date_oldest">Oldest-Newest</option>
                <option value="size_largest">Largest-Smallest</option>
                <option value="size_smallest">Smallest-Largest</option>
                <option value="rand">Random</option>
            </select>
            <input type="submit"> 
        </form>
    
        <br> <br>
        <!-- figure tag -->
        <?php
            # $mode == "list" : list of large images view
            function list_view($images_list) {
                for ($i=0;$i<count($images_list);++$i) {
                    echo "<img class=\"list\" src=".$images_list[$i]." width=500px> <br> <br> \n";
                }   
            } 

            # $mode == "matrix" : image matrix view (3 columns)
            function matrix_view($images_list) {
                for ($i=0;$i<count($images_list);++$i) {
                    if ($i % 3 == 0 && $i != 0) {
                        echo "<br> <br> <br> <br> <br> <br> <br> <br> <br>";
                    }

                    echo "<img class=\"matrix\" src=".$images_list[$i]." width=200px height=200px>\n";
                }
            }

            # $mode == "details" : file details view (text)
            function details_view($images_list, $images_info) {
                echo "<table class=\"details\">\n";

                echo "<tr>\n";

                echo "<th> filename </th>\n";
                echo "<th> file description </th>\n";
                echo "<th> file size </th>\n";
                echo "<th> file date </th>\n";

                echo "</tr>\n";

                for ($i=0;$i<count($images_list);++$i) {
                    echo "<tr>\n";

                    echo "<td>".$images_list[$i]."</td>\n";
                    echo "<td>".$images_info[$i]."</td>\n";
                    echo "<td>".round(filesize($images_list[$i])/1024)." KB</td>\n";
                    echo "<td>".date("F d Y ", filemtime($images_list[$i]))."</td>\n";

                    echo "<tr>\n";
                }

                echo "</table>\n";  
            }

            function comp_dates($images_list, $img_dates) {
                for ($i=0;$i<count($img_dates);++$i) {
                    $j = 0;

                    # compare image date values to current date value in sorted list
                    # end loop when matching index found
                    while (filemtime($images_list[$j]) != $img_dates[$i]) {
                        $j++;
                    }

                    # swap image to be in index where equal date value found
                    if ($j != $i) {
                        $temp_img = $images_list[$i];
                        $images_list[$i] = $images_list[$j];
                        $images_list[$j] = $temp_img;
                    }
                }

                return $images_list;
            }

            function comp_sizes($images_list, $img_sizes) {
                for ($i=0;$i<count($img_sizes);++$i) {
                    $j = 0;

                    # compare image sizes to current size in sorted list 
                    # end loop when matching index found
                    while (filesize($images_list[$j]) != $img_sizes[$i] && $j<count($images_list)) {
                        $j++;
                    }

                    # swap image to be in index where equal size found
                    if ($j != $i) {
                        $temp_img = $images_list[$i];
                        $images_list[$i] = $images_list[$j];
                        $images_list[$j] = $temp_img;
                    }
                }

                return $images_list;
            }

            
            # $sort_mode == "date_newest" : newest images first
            function sort_newest($images_list) {
                # create array of image dates
                $img_dates = array();

                for ($i=0;$i<count($images_list);++$i) {
                    $img_dates[$i] = filemtime($images_list[$i]);
                }

                # sort largest-smallest (newer = larger date value)
                rsort($img_dates);
                
                # use date values in sorted array to sort list of images by comparison
                return (comp_dates($images_list, $img_dates));
            }

            # $sort_mode == "date_oldest" : oldest images first
            function sort_oldest($images_list) {
                # create array of image dates
                $img_dates = array();

                for ($i=0;$i<count($images_list);++$i) {
                    $img_dates[$i] = filemtime($images_list[$i]);
                }

                # sort smallest-largest (older = smaller date value)
                sort($img_dates);

                # use date values in sorted array to sort list of images by comparison
                return (comp_dates($images_list, $img_dates));
            }

            # $sort_mode == "size_largest" : largest file size first
            function sort_largest($images_list) {
                # create array of image sizes
                $img_sizes = array();

                for ($i=0; $i<count($images_list);++$i) {
                    $img_sizes[$i] = filesize($images_list[$i]);
                }

                rsort($img_sizes);

                # use size values in sorted array to sort list of images by comparison
                return (comp_sizes($images_list, $img_sizes));
            }

            # $sort_mode == "size_smallest" : smallest file size first
            function sort_smallest($images_list) {
                # create array of image sizes
                $img_sizes = array();

                for ($i=0; $i<count($images_list);++$i) {
                    $img_sizes[$i] = filesize($images_list[$i]);
                }

                sort($img_sizes);

                # use size values in sorted array to sort list of images by comparison
                return (comp_sizes($images_list, $img_sizes));
            }

            function proc_gallary($image_list_filename, $mode, $sort_mode) {
                $handle = fopen($image_list_filename,"r") or die("Cannot open " . $image_list_filename);
                
                $images_list = array();
                $images_info = array();
                $img_index = 0;

                while ($data = fgets($handle)) {
                    # get img name & description - store in separate lists
                    $img_list = preg_split("/,(?=([^\"]*\"[^\"]*\")*[^\"]*$)/", $data);

                    $img_name = ltrim($img_list[0], " \"");
                    $img_name = rtrim($img_name, "\"\n");
                    $img_info = ltrim($img_list[1], " \"");
                    $img_info = rtrim($img_info, "\"\n");

                    $images_list[$img_index] = $img_name;
                    $images_info[$img_index] = $img_info;

                    $img_index++;
                }
                fclose($handle);

                # create sorted images list
                $images_sorted = array();

                if ($sort_mode == "orig") {
                    # $sort_mode == "orig" : original ordering in the CSV file
                    $images_sorted = $images_list;
                }
                else if ($sort_mode == "date_newest") {
                    $images_sorted = sort_newest($images_list);
                }
                else if ($sort_mode == "date_oldest") {
                    $images_sorted = sort_oldest($images_list);
                }
                else if ($sort_mode == "size_largest") {
                    $images_sorted = sort_largest($images_list);
                }
                else if ($sort_mode == "size_smallest") {
                    $images_sorted = sort_smallest($images_list);
                }
                else if ($sort_mode == "rand") {
                    # $sort_mode == "rand" : random ordering
                    shuffle($images_list);
                    $images_sorted = $images_list;
                }

                # format layout of sorted images
                if ($mode == "list") {
                    list_view($images_sorted);
                }
                else if ($mode == "matrix") {
                    matrix_view($images_sorted);
                }
                else if ($mode == "details") {
                    details_view($images_sorted, $images_info);
                }
            }

            # get values from drop down boxes - input to proc_gallary 
            $view_choice = $_GET['view'];
            $sort_choice = $_GET['sort'];
            
            echo proc_gallary("img_test.csv",$view_choice,$sort_choice);
            
        ?>
        

    </body>

</html>