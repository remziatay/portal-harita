<?php

// @author Alex Muir
// @yii2-bootstrap implementor Remzi Atay

namespace kouosl\harita\widgets;

use \yii\web\HttpException;
use kouosl\harita\helpers\Html;

class WGoogleStaticMap extends \yii\bootstrap\Widget {

	public $imageOptions;
	public $alt = 'Harita';
	public $center = null;
	public $zoom = null;
	public $sensor = 'false';
	public $width = null;
	public $height = null;
	public $markers = array();
	public $apiKey = null;
	private $_baseUrl = 'http://maps.google.com/maps/api/staticmap?';

	public function init()
	{
		parent::init();
		if (is_null($this->center))
			throw new HttpException('Konum yok!');

		if (is_null($this->width) || is_null($this->height))
			throw new HttpException('Boyut yok!');

		if (is_null($this->apiKey))
		throw new HttpException('Key yok!');
	}

	public function run()
	{
		$url = $this->createImageUrl();
		
		$this->imageOptions['width'] = $this->width;
		$this->imageOptions['height'] = $this->height;

		echo Html::img($url,['alt'=>$this->alt,$this->imageOptions]);
		
	}

	public function createImageUrl ()
	{
		$url = $this->_baseUrl;
		$url .= 'center='.urlencode($this->center);
		$url .= "&size={$this->width}x{$this->height}";

		$url .= $this->resolveMarkers();

		if (!is_null($this->zoom))
			$url .= '&zoom='.$this->zoom;

		$url .= '&sensor='.(string)$this->sensor;
		$url .= '&key='.$this->apiKey;
		return $url;
	}

	public function resolveMarkers()
	{
		$url = '';

		foreach ($this->markers as $marker)
		{
			$markerUrl = '';
			if (isset($marker['style']))
			{
				foreach ($marker['style'] as $style=>$value)
				{
					$markerUrl .= $style.':'.$value.'|';
				}
			}

			foreach ($marker['locations'] as $location)
			{
				$markerUrl .= urlencode($location).'|';
			}

			$markerUrl = rtrim($markerUrl,'|');
			$url .= '&markers='.$markerUrl;
		}
		
		return $url;
	}
}
?>
