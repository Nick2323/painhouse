<h1>Видалити члена ансамблю</h1>

<div class="clear_row"></div>

<?php $modeldeletemember=new adminsDeleteMember; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-delete-member-edit_admins-delete-member',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
    ),
)); ?>


<?php echo $form->errorSummary($modeldeletemember); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeldeletemember,'Імя члена ансамблю:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modeldeletemember,'name',array('id'=>"adminsDeleteMember_name")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Видалити',array('id'=>"admin_delete_member_id_submit",'onclick'=>'admindeletemember();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminsDeleteMember_name').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_delete_member_id_submit').click();
        });
    });

    function admindeletemember(){
        var name=$("#adminsDeleteMember_name").val();
        var data={login:login,password:password,name:name};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/deletemember"); ?>',
            data:{"command":data},
            dataType:"json",
            success:successFunc2,
            error:errorFunc
        })
    }
</script>