
<script> SetTitle(<?php echo "\"" . $_SESSION["username"] . "'s profile\""; ?>);</script>
<style>
    .ul_ver{
        list-style-type: none;
        overflow:hidden;
        list-style-position: inside;
        padding-left:0;
    }
    .ul_hor{
        list-style-type: none;
        overflow:hidden;
        list-style-position: inside;
        padding-left:0;
    }
    .ul_hor li{
        display:inline;
        float: left; 
    } 
    .ul_ver li{
        display:block; 
        float:none;

    } 
    #image_host{
        width: 128px;
        height: 128px;
        border: 1px solid #057394; 

    }
    #p_info{ 

        max-width: 500px;
        margin: 0 auto;
    }
    #p_info_inl{ 
        padding-left: 10px;
    }
</style> 
<div class="ribbon">Public Information</div>

<ul id="p_info" class="ul_hor" style="width:100%;">
    <li><div id="image_host"></div></li>
    <li>
        <ul id="p_info_inl" class="ul_ver">
            <li>
                <span>UserName:</span>
            </li>
            <li>
                <span>Email:</span>
            </li> 
        </ul>
    </li>
</ul> 
<div class="ribbon">Recent Activity</div>
<style>
    .listview-table th{
        text-align: left;
    }
    .table-wrapper {
        position:relative; 
    }
    .table-scroll {
        height:150px;
        overflow-y:auto;
        overflow-x:hidden;
        margin-top:20px;
    }
    .table-wrapper table thead th .text {
        position:absolute;   
        top:-20px;
        z-index:2;
        height:20px;
        width:35%; 
    }
    .listview-table{
        width:100%;

    }
    .listview-table tbody tr:hover{
        background-color: #ddd;
    }
    .listview-table tbody tr:active{
        background-color: #aaa;
    }
    .listview-table tbody tr{
        -webkit-touch-callout: none;  
        -webkit-user-select: none; 
        -khtml-user-select: none;  
        -moz-user-select: none;  
        -ms-user-select: none; 
        user-select: none; 
        cursor:default;
    }

</style>


<div id="myid"></div>
<script>

    function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {

        for (var i = 0; i < arraytosearch.length; i++) {

            if (arraytosearch[i][key] == valuetosearch) {
                return i;
            }
        }
        return null;
    }
   
    

    var ListView = /** @class */ (function () {
        function ListView(element) {
            this.items = new Array();
            this.columns = new Array();
            this.myuid = guid(); 
            var elems = "";
            elems += '<div class="listview-table-wrapper" id="' + this.myuid + 'listview">';
            elems += '<div class="listview-table-scroll">';
            elems += '<table id="' + this.myuid + 'table" class="listview-table" border="0" cellpadding="0" cellspacing="0">';
            elems += '<thead>';
            elems += '<tr id="' + this.myuid + 'thead"></tr>';
            elems += '</thead>';
            elems += '<tbody id="' + this.myuid + 'tbody">';

            elems += '</tbody>';

            elems += '</table>';
            elems += '</div>';
            elems += '</div>';
            element.innerHTML = elems;
            this.columnHost = document.getElementById(this.myuid + 'thead');
            this.itemHost = document.getElementById(this.myuid + 'tbody');
            this.mainELement = document.getElementById(this.myuid + 'listview');
            $(this.myuid + 'table').colResizable({resizeMode: "flex"});
        };
        ListView.prototype.addColumns = function (cls) {
            var cn = cls.length;
            this.columns = [];
            for (var i = 0; i < cn; i++)
            {
                this.addColumn(cls[i]);
            }

        };
        ListView.prototype.addColumn = function (text) {
            var column_id = guid();
            this.columnHost.innerHTML += '<th id="' + 'cl' + column_id + '">' + text + "</th>";

            this.columns.push('cl' + column_id);
        };
        ListView.prototype.deleteColumn = function (index) {
            var clm = document.getElementById(this.columns[index]);
            clm.parentElement.removeChild(clm);
            this.columns.splice(index, 1);
        };
        ListView.prototype.columnCount = function () {
            return this.columns.length;
        };
        ListView.prototype.clearColumns = function () {
            var clmncn = this.columnCount();
            for (var i = 0; i < clmncn; i++)
            {
                var clm = document.getElementById(this.columns[i]);
                clm.parentElement.removeChild(clm);
            }
            this.columns = [];
        };


        ListView.prototype.addItem = function (item) {
            var subitemcn = item.length;
            var itemid = guid();
            var tr = document.createElement("TR");
            tr.id= 'it'+ itemid;
             
            for (var i = 0; i < subitemcn; i++)
            {
                var td = document.createElement("TD");
                td.innerHTML = item[i]; 
                tr.appendChild(td);
            }
         
            this.itemHost.appendChild(tr); 
         
            this.items.push('it' + itemid);
         
            return 'it'+itemid;
        };
        ListView.prototype.removeItem = function (itemid)
        {
            this.items.splice(this.items.indexOf(itemid),1);
            var elem =  document.getElementById(itemid);
            elem.parentElement.removeChild(elem);
        }
        ListView.prototype.onItemClicked = function (callback) {
            this.itemClickedCallback = callback;
        };

        return ListView;
    }());

    var lv = new ListView(document.getElementById("myid")); 
    lv.addColumns(["cl1", "cl2", "cl3", "cl4"]);
    var onClick = function(e)
    {
        alert(e.data.id);
    }
    for (var i = 0; i<3;i++)
    {
        var itid = lv.addItem(["val1", "val2", "val3", "val4"]);

        $('#'+ itid).click({id:itid},onClick);
    }
 

</script>