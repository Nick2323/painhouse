<h1>Видалити медіа файл</h1>

<div class="clear_row"></div>

<?php $modeldeletemedia=new adminsDeleteMedia; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-delete-media-edit_admins-delete-media',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
    ),
)); ?>


<?php echo $form->errorSummary($modeldeletemedia); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeldeletemedia,'Назва файлу:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modeldeletemedia,'name',array('id'=>"adminsDeleteMedia_name")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Видалити',array('id'=>"admin_delete_media_id_submit",'onclick'=>'admindeletemedia();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminsDeleteMedia_name').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_delete_media_id_submit').click();
        });
    });

    function admindeletemedia(){
        var name=$("#adminsDeleteMedia_name").val();
        var data={login:login,password:password,name:name};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/deletemedia"); ?>',
            data:{"command":data},
            dataType:"json",
            success:successFunc2,
            error:errorFunc
        })
    }
</script>