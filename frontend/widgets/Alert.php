<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * \Yii::$app->getSession()->setFlash('error', 'This is the message');
 * \Yii::$app->getSession()->setFlash('success', 'This is the message');
 * \Yii::$app->getSession()->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * \Yii::$app->getSession()->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap4\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];

    /**
     * @var array the options for rendering the close button tag.
     */
    public $closeButton = [];

    public function init()
    {
        parent::init();

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $message) {
                    /* initialize css class for each alert box */
                    $this->options['class'] = $this->alertTypes[$type] . $appendCss;
                    $icon = '';
                    switch ($type) {
                        case 'success':
                            $icon = '<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="mdi mdi-check-all label-icon"></i><strong>Success</strong> - '.$message.'
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            break;
                        case 'warning':
                            $icon = '<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="mdi mdi-alert-outline label-icon"></i><strong>Warning</strong> - '.$message.'
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            break;
                        case 'danger':
                            $icon = '<div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="mdi mdi-block-helper label-icon"></i><strong>Danger</strong> - '.$message.'
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            break;
                        case 'info':
                            $icon = '<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
                                            <i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Info</strong> - '.$message.'
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            break;

                        default:
                            $icon = '';
                            break;
                    }
                    /* assign unique id to each alert box */
                    $this->options['id'] = $this->getId() . '-' . $type;

                    echo $icon;
                    /*echo \yii\bootstrap4\Alert::widget([
                        'body' => $icon.$message,
                        'closeButton' => $this->closeButton,
                        'options' => $this->options,
                    ]);*/
                }

                $session->removeFlash($type);
            }
        }
    }
}
