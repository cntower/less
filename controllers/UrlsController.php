<?php

namespace app\controllers;

use Yii;
use app\models\Urls;
use app\models\UrlsSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UrlsController.
 */
class UrlsController extends Controller
{
    public $jsFile;
/*
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
*/
    /**
     *Главное действие, получая на входе идентификатор ищет в БД соответствующую ссылку
     * и пересылает к ней, иначе выводит форму
     * @param $word
     * @return mixed
     */
    public function actionIndex($word = "")
    {
        if($word != ""){
            $id = $this->wordToNum($word);
            if (($model = Urls::findOne($id)) !== null) {
                $goal = $model->locator;
                //переход к адресу из базы
                return $this->redirect($goal, 302);
            } else {
                //если такого идентификатора нет очистим адресную строку от параметра
                return $this->redirect('/', 302) ;
            }
        }
        return $this->render('index');
    }

    /**
     * Инициализация приложения
     * публикует и регистрирует JS file
     */
    public function init() {
    		parent::init();

    		$this->jsFile = '@app/views/' . $this->id . '/ajax.js';

    		// Publish and register the required JS file
    		Yii::$app->assetManager->publish($this->jsFile);
    		$this->getView()->registerJsFile(
        			Yii::$app->assetManager->getPublishedUrl($this->jsFile),
 			['yii\web\YiiAsset'] // depends
    		);
 	}

    /**
     * Переводит число в десятичном представлении (основание 10)
     * в число с основанием 50
     * @param $dec
     * @return array
     */
    protected function tenToFifty($dec){
        if ($dec == 0){
            return [0];
        }
        $res = [];
        while($dec>0){
            $n1 = floor($dec/50);
            array_unshift($res, $dec % 50);
            $dec = $n1;
        }
        return $res;
    }

    /**
     * Кодирование. Дает каждому элементу массива со значением 0-49
     * в выходную строку символ представитель из лат. алфавита
     * @param array $arr
     * @return string
     */
    protected function arrToWord($arr = array()){
        $res = "";
        foreach($arr as $value){
            if($value < 25){
                $res .=chr(65 + $value);
            }else{
                $res .=chr(97 + $value - 25);
            }
        }
        return $res;
    }

    /**
     * Декодирование. Вычисление суммы в десятиченой системе.
     * @param $str
     * @return int
     */
    protected function wordToNum($str){
        //$res = [];
        $sum = 0;
        for($i=0;$i<strlen($str);$i++){
            $o = ord($str[$i]);
            if ($o<97){
                $n = $o-65;
            }else{
                $n = $o-97+25;
            }
            //$res[] = $n;
            $sum = $sum*50+$n;
        }
        return $sum;
    }

    /**
     * Сохранение в БД переданной ссылки,
     * возврат текстового представления ее идентификатора в БД
     * @return array|null
     */
    public function actionLinkForm() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $searchModel = new UrlsSearch();
            $locator = $_POST['locator'];
            $dataProvider = $searchModel->searchLocator($locator);
            $res = null;
            if($dataProvider->getCount()==0){
                $model = new Urls();
                $model->locator = $locator;
                if ($model->save()){
                    $num = $model->primaryKey;
                    $w = $this->arrToWord($this->tenToFifty($num));
                    $res = array(
                        'body'    => 'http://less.ru/' . $w,
                        'success' => true,
                    );
                }
            }else{
                $w = $this->arrToWord($this->tenToFifty($dataProvider->getKeys()[0]));
                $res = array(
                    'body'    => 'http://less.ru/' . $w,
                    'success' => true,
                );
            }

            return $res;
        }
    }


}
