<?php
class Controllers{
    protected $model;
    protected $views;
    
    public function __construct(){
        $this->views = new Views();
    }
    public function loadModel($model){
        $url = 'models/'.$model.'model.php';
        if(file_exists($url)){
            require $url;
            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }
}