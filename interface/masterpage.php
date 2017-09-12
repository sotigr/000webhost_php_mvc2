<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
        <meta http-equiv="PRAGMA" content="NO-CACHE" />
        <meta http-equiv="EXPIRES" content="-1" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
        <meta charset="UTF-8">
        <title></title> 
    </head>
    <body> 
        <script src="/scripts/lib.js" type="text/javascript"></script> 
        <link rel="stylesheet" type="text/css" href="/style/main.css">
        <link rel="stylesheet" type="text/css" href="/style/controls.css"> 
        <style>
            .blur{

                -webkit-filter: blur(2px);
                -moz-filter: blur(2px);
                -o-filter: blur(2px);
                -ms-filter: blur(2px);
                filter: blur(2px) opacity(70%);

            }
            .no-blur{

                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px) opacity(100%); 
            }
            .no-click{
                pointer-events: none;
            }
            .click{
                pointer-events: auto;
            }
        </style>
        <div></div>
        <div id="master_header">
            <table style="width:100%; padding:0; margin:0; outline:none;  border-collapse: collapse;   border-spacing: 0;"> 
                <tr>   
                    <td>
                        <div id="menuopenbtn" class="button" style="height:20px; width:30px;    margin-top:15px;   margin-left: 20px;">  
                            <div class="menubtnimage"></div>
                        </div>
                    </td>
                    <td style="color:#fff; text-align:right; padding-right: 10px;">  <?php
                        if (array_key_exists('userid', $_SESSION)) {
                            echo "Logged in as: " . $_SESSION["username"];
                        } else {
                            echo "<a href=\"/login\">Login</a>";
                        }
                        ?></td>
                </tr>
            </table>
        </div>
        <div id="master_menu_host" >
            <div style="height:100%;" class="scroll">
                <div id="master_menu_item_host"  >

                    <a href="/"><div class="master_menu_item">Blog</div></a>
                    <a href="/projects"><div class="master_menu_item">Projects</div></a>
                    <?php if (!array_key_exists('userid', $_SESSION)) { ?><a href="/login"><div class="master_menu_item">Login</div></a> <?php } ?>
                    <?php if (!array_key_exists('userid', $_SESSION)) { ?><a href="/register"><div class="master_menu_item">Register</div></a><?php } ?>  
                    <a href="#" onclick="showaboutwin()" ><div class="master_menu_item">About</div></a> 
                    <?php if (array_key_exists('userid', $_SESSION)) { ?><a href="/runquery"><div class="master_menu_item">Run query</div></a> <?php } ?> 
                    <?php if (array_key_exists('userid', $_SESSION)) { ?> <a href="/publish"><div class="master_menu_item">New post or project</div></a> <?php } ?>
                    <?php if (array_key_exists('userid', $_SESSION)) { ?> <a href="/edit_article"><div class="master_menu_item">Manage posts and projects</div></a> <?php } ?>
                    <?php if (array_key_exists('userid', $_SESSION)) { ?> <a href="/profile"><div class="master_menu_item">Profile</div></a> <?php } ?>
                    <?php if (array_key_exists('userid', $_SESSION)) { ?> <a href="/profile_settings"><div class="master_menu_item">Profile settings</div></a> <?php } ?>
                    <?php if (array_key_exists('userid', $_SESSION)) { ?> <a onclick="dologout();" href="#"><div class="master_menu_item">Logout</div></a> <?php } ?>                                            

                </div>
            </div>
        </div>

        <div id="master_content_container">
            <div id="master_content_wraper">
                <div class='ribbon' id="myttl" ></div>
                <script>
                    function SetTitle(ttl)
                    {
                        document.getElementById("myttl").html(ttl);
                        document.title = ttl; 
                    }
                 </script>
                <div  style=" position:absolute; top:31px; bottom:3px; left:3px; right:3px;  " class="scroll"><pcont></pcont></div>
            </div>
        </div>
        <div id="master_footer" style="display:none;"></div>

        <script>
            var main_page_content_element;
         
            function showaboutwin()
            {
                var winindex = CreateWindow("About me", (window.innerWidth / 2) - 350 / 2, (window.innerHeight / 2) - 280 / 2, 350, 280);

                GetWIndowContent(winindex).style.position = "relative";
                GetWIndowContent(winindex).style.textAlign = "center";
                GetWIndowContent(winindex).innerHTML = httpGet("/interface/about", false);

            }
            main_page_content_element = document.getElementById("page_content");



            window.addEventListener("resize", function () {
                main_page_content_element.style.top = parseInt(main_title_element.offsetHeight, 10) + 3;
            })

            var ismenuopen = false;
            var mouseinmenu = false;
            var mouseinmenubtn = false;
            var menubuttonElement = document.getElementById('menuopenbtn');
            var menuhostElement = document.getElementById('master_menu_host');
            var bodyElement = document.body;
            var master_content_container_element = document.getElementById('master_content_container');
            function OpenMenu(menuelement) {
                menuelement.style.left = "0px";
                menuelement.style.display = "block";
                master_content_container_element.classList.remove('no-blur');
                master_content_container_element.classList.add('blur');
                master_content_container_element.classList.remove('click');
                master_content_container_element.classList.add('no-click');
            }
            function CloseMenu(menuelement) {
                menuelement.style.display = "none";

                master_content_container_element.classList.remove('blur');
                master_content_container_element.classList.add('no-blur');
                master_content_container_element.classList.remove('no-click');
                master_content_container_element.classList.add('click');
                return;
            }
            menuhostElement.onmouseenter = function () {
                if (!ismobile)
                    mouseinmenu = true;
            };
            menuhostElement.onmouseleave = function () {
                if (!ismobile)
                    mouseinmenu = false;
            };
            menubuttonElement.onmouseenter = function () {
                if (!ismobile)
                    mouseinmenubtn = true;
            };
            menubuttonElement.onmouseleave = function () {
                if (!ismobile)
                    mouseinmenubtn = false;
            };
            bodyElement.onclick = function () {
                if (!ismobile)
                    if (!mouseinmenu && !mouseinmenubtn)
                    {
                        CloseMenu(menuhostElement);
                        ismenuopen = false;
                    }
            };
            menubuttonElement.onclick = function () {

                if (ismenuopen)
                {
                    CloseMenu(menuhostElement);
                    ismenuopen = false;
                } else
                {
                    OpenMenu(menuhostElement);
                    ismenuopen = true;
                }
            };
            function dologout()
            {
                httpGet('/api/logout', null);
                location.href = "/";
            }

        </script>
    </body>
</html>
