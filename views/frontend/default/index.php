
<?php 
use kouosl\harita\widgets\Pjax;
use kouosl\harita\widgets\Map;

$this->title = 'Harita Modülü'; ?>

<div class="site-index">
    <?php
    Pjax::begin(['scrollTo' => false ]);
        echo Map::widget(['attrs' => $attrs]);
    Pjax::end();
    ?>
</div>



<<<<<<< HEAD
=======
<?php /*file_put_contents("sa.txt", "16");
$centerID = file_get_contents("sa.txt");
$users = \Yii::$app->db->createCommand('SELECT * FROM `address` WHERE `id` = '.$centerID)->queryOne();
var_dump($users);*/
//$attrs = ['center' => $center, 'zoom' => $zoom];
//echo document.getElementById("myText").value;
//echo Yii::$app->user->id;?>




<?php Pjax::begin(['scrollTo' => false ]);?>
    <?php Kutu::begin(['width' => 755, 'height' => 460]); ?>
        <div class="container-fluid">
            <div class="row">
            <?php ActiveForm::begin(['method' => 'get', 'action' => ['search'], 'options' => ['data-pjax' => true ]]); ?>
                <div class="form-row">
                    <div class="col-sm-2">
                    <label>Location:</label>
                    </div>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="center">
                    </div>
                    <div class="col-sm-4 pull-right">
                    <button type="submit" class="btn btn-primary btn-lg btn-success btn-block">Search</button>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?= WGoogleStaticMap::widget([
                        'center'=>$attrs['center'],
                        'alt'=>"KOU Map",
                        'zoom'=>$attrs['zoom'],
                        'width'=>500,
                        'height'=>400,
                        'apiKey'=>'GİZLİ'
                    ]);?>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <?= Html::a("+", ['zoomin', 'attrs' => $attrs], ['class' => 'btn btn-lg btn-primary btn-block']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::a("-", ['zoomout', 'attrs' => $attrs], ['class' => 'btn btn-lg btn-primary btn-block']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::a("Save Address", ['save', 'attrs' => $attrs], ['class' => 'btn btn-lg btn-success btn-block']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php Kutu::end(); ?>
<?php Pjax::end(); ?>
>>>>>>> cf02750ae61e6a81c707c2750909482c2c1ad49a
