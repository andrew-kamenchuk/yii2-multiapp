<?php
namespace core\webapp\controllers;

class DefaultController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->renderPartial("index.html", [
            "controller" => get_class($this->action->controller),
        ]);
    }
}
