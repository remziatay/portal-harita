<?php

namespace kouosl\harita\widgets;
use kouosl\harita\helpers\Html;

class Kutu extends \yii\bootstrap\Widget
{

    public $width;
    public $height;

    public function init()
    {
        parent::init();
        $opt = 'width: ' . $this->width . 'px; height: ' . $this->height . 'px; border: 2px solid gray;
        border-radius: 8px; padding-top: 3px; padding-bottom: 3px';
        Html::addCssStyle($this->options, $opt);
        echo Html::beginTag('div', $this->options);
    }

    public function run()
    {
        echo Html::endTag('div');
    }
}