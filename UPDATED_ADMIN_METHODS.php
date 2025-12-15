<?php
/**
 * ОНОВЛЕНІ МЕТОДИ ДЛЯ AdminController
 *
 * Замініть існуючі методи в /protected/controllers/AdminController.php
 * цими версіями, які використовують session authentication
 */

// ============================================
// ДОДАВАННЯ РЕПЕРТУАРУ (ПІСЕНЬ)
// ============================================
public function actionAddrepertoire(){
    // Check session authentication
    if(!$this->isAdminLoggedIn()){
        echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
        return;
    }

    $text="Помилка при передачі данних.";

    if(isset($_POST['Name']) && isset($_POST['Category'])){
        $model=new repertoireDB();
        $model->Name = $_POST['Name'];
        $model->Category = $_POST['Category'];

        if($model->Name!=""){
            $find=repertoireDB::model()->findBySql("SELECT ID FROM repertoire WHERE Name='".$model->Name."'");
            if(!$find){
                if($model->Category!=""){
                    $find=repertoireDB::model()->findBySql("SELECT ID FROM repertoire WHERE Name='' AND Category='".$model->Category."'");
                    if(!$find){
                        if($this->createcategory($model->Category)){
                            if($model->save()){
                                $text="Репертуар успішно додано.";
                            }
                            else{
                                $text="Помилка при додаванні в базу даних.";
                            }
                        }
                        else{
                            $text="Помилка при додаванні в базу даних.";
                        }
                    }
                    else{
                        if($model->save()){
                            $text="Репертуар успішно додано.";
                        }
                        else{
                            $text="Помилка при додаванні в базу даних.";
                        }
                    }
                }
                else{
                    $text="Введіть назву категорії.";
                }
            }
            else{
                $text="Репертуар з такою назвою вже існує.";
            }
        }
        else{
            $text="Введіть назву репертуару.";
        }
    }

    echo json_encode(array('text'=>$text));
}

// ============================================
// ЗМІНА ПАРОЛЮ
// ============================================
public function actionChangepass(){
    // Check session authentication
    if(!$this->isAdminLoggedIn()){
        echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
        return;
    }

    $text="Помилка при передачі данних.";

    if(isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])){
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        $login = Yii::app()->session->get('admin_login');

        // Verify current password
        if($this->check_password($login, $currentPassword)){
            if($newPassword === $confirmPassword){
                if(strlen($newPassword) >= 6){
                    $query=Yii::app()->db->createCommand("UPDATE admins SET PASSWORD='".$this->admin_encoding($newPassword)."' WHERE Login='".$login."'");
                    if($query->execute()){
                        $text="Пароль успішно змінено!";
                    }
                    else{
                        $text="Помилка при зміні паролю.";
                    }
                }
                else{
                    $text="Пароль має бути не менше 6 символів.";
                }
            }
            else{
                $text="Новий пароль та підтвердження не співпадають.";
            }
        }
        else{
            $text="Поточний пароль невірний.";
        }
    }

    echo json_encode(array('text'=>$text));
}

// ============================================
// ЗАВАНТАЖЕННЯ МЕДІА
// ============================================
public function actionUploadmedia(){
    // Check session authentication
    if(!$this->isAdminLoggedIn()){
        echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
        return;
    }

    $text="Помилка при передачі данних.";
    $targetDir=Yii::app()->basePath. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'gallery';

    if(isset($_POST['fileName']) && isset($_POST['fileType']) && isset($_POST['description'])){
        $model=new adminsUpload;
        $fileName = $_POST['fileName'];
        $fileType = strtolower($_POST['fileType']);
        $description = $_POST['description'];

        $find=adminsUpload::model()->findBySql("SELECT ID FROM media WHERE MediaFileName='".$fileName."'");
        if(!$find){
            $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName.'.'.$fileType;
            $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
            $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

            if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
                $text="Failed to open output stream.";
            }

            if (!empty($_FILES)) {
                if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                    $text="Failed to move uploaded file.";
                }
                if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                    $text="Failed to open input stream.";
                }
            } else {
                if (!$in = @fopen("php://input", "rb")) {
                    $text="Failed to open input stream.";
                }
            }

            while ($buff = fread($in, 4096)) {
                fwrite($out, $buff);
            }
            @fclose($out);
            @fclose($in);

            if (!$chunks || $chunk == $chunks - 1) {
                $model->MediaFileName=$fileName;
                $model->MediaType=$fileType;
                $model->Description=$description;
                $check=false;

                if($this->image($model->MediaType)){
                    $model->Extra=0;
                    $check=true;
                }
                if($this->video($model->MediaType)){
                    $model->Extra=1;
                    $check=true;
                }

                if($check){
                    if($model->save()){
                        rename("{$filePath}.part", $filePath);
                        $text="Файл успішно завантажено!";
                    }
                    else{
                        $text="Помилка при збереженні в базу даних.";
                    }
                }
                else{
                    $text="Недопустимий тип файлу. Допустимі: jpg, png, jpeg, mp3, mp4.";
                }
            }
        }
        else{
            $text="Файл з такою назвою вже існує.";
        }
    }

    echo json_encode(array('text'=>$text));
}

// ============================================
// ВИДАЛЕННЯ УЧАСНИКА
// ============================================
public function actionDelmember(){
    // Check session authentication
    if(!$this->isAdminLoggedIn()){
        echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
        return;
    }

    $text="Помилка при передачі данних.";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $find=adminsAddMember::model()->findBySql("SELECT ID,FullName,PhotoName FROM members WHERE ID=".$id);

        if($find){
            $pathname=Yii::app()->basePath.'\..\photo\\'.$find->PhotoName;
            if(file_exists($pathname)){
                unlink($pathname);
            }

            $query=Yii::app()->db->createCommand('DELETE FROM members WHERE ID='.$id);
            if($query->execute()){
                $text="Учасника успішно видалено.";
            }
            else{
                $text="Помилка при видаленні з бази даних.";
            }
        }
        else{
            $text="Учасника не знайдено.";
        }
    }

    echo json_encode(array('text'=>$text));
}

// ============================================
// ВИДАЛЕННЯ РЕПЕРТУАРУ
// ============================================
public function actionDelrepertoire(){
    // Check session authentication
    if(!$this->isAdminLoggedIn()){
        echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
        return;
    }

    $text="Помилка при передачі данних.";

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $query=Yii::app()->db->createCommand("DELETE FROM repertoire WHERE Name='".$name."'");

        if($query->execute()){
            $text="Репертуар успішно видалено.";
        }
        else{
            $text="Помилка при видаленні з бази даних.";
        }
    }

    echo json_encode(array('text'=>$text));
}

// ============================================
// ВИДАЛЕННЯ МЕДІА
// ============================================
public function actionDelmedia(){
    // Check session authentication
    if(!$this->isAdminLoggedIn()){
        echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
        return;
    }

    $text="Помилка при передачі данних.";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $find=adminsUpload::model()->findBySql("SELECT ID,MediaFileName,MediaType FROM media WHERE ID=".$id);

        if($find){
            $pathname=Yii::app()->basePath.'\..\gallery\\'.$find->MediaFileName.'.'.$find->MediaType;
            if(file_exists($pathname)){
                unlink($pathname);
            }

            $query=Yii::app()->db->createCommand('DELETE FROM media WHERE ID='.$id);
            if($query->execute()){
                $text="Медіа успішно видалено.";
            }
            else{
                $text="Помилка при видаленні з бази даних.";
            }
        }
        else{
            $text="Медіа не знайдено.";
        }
    }

    echo json_encode(array('text'=>$text));
}

?>
