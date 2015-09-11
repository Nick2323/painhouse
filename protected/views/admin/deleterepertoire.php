<h1>Видалити репертуар</h1>

<div class="clear_row"></div>

<?php $modeldeleterepertoire=new adminsDeleteRepertoire; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-delete-repertoire-edit_admins-delete-repertoire',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
    ),
)); ?>


<?php echo $form->errorSummary($modeldeleterepertoire); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeldeleterepertoire,'Назва репертуару:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modeldeleterepertoire,'name',array('id'=>"adminsDeleteRepertoire_name")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Видалити',array('id'=>"admin_delete_repertoire_id_submit",'onclick'=>'admindeleterepertoire();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminsDeleteRepertoire_name').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_delete_repertoire_id_submit').click();
        });
    });

    function admindeleterepertoire(){
        var name=$("#adminsDeleteRepertoire_name").val();
        var data={login:login,password:password,name:name};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/deleterepertoire"); ?>',
            data:{"command":data},
            dataType:"json",
            success:successFunc2,
            error:errorFunc
        })
    }
</script>