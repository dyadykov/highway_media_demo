<?php


namespace api\modules\v1\controllers;


use common\models\WonderfulItem;
use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class WonderfulItemController extends ActiveController
{
    public $modelClass = WonderfulItem::class;

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                        'matchCallback' => function ($rule, $action) {
                            $condition = in_array(Yii::$app->request->getHeaders()['X-TESTAPI-TOKEN'], Yii::$app->params['tokens']);
                            if ($condition) {
                                return true;
                            }
                            return false;
                        },
                    ],
                ],
            ],
        ]);
    }
}
