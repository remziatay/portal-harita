<?php 
use kouosl\harita\widgets\Pjax;
use kouosl\harita\widgets\Admin;
use yii\bootstrap\Alert;

$this->title = 'Admin Paneli';?>

<div class="site-index">
    <?php 
    Pjax::begin(['scrollTo' => false ]);
        if(isset($errorMsg) && isset($errorType))
            echo Alert::widget([
                'options' => ['class' => $errorType,],
                'body' => $errorMsg
                ]);
        echo Admin::widget(['attrs' => $attrs]);
    Pjax::end(); 
    ?>
</div>

