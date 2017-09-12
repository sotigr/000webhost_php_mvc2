<script>SetTitle("Publish")</script> 
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
<div style='padding:5px;'>
    <table style="width: 100%;">
        <tr>
            <td>Please select the type of document you are publishing</td>
            <td style="width:120px;">
                <input type="radio" name="posttype" id="article"> <label for="article">Project</label><br>
                <input type="radio" name="posttype" id="post" checked> <label for="post">Blog Post</label><br>
            </td>
        </tr> 
    </table>
    <div>Select a base64 file to upload <input type="button" value="Browse..." onclick="selectfile();" /></div>
    <a href="/downloads/docxtohtml.zip">Download docx to html converter</a>
    <div style="margin-right:5px;"><table style="width:100%;">
            <tr>
                <td><h1>Title</h1></td> 
            </tr> 
            <tr>
                <td><input id="title_text" type="text" style="width:100%;" /></td> 
            </tr> 

        </table>
        <table style="width:100%; display: none;" id="description_container" >
            <tr >
                <td><h1>Description</h1></td>  
            </tr> 
            <tr>
                <td><textarea id="description_text"  style="width:100%; max-width:100%; min-width:100%; resize: none; height:300px;"></textarea></td>  
            </tr> 
        </table></div>
</div>
<div id="hdiv" style="display:none;">
    <h1>Document Preview</h1>
    <div id="preview_div" class="articlebox scroll" style="padding:10px; max-height: 400px;">

    </div>
    <div style="text-align:right; padding:10px;"><input type="button" value="Upload" onclick="UploadFile();" /></div>
</div>


<meta charset="UTF-8">
<script >
    
    document.getElementById("article").addEventListener('click', function(){
       
       if (this.checked)
       {
           document.getElementById("description_container").style.display = "table";
           
       }
    });
    document.getElementById("post").addEventListener('click', function(){
       if (this.checked)
       {
           document.getElementById("description_container").style.display = "none";
       }
    });
    
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

    var replaceWordChars = function (text) {
        var s = text;
        // smart single quotes and apostrophe
        s = s.replace(/[\u2018\u2019\u201A]/g, "\'");
        // smart double quotes
        s = s.replace(/[\u201C\u201D\u201E]/g, "\"");
        // ellipsis
        s = s.replace(/\u2026/g, "...");
        // dashes
        s = s.replace(/[\u2013\u2014]/g, "-");
        // circumflex
        s = s.replace(/\u02C6/g, "^");
        // open angle bracket
        s = s.replace(/\u2039/g, "<");
        // close angle bracket
        s = s.replace(/\u203A/g, ">");
        // spaces
        s = s.replace(/[\u02DC\u00A0]/g, " ");

        return s;
    }
    function gabi_content() {
        var element = document.getElementById('txt');
        element.innerHTML = element.innerText || element.textContent;
    }
    function selectfile() {
        dia.Show(function () {
            dia.GetDataText(function (data) {

                htmlfile = replaceWordChars(data);

                document.getElementById("preview_div").innerHTML = (htmlfile);
                document.getElementById('hdiv').style.display = 'block';
                var node = document.getElementById('preview_div');
                var text = node.innerText;
                document.getElementById('description_text').value = makeDescription(text, 800);
                document.getElementById('title_text').value = "Unnamed";

            }, 'UTF-8');
        });
    }
    function b64EncodeUnicode(str) {
        // first we use encodeURIComponent to get percent-encoded UTF-8,
        // then we convert the percent encodings into raw bytes which
        // can be fed into btoa.
        return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
                function toSolidBytes(match, p1) {
                    return String.fromCharCode('0x' + p1);
                }));
    }



    function UploadFile()
    {
        var title = $("#title_text").val();
        var description = $("#description_text").val();
        var type = "art";
        if (document.getElementById('post').checked) {
            type = "post";
        }
        var enc = new TextEncoder("utf-8");
        var res = httpPost("/api/publish", {html: enc.encode(htmlfile), title: title, description: description, type: type}, false);
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
            //MsgBox("There was a problem while publishing...<br/>" + res);
            alert("There was a problem while publishing...<br/>" + res);
        }
    }

</script>