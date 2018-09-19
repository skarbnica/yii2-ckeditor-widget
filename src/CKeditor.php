<?php
/**
 * @copyright Copyright (c) 2013-2016 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace skarbnica\ckeditor;

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\InputWidget;


class CKEditor extends InputWidget
{

    /**
     * @var array the options for the CKEditor 4 JS plugin.
     * Please refer to the CKEditor 4 plugin Web page for possible options.
     * @see http://docs.ckeditor.com/#!/guide/dev_installation
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerPlugin();
    }

    /**
     * Registers CKEditor plugin
     * @codeCoverageIgnore
     */
    protected function registerPlugin()
    {
        $view = $this->getView();
        assets\CKEditorWidgetAsset::register($view);

        $js[] = <<<JS
$(document).off('click', '.cke_dialog_tabs a[id^="cke_Upload_"]').on('click', '.cke_dialog_tabs a[id^="cke_Upload_"]', function () {
                var forms = $('.cke_dialog_ui_input_file iframe').contents().find('form');
                var csrfName = yii.getCsrfParam();
                forms.each(function () {
                    if (!$(this).find('input[name=' + csrfName + ']').length) {
                        var csrfTokenInput = $('<input/>').attr({
                            'type': 'hidden',
                            'name': csrfName
                        }).val(yii.getCsrfToken());
                        $(this).append(csrfTokenInput);
                    }
                });
            });
JS;

        if ($this->clientOptions['filebrowserUploadUrl'])
            $view->registerJs("filebrowserUploadUrl = '{$this->clientOptions['filebrowserUploadUrl']}';",View::POS_BEGIN);
        $view->registerJs(implode("\n", $js),View::POS_END);


    }
}
