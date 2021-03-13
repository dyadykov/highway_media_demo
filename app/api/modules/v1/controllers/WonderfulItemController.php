<?php


namespace api\modules\v1\controllers;


use common\models\WonderfulItem;
use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\web\HttpException;

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
                            $headers = Yii::$app->request->getHeaders();
                            if (!$headers['X-TESTAPI-TOKEN']) {
                                throw new HttpException(403, 'Отсутствует токен X-TESTAPI-TOKEN');
                            }

                            $xTestApiToken = $headers['X-TESTAPI-TOKEN'];
                            $tokens = Yii::$app->params['tokens'];

                            if (!in_array($xTestApiToken, $tokens)) {
                                throw new HttpException(403, 'Неправильный токен X-TESTAPI-TOKEN');
                            }
                            return true;
                        },
                    ],
                ],
            ],
        ]);
    }
}
