<h1>Додати репертуар</h1>

<div class="clear_row"></div>

<?php $modeladdrepertoire=new adminsAddRepertoire; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-add-repertoire-edit_admins-add-repertoire',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
    ),
)); ?>


<?php echo $form->errorSummary($modeladdrepertoire); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeladdrepertoire,'Назва репертуару:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modeladdrepertoire,'Name',array('id'=>"adminsAddRepertoire_Name")); ?>
    </div>
</div>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeladdrepertoire,'Категорія репертуару:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modeladdrepertoire,'Category',array('id'=>"adminsAddRepertoire_Category")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Добавити',array('id'=>"admin_add_repertoire_id_submit",'onclick'=>'adminaddrepertoire();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminsAddRepertoire_Name').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_add_repertoire_id_submit').click();
        });
        $('#adminsAddRepertoire_Category').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_add_repertoire_id_submit').click();
        });
    });

    function adminaddrepertoire(){
        var name=$("#adminsAddRepertoire_Name").val();
        var category=$("#adminsAddRepertoire_Category").val();
        var data={login:login,password:password,Name:name,Category:category};
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/addrepertoire"); ?>',
            data:{"command":data},
            dataType:"json",
            success:successFunc2,
            error:errorFunc
        })
    }
</script>