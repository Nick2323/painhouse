<h1>Додати члена ансамблю</h1>

<div class="clear_row"></div>

<?php $modeladdmember=new adminsAddMember; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-add-member-edit_admins-add-member',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
        'enctype'=>'multipart/form-data',
    ),
)); ?>


<?php echo $form->errorSummary($modeladdmember); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeladdmember,'Повне імя:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modeladdmember,'FullName',array('id'=>"adminsAddMember_FullName")); ?>
    </div>
</div>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modeladdmember,'Фото:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->fileField($modeladdmember,'PhotoName'); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo $form->labelEx($modeladdmember,'Опис:'); ?>
    </div>
    <div class="row3">
        <?php echo $form->textArea($modeladdmember,'Description',array('id'=>"adminsAddMember_Description")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Добавити',array('id'=>"admin_add_member_id_submit",'onclick'=>'adminaddmember();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminsAddMember_FullName').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_add_member_id_submit').click();
        });
        $('#adminsAddMember_Description').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_add_member_id_submit').click();
        });
    });

    function adminupload(){
        var fd = new FormData();
        var input=document.getElementById('adminsAddMember_PhotoName');
        var command=[$("#adminsAddMember_FullName").val(),$("#adminsAddMember_Description").val(),login,password];
        fd.append("command",command);
        fd.append('File',input.files[0]);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo Yii::app()->createAbsoluteUrl("admin/addmember"); ?>', true);
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                console.log(percentComplete + '% uploaded');
            }
        };
        xhr.onload = function() {
            if (this.status == 200) {
                var resp = JSON.parse(this.response);
                alert(resp.text);
            };
        };
        xhr.onerror=function(){
            alert("Something went wrong.");
        }
        xhr.send(fd);
    }

</script>