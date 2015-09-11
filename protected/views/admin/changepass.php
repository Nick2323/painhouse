<h1>Змінити пароль</h1>

<div class="clear_row"></div>

<?php $modelchangepassword=new adminsChangePassword; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-change-password-edit_admins-change-password',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
    ),
)); ?>


<?php echo $form->errorSummary($modelchangepassword); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modelchangepassword,'Новий пароль:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->passwordField($modelchangepassword,'pass1',array('id'=>"adminsChangePassword_pass1")); ?>
    </div>
</div>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modelchangepassword,'Повторити пароль:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->passwordField($modelchangepassword,'pass2',array('id'=>"adminsChangePassword_pass2")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Змінити пароль',array('id'=>"admin_change_password_id_submit",'onclick'=>'adminchangepassword();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminsChangePassword_pass1').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_change_password_id_submit').click();
        });
        $('#adminsChangePassword_pass2').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_change_password_id_submit').click();
        });
    });

    function adminchangepassword(){
        var pass1=$("#adminsChangePassword_pass1").val();
        var pass2=$("#adminsChangePassword_pass2").val();
        var data={login:login,password:password,pass1:pass1,pass2:pass2};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/changepass"); ?>',
            data:{"command":data},
            dataType:"json",
            success:successFunc2,
            error:errorFunc
        })
    }
</script>