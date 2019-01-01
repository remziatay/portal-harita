<?php
namespace kouosl\harita\controllers\frontend;

use Yii;

class DefaultController extends \kouosl\base\controllers\frontend\BaseController
{
    
    public function actionIndex()
    {
        return $this->render('_index');
    }

    public function actionZoomin(array $attrs){
        if(++$attrs['zoom'] > 22)
            $attrs['zoom'] = 22;

        \Yii::$app->db->createCommand()->upsert('last_address', [
            'user_id' => Yii::$app->user->id, 
            'address' => $attrs['center'],
            'zoom' => $attrs['zoom']
        ])->execute();
        return $this->render('index', ['attrs' => $attrs]);
    }

    public function actionZoomout(array $attrs){
        if(--$attrs['zoom'] < 0)
            $attrs['zoom'] = 0;

        \Yii::$app->db->createCommand()->upsert('last_address', [
            'user_id' => Yii::$app->user->id, 
            'address' => $attrs['center'],
            'zoom' => $attrs['zoom']
        ])->execute();
        return $this->render('index', ['attrs' => $attrs]);
    }

    public function actionSearch(array $attrs, $center){
        \Yii::$app->db->createCommand()->upsert('last_address', [
            'user_id' => Yii::$app->user->id, 
            'address' => $center,
            'zoom' => 16
        ])->execute();
        
        return $this->render('index', ['attrs' => ['center' => $center, 'width' => $attrs['width'], 'height' => $attrs['height']]]);
    }

    public function actionSave(array $attrs){

        $address = \Yii::$app->db->createCommand('SELECT * FROM `address` WHERE `address` = "'.$attrs['center'].'" AND `zoom` = '. $attrs['zoom'])->queryOne();
        if($address == false){
            \Yii::$app->db->createCommand()->insert('address', [
                'address' => $attrs['center'], 
                'zoom' => $attrs['zoom']
            ])->execute();
            
            $address = \Yii::$app->db->createCommand('SELECT * FROM `address` WHERE id=(SELECT MAX(id) FROM `address`)')->execute();
        }
        \Yii::$app->db->createCommand()->insert('saved_address', [
            'user_id' => Yii::$app->user->id, 
            'address_id' => $address['id']
        ])->execute();

        return $this->render('index', ['attrs' => $attrs]);
    }
}
