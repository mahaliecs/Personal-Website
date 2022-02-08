<!DOCTYPE html>
<html>

<head> 
</head>

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

<br> <br> <br> <br> <br> <br>

<body>

    <form action="search.php" method="get">
        enter search word: <input type="text" name="search">
        <button type="submit" onclick="findText()">click to search!</button>
    </form>

    <ul id="temp">
        <li>insert links here!</li>
    </ul>

    <p>howdy class of 2023!</p>

    
    <?php

        $search = $_GET["search"];
        echo "search word: ".$search."\n";
        echo "Container IP Address:".getenv('MY_IP')."\n";


        function search($string)  {

            if (filter("192.168.50.182:5555/index.php", FILTER_VALIDATE_URL)) {
                $html = file_get_contents("192.168.50.182:5555/index.php");
            }

            $doc = new DOMDocument();
            $doc->loadHTML($html);

            $match_found = $doc->getElementsByTagName("*");

            print_r($match_found);
            echo "<ul>";
            foreach ($match as $content) {
                echo "<li>".$content."</li>\n";
            }
            echo "<ul>\n";
        }
        
        # example calls

        # search("search keyword")

        # this will result in a list of hyperlinks that point to your 
        # web pages that contain the search keyword.
        #
        # 1. http://your.site.com/blog.php?highlight=search%02keyword
        # 2. http://your.site.com/resources.php?highlight=search%02keyword

    ?>

</body>

<script type="text/javascript">
    function findText() {
        var keyword = "howdy";
        const links = [];
        var text = "<ul>";
        for (let i = 0; i < document.anchors.length; i++) {
            fetch (document.anchors[i]) 
                .then(res => res.text()) 
                .then(responseText) => {
                    const doc = new DOMParser().parseFromString(responseText, 'text/html');
                    var doc_html = document.getElementsByTagName("html")[0].innerHTML;
                    var match = doc_html.search("howdy");
                }
                if (match != -1) {
                    text += "<li>match found in: "+document.anchors[i]+"</li>";
                }
            // text += "<li>"+document.anchors[i]+"</li>";
        }
        // text += "</ul>";
        // document.getElementById("temp").innerHTML = text;
    }


    // document.getElementById("temp").innerHTML = "howdy";
        // var keyword = "howdy";
        // const links = [];
        // for (const item of Array.from(document.header.getElementByTagName("a"))) {
        //     var page_link = "192.168.50.182:5555/" + item.href;
        //     document.getElementsById("temp").innerHTML = page_link;
        //     fetch (page_link) 
        //         .then(res => res.text()) 
        //         .then(responseText) => {
        //             const doc = new DOMParser().parseFromString(responseText, 'text/html');
        //             // for (const item of Array.from(doc.getElementsByTagName('*'))) {
                    
        //             // }
        //         }

        // for (const item of Array.from(document.body.getElementsByTagName('*'))) {
        // for (const item of Array.from(document.body.getElementsByTagName('*'))) {
        //     for (const node of Array.from(item.childNodes).filter(node=>nodeType === Node.TEXT_NODE)) {
        //         var data_item = node.data;
        //         document.write(data_item);
        //         links.push(data_item);
        //     }
        // }
        // text = "<ul>";
        // for (let i =0; i < link.length; i++) {
        //     text += "<li>" + links[i] + "</li>";
        // }
        // text += "</ul>";
        // document.getElementByTagName("ul").innerHTML = text;
</script>


</html>