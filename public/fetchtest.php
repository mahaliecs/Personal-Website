<!DOCTYPE html>

<html>

<body>

    <ul id="temp"></ul>

    <p>howdy class of 2023!</p>

    <button onclick="findText()">call findText</button>

</body>

<script>
    function findText() {

        const links = [];
        const url = "http://192.168.50.182:5555/index.php";
        // create string variable to hold list of links
        var text = "<ul>";
        console.log("test");

        fetch (url) 
            .then(res => res.text()) 
            .then((res_text) => {
                console.log("test");
                text += "<li>hey</li>";
                var doc = new DOMParser().parseFromString(res_text, 'text/html');
                var html_tags = doc.body.getElementsByTagName("*");
                text += "<li>hi"+html_tags.length+"</li>";
                for (let i = 0; i < html_tags.length; i++) {
                    var html_text = html_tags[i].innerHTML;
                    if (html_text.includes(keyword)) {
                        html_tags[i].innerHTML = "<a name=\"match"+i+"\"></a>"+html_text;
                        text += "<li><a href=\""+document.anchors[i]+"#match"+i+"\">match</a></li>";
                    }
                }
            })
            .catch((error) => {
                console.error('error.', error);
            });

        text += "</ul>";
        document.getElementById("temp").innerHTML = text;
    }

</script>

</html>