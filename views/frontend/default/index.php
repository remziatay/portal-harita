
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



