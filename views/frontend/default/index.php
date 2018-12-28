
<?php 
use kouosl\harita\widgets\WGoogleStaticMap;
use kouosl\harita\controllers\HaritaController;
use kouosl\harita\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Harita Modülü'; ?>

<?php Pjax::begin(['scrollTo' => false ]);?>
    <?= Html::a("Refresh", ['boyut', 'zoom' => ($zoom+1)], ['class' => 'btn btn-lg btn-primary']) ?>
    <?= WGoogleStaticMap::widget([
        'center'=>'Kocaeli Üniversitesi',
        'alt'=>"KOÜ Haritası",
        'zoom'=>$zoom,
        'width'=>500,
        'height'=>500,
        'apiKey'=>'GİZLİ',
        //'linkUrl'=>['location/view'],
        //'linkOptions'=>['target'=>'_blank'],
        //'imageOptions'=>['class'=>'map-image'],
    ]);?>
<?php Pjax::end(); ?>