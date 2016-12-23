<?php

namespace frontend\controllers;

use frontend\helpers\PathHelper;
use frontend\helpers\VideoHelper;
use frontend\models\DownloadedVideo;
use Yii;
use frontend\models\VideoPage;
use frontend\models\VideoPageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all VideoPage models.
     * @return mixed
     */
    public function actionIndexDownloaded()
    {
        $searchModel = new VideoPageSearch();
        $params = Yii::$app->request->queryParams;
        $params['VideoPageSearch']['is_downloaded'] = 'yes';
        $dataProvider = $searchModel->search($params);

        return $this->render('index-downloaded', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single VideoPage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $path = PathHelper::getVideoPathForVideoPage($model);

        $n = filesize($path);

        $n = $n / 1000000;

        return $this->render('view', [
            'model' => $this->findModel($id),
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

        $url = VideoHelper::getDownloadUrl($model);

        $out = shell_exec(' youtube-dl ' . $url);

        $downloadedVideo = new DownloadedVideo();
        $downloadedVideo->video_page_id = $id;
        $downloadedVideo->log = $out;

        $downloadedVideo->save();

        $model->is_downloaded = 'yes';
        $model->save();

        return $this->redirect(['view', 'id' => $model->video_page_id]);
    }

    public function actionOpen($id)
    {
        $model = $this->findModel($id);

        $path = PathHelper::getVideoPathForVideoPage($model);
        $path = PathHelper::prepareForShellExecuting($path);

        $out = shell_exec(' open  ' . $path);

        return $this->redirect(['view', 'id' => $model->video_page_id]);
    }

    public function actionDeleteVideoFile($id)
    {
        $model = $this->findModel($id);

        $path = PathHelper::getVideoPathForVideoPage($model);
        $path = PathHelper::prepareForShellExecuting($path);

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
