<?php

class SiteController extends Controller
{

	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionError(){
        $this->render('error');
    }

    public function actionGallery()
    {
        $this->render('gallery');
    }

    public function actionPhoto($id=0)
    {
        if($id==0){
            $this->render('pages/photo');
        }
        else{
            $this->render('pages/full',array('id'=>$id));
        }
    }

    public function actionVideo($id=0)
    {
        if($id==0){
            $this->render('pages/video');
        }
        else{
            $this->render('pages/full',array('id'=>$id));
        }
    }

    public function actionMusic()
    {
        $this->render('pages/music');
    }

    public function actionContacts()
    {
        $this->render('contacts');
    }

    public function actionEnsemble()
    {
        $this->render('ensemble');
    }

    public function actionRepertoire()
    {
        $this->render('repertoire');
    }

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAdmin()
    {
        $model=new adminsForm;
        $this->render('admin',array("model"=>$model));
    }

    public function actionLogout(){
        $text="";
        $model=new adminsForm;
        if($this->beforeRender('admin')){
            $text=$this->renderPartial('admin',array("model"=>$model),true);
            $this->afterRender('admin',$text);
            $text=$this->processOutput($text);
        }
        echo json_encode(array("site"=>$text));
    }

}