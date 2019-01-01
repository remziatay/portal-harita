<?php

$address = \Yii::$app->db->createCommand('SELECT * FROM `last_address` 
    WHERE `user_id` = ' . Yii::$app->user->id)->queryOne();

if($address == false && @file_get_contents("defaultAddress.txt") != false){  
    $centerID = file_get_contents("defaultAddress.txt");
    $address = \Yii::$app->db->createCommand('SELECT * FROM `address` WHERE `id` = '.$centerID)
        ->queryOne();
}
if ($address == false) {
    $address['address'] = "Kocaeli Üniversitesi";
    $address['zoom'] = 16;
}

echo $this->render('index', [
    'attrs' => [
        'center' => $address['address'],
        'zoom' => $address['zoom'],
        'width' => 500,
        'height' => 400
        ]
    ]);
