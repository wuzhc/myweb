<?php

namespace common\service;

use Yii;
use yii\base\Exception;

class AbstractService {

	private static $_models = array();

	public function __construct()
	{
 		if (YII_DEBUG) {
 			$createFromFactory =false;
			$trace = debug_backtrace ();
			foreach ($trace as $item ) {
				if($item['function'] == 'factory'){
					$createFromFactory = true;
					break;
				}
			}
			if (!$createFromFactory) {
				throw new Exception('务必从factory创建Service对象,不要直接');
				Yii::$app->end();
			}
 		}

	}

	/**
	 * Returns the static model.
	 * @param string $className service class name.
	 * @return $className the static model class
	 */
	public static function factory($className = __CLASS__)
	{
		if (isset (self::$_models [$className])) {
			return self::$_models [$className];
		} else {
			$model = self::$_models [$className] = new $className ( null );
			return $model;
		}
	}

}