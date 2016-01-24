<?php

namespace app\gridSortColumnEnh;

use Yii;
use Closure;
use yii\grid\Column;
use yii\helpers\Html;
use yii\helpers\Url;

class SortColumn extends Column
{
    public $controller;
    public $urlCreator;
    public $view;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $script = '
        $(document).ready(function(){
            function hideFirstLast() {
                $(\'.sort-up, .sort-down\').show();
                $(\'.sort-up\').first().hide();
                $(\'.sort-down\').last().hide();
            }
            function refresh() {
                $(\'#' . $this->grid->id . '\').yiiGridView("applyFilter");
                hideFirstLast();
            }
            $(\'.sort-up\').on(\'click\', function(){
                var id = $(this).parent().parent().attr(\'data-key\');
                $.post("' . Url::toRoute(['swap']) . '?id="+id+"&dir=up").always(refresh);
                return false;
            });
            $(\'.sort-down\').on(\'click\' ,function(){
                var id = $(this).parent().parent().attr(\'data-key\');
                $.post("' . Url::toRoute(['swap']) . '?id="+id+"&dir=down").always(refresh);
                return false;
            });
            hideFirstLast();
        });';
        $this->grid->getView()->registerJs($script);
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return '<a href="" class="sort-up" data-id="'.$key.'"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
                <a href="" class="sort-down" data-id="'.$key.'"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>';
    }
}
