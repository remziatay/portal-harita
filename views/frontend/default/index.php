
<?php 
use kouosl\harita\widgets\WGoogleStaticMap;


$this->title = 'Modül çalışıyor.'; ?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Kou Osl Yii2 App</h1>

        <p class="lead">Örnek uygulamayı başarılı bir şekilde çalıştırdınız.</p>

        <p><a class="btn btn-lg btn-success" href="#">Modüller ve konfürgasyon!</a></p>
    </div>
</div>

<?= WGoogleStaticMap::widget([
    'center'=>'Kocaeli Üniversitesi',
    'alt'=>"KOÜ Haritası",
    'zoom'=>16,
    'width'=>500,
    'height'=>500,
    'apiKey'=>'GİZLİ',
    //'linkUrl'=>['location/view'],
    //'linkOptions'=>['target'=>'_blank'],
    //'imageOptions'=>['class'=>'map-image'],
]);?>