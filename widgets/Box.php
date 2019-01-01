<?php

namespace kouosl\harita\widgets;
use kouosl\harita\helpers\Html;

class Box extends \yii\bootstrap\Widget
{

    public $attrs = array();

    public function init()
    {
        parent::init();
        $opt = 'border: 2px solid gray; border-radius: 8px; padding-top: 3px; padding-bottom: 3px; margin-bottom: 2px; ';
        if(isset($this->attrs['width']))
            $opt .= 'width: ' . $this->attrs['width'] . 'px; ';
        if(isset($this->attrs['height']))
            $opt .= 'height: ' . $this->attrs['height'] . 'px; ';
        if(isset($this->attrs['max-height']))
            $opt .= 'max-height: ' . $this->attrs['max-height'] . 'px; ';
        if(isset($this->attrs['block']) && $this->attrs['block'] == true)
            $opt .= 'display: block; overflow: auto; ';
            
        Html::addCssStyle($this->options, $opt);
        echo Html::beginTag('div', $this->options);
    }

    public function run()
    {
        echo Html::endTag('div');
    }
}