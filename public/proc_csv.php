<!-- csv core functions -->

<!DOCTYPE html>
<html>

    <head>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
    </head>

    <style>
        .csv {
            border-collapse: collapse;
            border: 1px solid rgb(89, 114, 161);
            width: 85%;
            font-size: 0.9em;
        }
        .csv th {
            background-color: rgb(89, 114, 161);
            color: white;
            border-collapse: collapse;
            border: 1px solid rgb(89, 114, 161);
        }
        .csv td {
            border-collapse: collapse;
            border: 1px solid rgb(89, 114, 161);
        }
        body {
            font-family: 'Space Mono', monospace;
        }
    </style>

    <body>
        <?php
            function proc_csv ($filename, $delimiter, $quote, $columns_to_show) {
                
                # open file & read into data 
                echo "<h3>loading: ".$filename."... </h3>\n";

                $handle = fopen($filename,"r") or die("Cannot open " . $filename);

                # create table
                echo "<table class=\"csv\">\n";
                echo "<th>".$filename."</th>\n";

                while ($data = fgets($handle)) {
                        # create row of table data
                        echo "<tr>\n"; 

                        # regex pattern matching to split data into columns
                        $pattern = "/".$delimiter."(?=([^".$quote."]*".$quote."[^".$quote."]*".$quote.")*[^".$quote."]*$)/";
                        $data_cols = preg_split($pattern, $data);

                        for ($k=0; $k<count($data_cols); ++$k) {
                            # clean data - strip quotes & newlines
                            $data_cols[$k] = ltrim($data_cols[$k], $quote);
                            $data_cols[$k] = rtrim($data_cols[$k], "\n");
                            $data_cols[$k] = rtrim($data_cols[$k], $quote);
                        }

                        # output column data into <td>
                        if ($columns_to_show == "ALL"){
                            for ($k=0; $k<count($data_cols); ++$k) {
                                echo " <td> ".$data_cols[$k]." </td>\n";
                            }
                        }
                        else {
                            // read columns_to_show values into array
                            $chosen_cols = explode(":",$columns_to_show);
                            for ($k=0; $k<count($chosen_cols); ++$k) {
                                echo "  <td> ".$data_cols[$chosen_cols[$k] - 1]." </td>\n";
                            }
                        }
                        
                        echo "</tr>\n";
                }

                fclose($handle);

                echo "</table>\n";
                echo "<br> <br> \n";
            }
        ?>

    </body>

</html>