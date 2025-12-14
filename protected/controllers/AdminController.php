<?php

class AdminController extends Controller
{
    public $layout='admin';

    private function admin_encoding($text){
        return sha1($text);
    }

    private function check_password($login,$password){
        $find=admins::model()->findBySql("SELECT ID,Login,Password FROM admins WHERE Login='".$login."'");
        if($find){
                if($this->admin_encoding($password)==$find->Password){
                    return true;
                }
                else{
                    return false;
                }
        }
        else{
            return false;
        }
    }

    private function isAdminLoggedIn(){
        return Yii::app()->session->get('admin_logged_in') === true;
    }

    private function setAdminSession($login){
        Yii::app()->session->add('admin_logged_in', true);
        Yii::app()->session->add('admin_login', $login);
    }

    private function clearAdminSession(){
        Yii::app()->session->remove('admin_logged_in');
        Yii::app()->session->remove('admin_login');
    }

    public function actionDashboard(){
        if(!$this->isAdminLoggedIn()){
            $this->redirect(array('site/admin'));
            return;
        }
        $this->render('mainpanel');
    }

    public function actionLogout(){
        $this->clearAdminSession();
        if(Yii::app()->request->isAjaxRequest){
            echo json_encode(array(
                "success" => true,
                "redirect" => Yii::app()->createUrl('site/admin')
            ));
        } else {
            $this->redirect(array('site/admin'));
        }
    }

    private function image($type){
        $type=strtolower($type);
        if($type=="jpg"){
            return true;
        }
        if($type=="png"){
            return true;
        }
        if($type=="jpeg"){
            return true;
        }
        return false;
    }

    private function video($type){
        $type=strtolower($type);
        if($type=="mp3"){
            return true;
        }
        if($type=="mp4"){
            return true;
        }
        return false;
    }

    public function actionAddmember(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('text' => 'Не авторизовано. Будь ласка, увійдіть знову.'));
            return;
        }

        $text="Помилка при передачі данних.";

        if(isset($_POST['name']) && isset($_FILES['File'])){
            $model=new adminsAddMember;
            $name = $_POST['name'];
            $description = isset($_POST['description']) ? $_POST['description'] : '';

            if($name!=""){
                $find=adminsAddMember::model()->findBySql("SELECT ID FROM members WHERE FullName='".$name."'");
                if(!$find){
                    $model->FullName=$name;
                    $model->Description=$description;
                    $file=CUploadedFile::getInstanceByName('File');
                    if($this->image($file->getExtensionName())){
                        $id=adminsAddMember::model()->findBySql("SELECT MAX(ID) FROM members")+1;
                        $model->PhotoName=$id.'.'.$file->getExtensionName();
                        if($model->save()){
                            if($file->saveAs(Yii::app()->basePath.'\..\photo\\'.$model->PhotoName)){
                                $text="Учасника успішно додано!";
                            }
                            else{
                                $query=Yii::app()->db->createCommand('DELETE FROM members WHERE ID='.$model->ID);
                                $query->execute();
                                $text="Помилка при збереженні фото.";
                            }
                        }
                        else{
                            $text="Помилка при збереженні запису в базу даних.";
                        }
                    }
                    else{
                        $text="Недопустиме розширення файлу. Допустимі: jpg, png, jpeg.";
                    }
                }
                else{
                    $text="Учасник з таким іменем вже існує.";
                }
            }
            else{
                $text="Введіть ім'я нового учасника.";
            }
        }
        else{
            $text="Оберіть фото учасника.";
        }

        echo json_encode(array('text'=>$text));
    }

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

    private function createcategory($name){
        $model=new repertoireDB();
        $model->Name="";
        $model->Category=$name;
        if($model->save()){
            return true;
        }
        else{
            return false;
        }
    }

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

    public function actionLogin(){
        $check=true;
        $debugFile = Yii::app()->basePath . '/runtime/debug.log';

        if(isset($_POST['adminsForm']))
        {
                $data=$_POST['adminsForm'];
                $Login=$data['login'];
                $Password=$data['password'];

                // Temporary debug logging to file
                file_put_contents($debugFile, date('Y-m-d H:i:s') . " - Login attempt\n", FILE_APPEND);
                file_put_contents($debugFile, "Login: " . $Login . "\n", FILE_APPEND);
                file_put_contents($debugFile, "Password: " . $Password . "\n", FILE_APPEND);
                file_put_contents($debugFile, "Password SHA1: " . sha1($Password) . "\n", FILE_APPEND);

                if($this->check_password($Login,$Password)){
                    file_put_contents($debugFile, "✓ Password check SUCCESS\n\n", FILE_APPEND);

                    // Set admin session
                    $this->setAdminSession($Login);

                    // Return success with redirect URL
                    $check=false;
                    echo json_encode(array(
                        "success" => true,
                        "redirect" => Yii::app()->createUrl('admin/dashboard')
                    ));
                } else {
                    file_put_contents($debugFile, "✗ Password check FAILED\n\n", FILE_APPEND);
                }
        }
        if($check){
            echo json_encode(array("success" => false, "message" => "Невірний логін або пароль"));
        }
    }

    public function actionAdmingetpage(){
        $check=true;
        if(isset($_POST['command']))
        {
            $data=$_POST['command'];
            $Login=$data['login'];
            $Password=$data['password'];
            $Url=$data['url'];
            if($this->check_password($Login,$Password)){
                $text="";
                if($this->beforeRender($Url)){
                    $text=$this->renderPartial($Url,null,true);
                    $this->afterRender($Url,$text);
                    $text=$this->processOutput($text);
                }
                $check=false;
                echo json_encode(array("site"=>$text));
            }
        }
        if($check){
            echo json_encode("");
        }
    }

    public function actionGetstats(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('error' => 'Unauthorized'));
            return;
        }

        $membersCount = Yii::app()->db->createCommand("SELECT COUNT(*) FROM members")->queryScalar();
        $songsCount = Yii::app()->db->createCommand("SELECT COUNT(*) FROM repertoire WHERE Name!=''")->queryScalar();
        $mediaCount = Yii::app()->db->createCommand("SELECT COUNT(*) FROM media")->queryScalar();
        $categoriesCount = Yii::app()->db->createCommand("SELECT COUNT(*) FROM repertoire WHERE Name=''")->queryScalar();

        echo json_encode(array(
            'stats' => array(
                'members' => $membersCount,
                'songs' => $songsCount,
                'media' => $mediaCount,
                'categories' => $categoriesCount
            )
        ));
    }

    public function actionGetmembers(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('error' => 'Unauthorized'));
            return;
        }

        $members = Yii::app()->db->createCommand(
            "SELECT ID, FullName, PhotoName, Description FROM members ORDER BY ID"
        )->queryAll();

        echo json_encode(array('members' => $members));
    }

    public function actionGetmember(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('error' => 'Unauthorized'));
            return;
        }

        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $member = Yii::app()->db->createCommand(
                "SELECT ID, FullName, PhotoName, Description FROM members WHERE ID=".$id
            )->queryRow();

            if($member){
                echo json_encode(array('success' => true, 'member' => $member));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Учасника не знайдено'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'ID не вказано'));
        }
    }

    public function actionGetrepertoire(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('error' => 'Unauthorized'));
            return;
        }

        try {
            $repertoire = Yii::app()->db->createCommand(
                "SELECT Name, Category FROM repertoire WHERE Name!='' ORDER BY Category, ID"
            )->queryAll();

            $categories = Yii::app()->db->createCommand(
                "SELECT DISTINCT Category FROM repertoire WHERE Name='' ORDER BY ID"
            )->queryColumn();

            echo json_encode(array(
                'repertoire' => $repertoire,
                'categories' => $categories
            ));
        } catch (Exception $e) {
            echo json_encode(array(
                'error' => 'Database error',
                'message' => $e->getMessage()
            ));
        }
    }

    public function actionGetmedia(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('error' => 'Unauthorized'));
            return;
        }

        $media = Yii::app()->db->createCommand(
            "SELECT ID, MediaFileName, MediaType, Description FROM media ORDER BY ID DESC"
        )->queryAll();

        echo json_encode(array('media' => $media));
    }

}