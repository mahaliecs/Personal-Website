<!DOCTYPE html>
<html>

<head>
    <title>Wikitext File Reader</title>
    <?php
        require_once("proc_wiki.php");
    ?>

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

    

    <?php
        proc_wikitext("wikitext.wiki");
    ?>
</body>

</html>