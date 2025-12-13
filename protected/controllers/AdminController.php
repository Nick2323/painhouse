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
        $text="Помилка при передачі данних.";
        $targetDir=Yii::app()->basePath. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'gallery';
        if(isset($_REQUEST['command'])){
            $model=new adminsUpload;
            $arr=$_REQUEST['command'];
            if($this->check_password($arr[3],$arr[4])){
                if($arr[0]!=""){
                    $find=adminsUpload::model()->findBySql("SELECT ID FROM media WHERE MediaFileName='".$arr[0]."'");
                    if(!$find){
                        $filePath = $targetDir . DIRECTORY_SEPARATOR . $arr[0].'.'.strtolower($arr[1]);
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
                            $model->MediaFileName=$arr[0];
                            $model->MediaType=strtolower($arr[1]);
                            $model->Description=$arr[2];
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
                                    rename("{$filePath}.part",$filePath);
                                    $text="Файл успішно збережений.";
                                }
                                else{
                                    unlink("{$filePath}.part");
                                    $text="Помилка при збережені запису в базу данних.";
                                }
                            }
                            else{
                                $text="Не допустиме розширення файлу... Допустимі розширення: jpg png jpeg mp3 mp4.";
                            }
                        }
                        else{
                            $text="Помилка при завантажені файлу.";
                        }
                    }
                    else{
                        $text="Файл з таким іменем вже існує.";
                    }
                }
                else{
                    $text="Введіть нове імя файлу.";
                }
            }
            else{
                $text="Не вірний пароль, будь ласка, перезайдіть.";
            }
        }
        die($text);
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
        $text="Помилка при передачі данних.";
        if(isset($_POST['command'])){
            $model=new repertoireDB();
            $data=$_POST['command'];
            $Login=$data['login'];
            $Password=$data['password'];
            $model->Name=$data['Name'];
            $model->Category=$data['Category'];
            if($this->check_password($Login,$Password)){
                if($model->Name!=""){
                    $find=repertoireDB::model()->findBySql("SELECT ID FROM repertoire WHERE Name='".$data['Name']."'");
                    if(!$find){
                        if($model->Category!=""){
                            $find=repertoireDB::model()->findBySql("SELECT ID FROM repertoire WHERE Name='' AND Category='".$model->Category."'");
                            if(!$find){
                                if($this->createcategory($model->Category)){
                                    if($model->save()){
                                        $text="Репертуар успішно додано.";
                                    }
                                    else{
                                        $text="Помилка при додаванні в базу данних.";
                                    }
                                }
                                else{
                                    $text="Помилка при додаванні в базу данних.";
                                }
                            }
                            else{
                                if($model->save()){
                                    $text="Репертуар успішно додано.";
                                }
                                else{
                                    $text="Помилка при додаванні в базу данних.";
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
            else{
                $text="Не вірний пароль, будь ласка, перезайдіть.";
            }
        }

        echo json_encode(array('text'=>$text));
    }

    public function actionChangepass(){
        $text="Помилка при передачі данних.";
        if(isset($_POST['command'])){
            $data=$_POST['command'];
            $Login=$data['login'];
            $Password=$data['password'];
            $pass1=$data['pass1'];
            $pass2=$data['pass2'];
            if($this->check_password($Login,$Password)){
                if($pass1==$pass2){
                    $query=Yii::app()->db->createCommand("UPDATE admins SET PASSWORD='".$this->admin_encoding($pass1)."' WHERE Login='".$Login."'");
                    if($query->execute()){
                        $text="Пароль успішно змінений.";
                    }
                    else{
                        $text="Помилка при зміні паролю.";
                    }
                }
                else{
                    $text="Введені данні не співпадають.";
                }
            }
            else{
                $text="Будь ласка, перезайдіть.";
            }
        }
        echo json_encode(array('text'=>$text));
    }

    public function actionDeleterepertoire(){
        $text="Помилка при передачі данних.";
        if(isset($_POST['command'])){
            $data=$_POST['command'];
            $Login=$data['login'];
            $Password=$data['password'];
            $Name=$data['name'];
            if($this->check_password($Login,$Password)){
                $find=repertoireDB::model()->findBySql("SELECT ID,Name,Category FROM repertoire WHERE Name='".$Name."'");
                if($find){
                    $Category=$find->Category;
                    $query=Yii::app()->db->createCommand('DELETE FROM repertoire WHERE ID='.$find->ID);
                    if($query->execute()){
                        $find=repertoireDB::model()->findBySql("SELECT ID,Name,Category FROM repertoire WHERE Category='".$Category."' AND Name!=''");
                        if(!$find){
                            $query=Yii::app()->db->createCommand("DELETE FROM repertoire WHERE Category='".$Category."'");
                            $query->execute();
                        }
                        $text="Репертуар успішно видалений.";
                    }
                    else{
                        $text="Помилка при видалені з бази данних.";
                    }
                }
                else{
                    $text="Репертуару з такою назвою не існує.";
                }
            }
            else{
                $text="Не вірний пароль, будь ласка, перезайдіть.";
            }
        }
        echo json_encode(array('text'=>$text));
    }

    public function actionDeletemember(){
        $text="Помилка при передачі данних.";
        if(isset($_POST['command'])){
            $data=$_POST['command'];
            $Login=$data['login'];
            $Password=$data['password'];
            $Name=$data['name'];
            if($this->check_password($Login,$Password)){
                $find=adminsAddMember::model()->findBySql("SELECT ID,FullName,PhotoName FROM members WHERE FullName='".$Name."'");
                if($find){
                    $pathname=Yii::app()->basePath.'\..\photo\\'.$find->PhotoName;
                    $query=Yii::app()->db->createCommand('DELETE FROM members WHERE ID='.$find->ID);
                    if($query->execute()){
                        if(unlink($pathname)){
                            $text="Член ансамблю успішно видалений.";
                        }
                        else{
                            $text="Помилка при знищені фото.";
                        }
                    }
                    else{
                        $text="Помилка при видалені з бази данних.";
                    }
                }
                else{
                    $text="В базі данних немає запису з іменем ".$Name.".";
                }
            }
            else{
                $text="Не вірний пароль, будь ласка, перезайдіть.";
            }
        }
        echo json_encode(array('text'=>$text));
    }

    public function actionDeletemedia(){
        $text="Помилка при передачі данних.";
        if(isset($_POST['command'])){
            $data=$_POST['command'];
            $Login=$data['login'];
            $Password=$data['password'];
            $Name=$data['name'];
            if($this->check_password($Login,$Password)){
                $find=adminsUpload::model()->findBySql("SELECT ID,MediaType FROM media WHERE MediaFileName='".$Name."'");
                if($find){
                    $pathname=Yii::app()->basePath.'\..\gallery\\'.$Name.'.'.$find->MediaType;
                    $query=Yii::app()->db->createCommand('DELETE FROM media WHERE ID='.$find->ID);
                    if($query->execute()){
                        if(unlink($pathname)){
                            $text="Файл успішно видалений.";
                        }
                        else{
                            $text="Помилка при знищені файлу.";
                        }
                    }
                    else{
                        $text="Помилка при видалені з бази данних.";
                    }
                }
                else{
                    $text="В базі данних немає запису з іменем ".$Name.".";
                }
            }
            else{
                $text="Не вірний пароль, будь ласка, перезайдіть.";
            }
        }
        echo json_encode(array('text'=>$text));
    }

    public function actionLogin(){
        $check=true;
        if(isset($_POST['adminsForm']))
        {
                $data=$_POST['adminsForm'];
                $Login=$data['login'];
                $Password=$data['password'];
                if($this->check_password($Login,$Password)){
                    // Set admin session
                    $this->setAdminSession($Login);

                    // Return success with redirect URL
                    $check=false;
                    echo json_encode(array(
                        "success" => true,
                        "redirect" => Yii::app()->createUrl('admin/dashboard')
                    ));
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

    public function actionGetrepertoire(){
        // Check session authentication
        if(!$this->isAdminLoggedIn()){
            echo json_encode(array('error' => 'Unauthorized'));
            return;
        }

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