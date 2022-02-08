<!DOCTYPE html>
<html>

<!-- HEAD section ............................................................................ -->
<head>
  <title> Hallie's Website </title>

  <?php
    require_once("proc_csv.php");
    require_once("proc_wiki.php");
  ?>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"><link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">

</head>
<style>
  .title {
    background-image: url("index_background.png");
    background-attachment: fixed;
    background-size: cover;
    background-position: center;

    text-align: center;
    letter-spacing: 2em;
    font-family: 'Space Mono', monospace;
    padding-bottom: 1em;
    padding-top: 2em;
  }
  .intro {
    background-color: rgb(221, 229, 240);
  }
  .intro h6 {
    font-family: 'Space Mono', monospace;
    padding-top: 2em;
    padding-bottom: 2em;
    text-align: center;
  }
  .intro img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 50%;
    width: 300px;
    height: 300px;
    object-fit: cover;
    object-position: 50% 60%;
    padding-top: 1em;
  }
  .aboutme {
    font-family: 'Space Mono', monospace;
    background-color: rgb(89, 114, 161);
    padding-top: 1em;
    padding-bottom: 1em;
  }
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
  h1 {
    font-family: 'Space Mono', monospace;
    font-size: 10em;
    color: rgb(221, 229, 240);
  }
  h2 {
    font-family: 'Space Mono', monospace;
    text-align: center;
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

<!-- BODY section ............................................................................. -->
<body>

  <div class="title"> 
    <br> <br> <br> <br> <br> <br>
    <h1> howdy! </h1>
    <br> <br> <br> <br> <br> <br>
  </div>

  <div class="intro"> 
    <img src="mypic.jpg"> <br>
    <h6>My name is Hallie Scasta & I am <br> the LOUDEST & the PROUDEST <br> 
    member of the fightin' <br> Texas Aggie class of 2023 <br> W H O O P ! </h6>
  </div>

  <div class="aboutme"> 
    <h2> Experience </h2> <br>
    <h4> Languages </h4> 
    <ul>
      <li>C++</li> 
      <li>Python</li> 
      <li>Java</li> 
      <li>Haskell</li> 
      <li>HTML</li>
      <li>CSS</li> 
      <li>PHP</li> 
    </ul>
    <h4> Leadership </h4> 
    <ul>
      <li>Howdy Day Camp - Aide</li> 
      <li>Aggie Baptist Student Ministry - Discipleship Girls Leader</li>
      <li>Mission Team Member</li>
    </ul>
  </div>

</body>

</html>

