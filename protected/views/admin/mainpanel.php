<script type="text/javascript">
    function successFunc2(arr){
        var text=arr['text'];
        alert(text);
    }
</script>

<div class="clear_row"></div>

<div id="clear_container"></div>

<div class="row">
    <button onclick="go('uploadmedia')">Завантажити медіа файли</button>
</div>
<div class="row">
    <button onclick="go('deletemedia')">Видалити медіа файли</button>
</div>
<div class="row">
    <button onclick="go('addrepertoire')">Добавити репертуар</button>
</div>
<div class="row">
    <button onclick="go('deleterepertoire')">Видалити репертуар</button>
</div>
<!--<div class="row">-->
<!--    <button onclick="go('addmember')">Добати члена ансамблю</button>-->
<!--</div>-->
<!--<div class="row">-->
<!--    <button onclick="go('deletemember')">Видалити члена ансамблю</button>-->
<!--</div>-->
<div class="row">
    <button onclick="go('changepass')">Змінити пароль</button>
</div>
<div class="row">
    <button onclick="adminlogout()">Вийти з панелі</button>
</div>


<script type="text/javascript">

    function successFuncGo(arr){
        if(arr!=""){
            var site=arr['site'];
            $("#clear_container").empty();
            $("#clear_container").append(site);
            $("#clear_container").append("<div class='clear_row'></div>");
        }
        else{
            alert("Не вірний пароль, будь ласка, перезайдіть.");
        }
    }

    function go(url){
        var data={login:login,password:password,url:url};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/admingetpage"); ?>',
            data:{"command":data},
            dataType:"json",
            success:successFuncGo,
            error:errorFunc
        })
    }

    function successLogout(arr){
        var site=arr['site'];
        login="";
        password="";
        $("#admin_panel").empty();
        $("#admin_panel").append(site);
    }

    function adminlogout(){
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("site/logout"); ?>',
            data:{},
            dataType:"json",
            success:successLogout,
            error:errorFunc
        })
    }

</script>
