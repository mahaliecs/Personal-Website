<!DOCTYPE html>
<html>

<head> 
</head>

<style>
    .navbar {
        background-color: rgb(89, 114, 161);
        font-family: 'Space Mono', monospace;
    }
    .navbar ul {
        list-style-type: none;
        float: left;
    }
    .navbar li {
        float: right;
        padding-top: 2em;
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
    body {
        font-family: 'Space Mono', monospace;
        background-color: rgb(221, 229, 240);
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
    <br> <br> <br> <br>
    <p> 
    Entering into this fall semester, I was excited to dive into new courses and further my knowledge in the field of computer science. 
    I was especially excited to find that the very first project I would be undertaking was creating a personal website. 
    To provide more context for my excitement, I had previously taken the initiative over the summer to go through an online HTML course. 
    My goal in doing so was to grow my experience in front-end development, as I have always been drawn to design and therefore this is an interest area of mine. 
    Eventually I hoped to create my own website to showcase the experience I had gained in front-end development, as well as to utilize as a creative outlet. 
    Little did I know that my goal would soon come to fruition! 
    Now here we are, reminiscing on the whole experience of the creation of this website as it has unfolded over the past few weeks. 
    Outlined here in this blog is the process of how my personal website was created, from start to finish. 
    </p>

    <h2>Part 1</h2>
    <p>
    I began with a few files containing the relatively brief starter code that would eventually blossom into the website that exists today. 
    Using docker I was able to locally run and test my code as it progressed. 
    The first portion of the website aimed to support some wikitext, as well as a csv file processor. 
    This was done by creating two functions, proc_wiki and proc_csv that would read in a wikitext or csv file, 
    respectively, and output the correctly formatted code as outlined below.
    </p>
    <br>

    <h3>Wikitext</h3>
    <p>
    The proc_wiki function took a filename as a parameter and utilized fopen to read the file, looping through the file 
    using fgets to handle each line of wikitext. 
    I began to work through implementing this using preg_match and regex for pattern matching and
     created functions to handle each necessary wikitext code type. 
    Starting out, the most daunting task for me was wrapping my mind around regex syntax. 
    After struggling with it for a few days, I was eventually able to get the hang of it and 
    developed a solid understanding of what the stream of regex patterns I had been staring at actually meant. 
    </p>

    <h4>Headers</h4>
    <p>
    Beginning with headers, I used regex to check for any “=” at the beginning and end of a line;
     if these were present, I sent the current line as input to the proc_headers function. 
     This function checked how many “=” were present and output the appropriate html header tag. 
    </p>

    <h4>Horizontal Rule</h4>
    <p>
    Horizontal rule was one of the most simple to translate into html code. 
    After using regex to check for four dashes the program output the hr tag. 
    Easy enough, let’s keep going!
    </p>

    <h4>Line Breaks and Paragraphs</h4>
    <p>
    Line breaks and paragraphs presented a unique challenge in that they both required the program to be aware of the previous line of data in the file. 
    This was achieved by creating a prev_data variable that was assigned the contents of the current line of data at the end of each iteration of the while loop. 
    By comparing these variables and using regex to match empty lines with just whitespace or lines with text, the program would output the correct p tags.
    </p>

    <h4>Images</h4>
    <p>
    Regex pattern matching was used to check for two “[“ and two “]”, 
    and if found the proc_images function was called. 
    This function utilized the preg_split function to split the line around the brackets 
    as well as any equals sign, colon, or “|” present and create variables to store the image url and size. 
    These variables were then inserted into img tag and output.
    </p>

    <h4>Links</h4>
    <p>
    Regex pattern matching was used to check for “http” in the line, 
    and if found the proc_links function was called. 
    If no link title was included in the line of data, the function inserted the line into an anchor tag. 
    If a link title was included, preg_split was utilized to assign the correct content to variables 
    for link url and title which were inserted into an anchor tag and output.
    </p>

    <h4>Italics and Bold</h4>
    <p>
    Similar to handling headers, the program checked for two or more single quotes around text in a line 
    to determine whether the program would need to format italics or bold. 
    If found, the program entered the proc_italics_bold function. 
    This function counted how many single quotes were present 
    at the beginning and end of a line and output the appropriate i and b tags.
    </p>

    <h4>Indentation</h4>
    <p>
    To support indentation, regex was used to pattern match any colons at the beginning of a line; 
    if any were present, the program would call the proc_indent function, 
    count how many colons were in the line, 
    and output the correct number of spaces using “&nbsp” repeatedly. 
    </p>

    <h4>Lists</h4>
    <p>
    Unordered lists and ordered lists were handled nearly identically, with the difference being the regex pattern used and the html tag output. 
    Any “*” or “#” at the beginning of a line were matched for unordered lists and ordered lists, respectively. 
    In addition, to support subelements in a list the prev_data variable was once again utilized to maintain the correct placement of list tags. 
    Based on this information, the proc_unordered_lists and proc_ordered_lists were used to output the list tags.
    </p>

    <br>

    <h3>CSV</h3>
    <p>
    The proc_csv function takes several parameters, including a filename, delimiter and quote type. 
    In addition a parameter is given to specific which columns to show, for example “1:3” would output columns 1 and 3. 
    As with the wikitext file, fopen is used to read the file and fgets is used to loop through each line of the file and assign it to a variable data. 
    Regex pattern matching is used to split each line around the correct delimiters; the pattern used in the program is given below:
    For each iteration of the while loop, a tr tag is used to create a new row in the table. 
    If all of the columns were requested, the array given by preg_split is simply iterated through and output within td tags as table data elements. 
    If certain columns were specified, these numbers are read into an array and only the values at these indices are output in the table.
    </p>

    <br>

    <h2>Part 2</h2>
    <p>
    The second portion of this website was interesting to create; similar to proc_csv, the proc_gallary function takes a csv file as input. In addition, this function also uses the same methods for opening and handling the file and uses the same pattern to split the data into an array using preg_split. The function has two other parameters, sort and sort_mode, which are determined by selection from a drop down list; the $_GET method is used to obtain the current value in the drop down list and assign it to a variable that can be used as input in the function call. Within the csv file, each line of data contains first an image name, then a description of the image. This data is first inserted into image name and image description arrays. The image name array is then sorted based on the selected sort mode from the drop down list. If “orig” is selected, no change is made, and if “rand” is selected, the order is determined at random using the php shuffle function. The images can also be sorted based on file size or date. If “date_newest” is selected, the sort_newest function is called to sort the images from newest to oldest. This is done by creating an array of image dates, which is populated by utilizing the filemtime function for each image. This array is then sorted using the php rsort function. The comp_dates function is then used to compare the sorted dates array to the original list of images, and rearrange the original list to match. The same process is used within the sort_oldest function if “date_oldest” is selected, except the dates array is sorted using the php sort function. Additionally, a similar series of steps is used within the sort_largest and sort_smallest functions; instead of creating an array of dates, the php filesize function is utilized to create an array of image file sizes. 
	<br> <br>
    Once the image list is sorted properly, they are output on the web page according to the selected mode value. If “list” is selected, the list_view function loops through the list and inserts the image names as src values within <img> tags. A similar process is used if “matrix” is selected, except after every group of three images page breaks are used to limit the output to three images per line. Lastly, if “details” is selected the details_view function creates a table with image names and descriptions, as well as file sizes and dates using the php filesize and filemtime functions, respectively. 

    </p>

    <br>

    <h2>Part 3</h2>
    <p>
    
    </p>
</body>


</html>