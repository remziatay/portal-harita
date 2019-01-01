<?php
namespace kouosl\harita\controllers\console;

class DefaultController extends \kouosl\base\controllers\console\BaseController
{
    public function actionIndex()
    {
        return $this->render('_index');
    }
}
