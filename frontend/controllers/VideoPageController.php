<?php

namespace frontend\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\DownloadQueue;
use frontend\models\VideoPage;
use frontend\models\VideoPageSearch;

use frontend\helpers\PathHelper;
use frontend\helpers\SiteHelper;
/**
 * VideoPageController implements the CRUD actions for VideoPage model.
 */
class VideoPageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VideoPage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoPageSearch();
        $params = Yii::$app->request->queryParams;
        $page = '';

        if (Yii::$app->request->get('pageName')) {
            $page = Yii::$app->request->get('pageName');
        }

        SiteHelper::setSearchParams($page, $params);
        $title = SiteHelper::getTitleByPage($page);
        $showFileSize = SiteHelper::isShowFileSizeColumn($page);
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
            'showFileSize' => $showFileSize,
        ]);
    }

    /**
     * Displays a single VideoPage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'video-page';
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new VideoPage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VideoPage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->video_page_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VideoPage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->video_page_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDownload($id)
    {
        $model = $this->findModel($id);

        $downloadQueue = new DownloadQueue();
        $downloadQueue->download_status = 'download_now';
        $downloadQueue->video_page_id = $id;
        $downloadQueue->save();

        return $this->redirect(['view', 'id' => $model->video_page_id]);
    }

    public function actionOpen($id)
    {
        $model = $this->findModel($id);

        $path = PathHelper::getVideoPathForVideoPage($model);

        shell_exec(' open  ' . $path);

        return $this->redirect(['view', 'id' => $model->video_page_id]);
    }

    public function actionRateVideo()
    {
        $getRandom = true;
        $model = null;
        if (Yii::$app->request->get('id') && Yii::$app->request->get('status')) {
            $model = VideoPage::findOne(Yii::$app->request->get('id'));
            $status = Yii::$app->request->get('status');

            if ($status == 'hide') {
                $model->is_hidden = 'yes';
            } else {
                $model->like_status = $status;
            }
            $model->save();

        } else if (Yii::$app->request->get('id')) {
            $model = VideoPage::findOne(Yii::$app->request->get('id'));
            $getRandom = false;
        }

        if ($getRandom) {
            $allWithoutEstimation = VideoPage::find()
                ->select(['video_page_id'])
                ->where(['like_status' => 'pending'])
                ->asArray()
                ->all();

            $randomNumber = array_rand($allWithoutEstimation);
            $randomId = $allWithoutEstimation[$randomNumber]['video_page_id'];

            $model = $this->findModel($randomId);
        }

        return $this->render('rate-video', ['model' => $model]);
    }
    
    public function actionDeleteVideoFile($id)
    {
        $model = $this->findModel($id);

        $path = PathHelper::getVideoPathForVideoPage($model);

        $out = shell_exec(' rm  ' . $path);

        $model->is_downloaded = 'no';
        $model->save();

        return $this->redirect(['view', 'id' => $model->video_page_id]);
    }

    /**
     * Deletes an existing VideoPage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VideoPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VideoPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VideoPage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
