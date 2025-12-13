<?php
$this->pageTitle = 'Адмін-панель - ' . Yii::app()->name;
?>

<section class="page-header">
    <div class="container">
        <h1 class="page-title">Адміністративна панель</h1>
        <p class="page-subtitle">Вхід до системи управління</p>
    </div>
</section>

<section class="admin-section">
    <div class="container">
        <div id="admin_panel" class="admin_panel">
            <div class="admin-login-card">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'admins-form-edit_admins-form',
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                        'onsubmit'=>"return false;",
                        'onkeypress'=>" if(event.keyCode == 13){ adminpanel(); } ",
                        'class'=>'modern-form'
                    ),
                )); ?>

                <div class="form-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>

                <?php echo $form->errorSummary($model); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'Login',array('class'=>'form-label')); ?>
                    <?php echo $form->textField($model,'Login',array(
                        'class'=>'form-input',
                        'placeholder'=>'Введіть логін',
                        'autocomplete'=>'username'
                    )); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'Password',array('class'=>'form-label')); ?>
                    <?php echo $form->passwordField($model,'Password',array(
                        'class'=>'form-input',
                        'placeholder'=>'Введіть пароль',
                        'autocomplete'=>'current-password'
                    )); ?>
                </div>

                <div class="form-message" id="login-message" style="display:none;"></div>

                <div class="form-actions">
                    <?php echo CHtml::Button('Увійти',array(
                        'onclick'=>'adminpanel();',
                        'class'=>'btn-login'
                    )); ?>
                </div>

                <div class="form-hint">
                    <p>Стандартні дані для входу: <br><strong>Логін:</strong> admin | <strong>Пароль:</strong> Admin2025!</p>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</section>

<style>
.admin-section {
    padding: 3rem 0 6rem;
    background: var(--bg-light);
    min-height: 60vh;
}

.admin-login-card {
    max-width: 500px;
    margin: 0 auto;
    background: var(--white);
    border-radius: 20px;
    padding: 3rem;
    box-shadow: var(--shadow-lg);
    animation: fadeInUp 0.6s ease;
}

.form-icon {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 2rem;
}

.modern-form {
    width: 100%;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 1rem;
}

.form-input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--bg-light);
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--bg-light);
}

.form-input:focus {
    outline: none;
    border-color: var(--primary-color);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(44, 95, 141, 0.1);
}

.form-actions {
    margin-top: 2rem;
}

.btn-login {
    width: 100%;
    padding: 1rem;
    background: var(--gradient-primary);
    color: var(--white);
    border: none;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-login:active {
    transform: translateY(0);
}

.form-hint {
    margin-top: 2rem;
    padding: 1rem;
    background: var(--bg-light);
    border-radius: 10px;
    text-align: center;
    font-size: 0.9rem;
    color: var(--text-light);
    border-left: 4px solid var(--accent-color);
}

.form-hint strong {
    color: var(--primary-color);
}

.form-message {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    text-align: center;
    font-weight: 500;
}

.form-message.error {
    background: #fee;
    color: #c33;
    border: 1px solid #fcc;
}

.form-message.success {
    background: #efe;
    color: #3c3;
    border: 1px solid #cfc;
}

.form-message.info {
    background: #eef;
    color: #33c;
    border: 1px solid #ccf;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script type="text/javascript">
    var login="";
    var password="";

    function showMessage(text, type) {
        var messageEl = $("#login-message");
        messageEl.text(text);
        messageEl.removeClass('error success info');
        messageEl.addClass(type);
        messageEl.fadeIn();

        if(type === 'error') {
            setTimeout(function() {
                messageEl.fadeOut();
            }, 5000);
        }
    }

    function adminpanel(){
        login=$("#adminsForm_Login").val();
        password=$("#adminsForm_Password").val();

        console.log("Attempting login with:", {login: login, password: "***"});

        if(!login || !password) {
            showMessage("Будь ласка, введіть логін та пароль", "error");
            return;
        }

        var data={login:login,password:password};

        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("admin/login"); ?>',
            data:{"adminsForm":data},
            dataType:"json",
            beforeSend: function() {
                showMessage("Перевірка даних...", "info");
            },
            success:successFunc,
            error:errorFunc
        })
    }

    function successFunc(arr){
        console.log("Server response:", arr);

        if(arr && arr.success === true && arr.redirect){
            showMessage("Успішний вхід! Перенаправлення...", "success");
            // Redirect to admin dashboard
            setTimeout(function() {
                window.location.href = arr.redirect;
            }, 500);
        }
        else{
            var message = arr.message || "Не правильний логін або пароль. Перевірте дані для входу.";
            showMessage(message, "error");
            console.error("Login failed:", arr);
        }
    }

    function errorFunc(xhr, status, error){
        console.error("AJAX error:", {xhr: xhr, status: status, error: error});
        showMessage("Помилка з'єднання з сервером. Спробуйте пізніше.", "error");
    }

</script>