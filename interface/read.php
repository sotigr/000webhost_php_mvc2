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
    .articlebox table tr td{
        color:#000;
    }
</style>

<script>  document.addEventListener('onload', function () {
        SetTitle("Article");
    });</script>   




<div id="articlehost" class='articlebox' style="padding:10px; ">


    <div style="width:25px; height: 25px; background: url('/img/Gear.svg') no-repeat 0 0; margin: 0 auto;"></div>


</div>


<script>
    document.addEventListener('onload', function () {
        function b64DecodeUnicode(str) {
            return decodeURIComponent(Array.prototype.map.call(atob(str), function (c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
        }


        function getParameterByName(name, url) {
            if (!url) {
                url = window.location.href;
            }
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
            if (!results)
                return null;
            if (!results[2])
                return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
        function b64DecodeUnicode(str) {
            // Going backwards: from bytestream, to percent-encoding, to original string.
            return decodeURIComponent(atob(str).split('').map(function (c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
        }

        var param = getParameterByName("a");
        if (param == null)
        {

            document.title = ":D";
            document.getElementById("articlehost").html("lol this does not exist.");
        } else
        {
            var res = httpGetJSON('/api/getarticle', {artid: param});
            SetTitle(res[0]["artname"]);

            var enc = new TextDecoder("utf-8");

            httpGet("/api/getarticle_data", {val: res[0]["artval"]}, true, function (e) {
                var html = enc.decode(new Uint8Array(JSON.parse(e)));
                var arthost = document.getElementById("articlehost");
                arthost.innerHTML = html;
            });



        }
    });
</script>
