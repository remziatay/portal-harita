<?php
namespace kouosl\harita\controllers\backend;

use Yii;

class DefaultController extends \kouosl\base\controllers\backend\BaseController
{

    public function actionIndex()
    {
        return $this->render('_index');
    }

    public function actionAdd(array $attrs, $name, $center, $zoom){
        $address = \Yii::$app->db->createCommand('SELECT * FROM `address` WHERE `address` = "'.$center.'" AND `zoom` = '.$zoom)->queryOne();
        if($address == false){
            \Yii::$app->db->createCommand()->insert('address', [
                'address' => $center, 
                'zoom' => $zoom
            ])->execute();
            
            $address = \Yii::$app->db->createCommand('SELECT * FROM `address` WHERE id=(SELECT MAX(id) FROM `address`)')->execute();
        }
        \Yii::$app->db->createCommand()->upsert('default_address', [
            'name' => $name, 
            'address_id' => $address['id']
        ])->execute();

        return $this->render('index', ['attrs' => $attrs]);    
    }

    public function actionSetdefault(array $attrs, $name){
        $address = \Yii::$app->db->createCommand('SELECT * FROM `default_address` WHERE `name` = "'.$name.'"')->queryOne();
        
        if($address == false)
            return $this->render('index', [
                'attrs' => $attrs, 
                'errorType' => 'alert-warning',
                'errorMsg' => "Couldn't find this name!"]);
        
        file_put_contents(Yii::getAlias('@frontend/web/defaultAddress.txt'), $address['address_id']);
        return $this->render('index', ['attrs' => $attrs]);
    }

    public function actionDelete(array $attrs, $name){
        $address = \Yii::$app->db->createCommand('SELECT * FROM `default_address` WHERE `name` = "'.$name.'"')->queryOne();
        
        if($address == false)
            return $this->render('index', [
                'attrs' => $attrs, 
                'errorType' => 'alert-warning',
                'errorMsg' => "Couldn't find this name!"]);
        
        \Yii::$app->db->createCommand()->delete('default_address', 'name = "'.$name.'"')->execute();
        return $this->render('index', ['attrs' => $attrs]);
    }
}