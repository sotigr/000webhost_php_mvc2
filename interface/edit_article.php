<script>SetTitle("Manage projects and posts")</script> 
<style>
    .articlebox{ 
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fcfcfe+0,f4f3ee+100 */
        background: #fff;
        color:#000;
        border:1px solid #919b9c;
        margin:5px; padding:5px; 
        box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.3);

        background-repeat: repeat;
    }
</style>



<script >

    function guid() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
        }
        return s4() + s4() + s4() + s4() +
                s4() + s4() + s4() + s4();
    }
    if (typeof String.prototype.endsWith !== 'function') {
        String.prototype.endsWith = function (suffix) {
            return this.indexOf(suffix, this.length - suffix.length) !== -1;
        };
    }

    function b64_to_utf8(str) {
        return window.atob(str);
    }

    var dia = new OpenFileDialog(".html");

    function makeDescription(input, length)
    {
        var currentindex = 0;
        if (length >= input.length)
            return null;
        do {
            currentindex = input.indexOf('.', currentindex) + 1;
        } while (currentindex != -1 && currentindex < length)
        if (currentindex == -1)
            return null;
        else
            return input.substring(0, currentindex);
    }

    var htmlfile = "";
    function selectfile() {
        dia.Show(function () {
            dia.GetDataText(function (data) {

                htmlfile = data;
                $("#preview_div").html(htmlfile);
                document.getElementById('hdiv').style.display = 'block';
                $("#preview_div").mCustomScrollbar({scrollInertia: 100});
                var node = document.getElementById('preview_div');
                var text = node.innerText;
                document.getElementById('description_text').value = makeDescription(text, 800);
                document.getElementById('title_text').value = "Unnamed";
            }, 'UTF-8');
        });
    }

    function UploadFile()
    {
        var title = $("#title_text").val();
        var description = $("#description_text").val();
        var type = "art";
        if (document.getElementById('post').checked) {
            type = "post";
        }
        var res = httpPost("/api/publish", {html: htmlfile, title: title, description: description, type: type}, false);
        if (res == "1")
        {
            if (type == "art")
            {
                MsgBox("The article was successfully published", "Message", function () {
                    location.href = "/projects";
                });

            } else
            {
                MsgBox("The post was successfully published", "Message", function () {
                    location.href = "/";
                });

            }
        } else
        {
            MsgBox("There was a problem while publishing...<br/>" + res);
        }
    }

</script>