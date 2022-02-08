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
    body {
        font-family: 'Space Mono', monospace;
        background-color: rgb(221, 229, 240);
    }
</style>

<header>
  <nav class="navbar">
    <ul>
      <li><a href="blog.php" name="blog">Blog</a></li>
      <li><a href="search.php" name="search">Search</a></li>
      <li><a href="gallary.php" name="gallary">Gallary</a></li>
      <li><a href="csv_test.php" name="csv">CSV</a></li>
      <li><a href="wiki_test.php" name="wikitext">Wikitext</a></li>
      <li><a class="active" href="index.php" name="home">Home</a></li>
    </ul>
  </nav>
</header>

<body>

    <br> <br> <br> <br>

    <form action="search.php" method="get">
        enter search word: <input type="text" name="search">
        <button type="submit">click to search!</button>
    </form>

    <ul id="temp1"></ul>
    <ul id="temp2"></ul>
    <ul id="temp3"></ul>
    <ul id="temp4"></ul>
    <ul id="temp5"></ul>
    <ul id="temp6"></ul>

    <p>howdy class of 2023!</p>

    <button onclick="findText(<?php $_GET['search']; ?>)">call findText</button>

    
</body>

<script>

    // async function getNewText(url, ) {
    //     const response = await fetch(url)
    // }
    function findText(keyword) {

        // search through all pages - strip anchors from nav bar
        for (let i = 0; i < document.anchors.length; i++) {

            // print urls
            // text += "<li>"+document.anchors[i]+"</li>";

            // fetch DOM at current url
            fetch (document.anchors[i]) 
                .then(res => res.text()) 
                .then((res_text) => {

                    var doc = new DOMParser().parseFromString(res_text, 'text/html');
                    var html_tags = doc.body.getElementsByTagName("*");
                    
                    for (let j = 0; j < html_tags.length; j++) {
                        // create string variable to hold list of links
                        var text = "<ul>";
                        var html_text = html_tags[j].innerHTML;

                        if (html_text.includes("howdy")) { //keyword

                            html_tags[j].innerHTML = "<a name=\"match"+j+"\"></a>"+html_text;
                            text += "<li><a href=\""+document.anchors[i]+"#match"+j+"\">match</a></li>";
                        }
                    }
                    text += "</ul>";
                    var temp_tag = "temp"+(i+1);
                    document.getElementById(temp_tag).innerHTML = text;
                })
                .catch((error) => {
                    console.error('error.', error);
                });
        }

        
    }

</script>


</html>