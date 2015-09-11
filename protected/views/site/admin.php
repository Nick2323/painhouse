<?php
?>

<div id="admin_panel" class="admin_panel">

    <div class="clear_row"></div>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'admins-form-edit_admins-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'onsubmit'=>"return false;",
            'onkeypress'=>" if(event.keyCode == 13){ adminpanel(); } "
        ),
    )); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="row1">
            <?php echo $form->labelEx($model,'Логін:'); ?>
        </div>
        <div class="row2">
            <?php echo $form->textField($model,'Login'); ?>
        </div>
    </div>
    <div class="row">
        <div class="row1">
            <?php echo $form->labelEx($model,'Пароль:'); ?>
        </div>
        <div class="row2">
            <?php echo $form->passwordField($model,'Password'); ?>
        </div>
    </div>
    <div class="row">
        <div class="row3">
            <?php echo CHtml::Button('Увійти',array('onclick'=>'adminpanel();')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- admin_panel -->

<script type="text/javascript">
    var login="";
    var password="";

    function adminpanel(){
        login=$("#adminsForm_Login").val();
        password=$("#adminsForm_Password").val();
        var data={login:login,password:password};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/login"); ?>',
            data:{"adminsForm":data},
            dataType:"json",
            success:successFunc,
            error:errorFunc
        })
    }

    function successFunc(arr){
        if(arr!=""){
            var site=arr['site'];
            $("#admin_panel").empty();
            $("#admin_panel").append(site);
        }
        else{
            alert("Не правильний пароль.");
        }
    }

    function errorFunc(){
        alert("Something went wrong.");
    }

</script>