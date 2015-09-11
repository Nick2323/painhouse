<h1>Завантажити новий медіа файли</h1>

<div class="clear_row"></div>

<?php $modelupload=new adminsUpload; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admins-upload-edit_admins-upload',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'onsubmit'=>"return false;",
        'enctype' => 'multipart/form-data',
    ),
));
set_time_limit(300);
?>


<?php echo $form->errorSummary($modelupload); ?>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modelupload,'З яким іменем зберегти файл:'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modelupload,'MediaFileName',array('id'=>"adminsUpload_MediaFileName")); ?>
    </div>
</div>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modelupload,'Тип файлу(jpg,png,mp4):'); ?>
    </div>
    <div class="row2">
        <?php echo $form->textField($modelupload,'MediaType',array('id'=>"adminsUpload_MediaType",'maxlength'=>4)); ?>
    </div>
</div>

<div class="row">
    <div class="row1">
        <?php echo $form->labelEx($modelupload,'Файл:'); ?>
    </div>
    <div id="adminsUpload_Extra" class="row2">
<!--        --><?php //echo $form->fileField($modelupload,'Extra'); ?>
        <a id="pickfiles" href="javascript:;">[Select files]</a>
<!--            <a id="uploadfiles" href="javascript:;">[Upload files]</a>-->
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo $form->labelEx($modelupload,'Опис:'); ?>
    </div>
    <div class="row3">
        <?php echo $form->textArea($modelupload,'Description',array('id'=>"adminsUpload_Description")); ?>
    </div>
</div>

<div class="row">
    <div class="row3">
        <?php echo CHtml::Button('Завантажити',array('id'=>"admin_upload_media_id_submit",'onclick'=>'adminupload();')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/java/plupload.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#adminsUpload_MediaFileName').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_upload_media_id_submit').click();
        });
        $('#adminsUpload_MediaType').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_upload_media_id_submit').click();
        });
        $('#adminsUpload_Description').keypress(function(e){
            if(e.keyCode==13)
                $('#admin_upload_media_id_submit').click();
        });
    });

    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,silverlight,html4',
        browse_button : 'pickfiles',
        max_file_size : '100mb',
        max_file_count:1,
        chunk_size: "1mb",
        container: document.getElementById('adminsUpload_Extra'),
        url : '<?php echo Yii::app()->createAbsoluteUrl("admin/uploadmedia"); ?>',
        flash_swf_url : "<?php echo Yii::app()->basePath.'\\..\\java\\Moxie.swf'; ?>",
        silverlight_xap_url : "<?php echo Yii::app()->basePath.'\\..\\java\\Moxie.xap'; ?>",
        filters : {
            mime_types: [
                {title : "Image files", extensions : "jpg,png,jpeg"},
                {title:"Video files",extensions:"mp3,mp4"},
                {title : "Zip files", extensions : ""}
            ]
            },
        init: {

            Browse: function(up) {
                up.splice();
                up.refresh();
            },
    //		UploadProgress: function(up, file) {
    //			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
    //		},
            FileUploaded: function(up, file, info) {
                alert(info.response);
            },
            Error: function(up, err) {
                alert("Something went wrong.");
            }
        }
    });

    uploader.init();

    function adminupload(){
        var command=[$("#adminsUpload_MediaFileName").val(),$("#adminsUpload_MediaType").val(),$('#adminsUpload_Description').val(),login,password];
        uploader.settings.multipart_params={command:command};
        uploader.start();
    }

</script>