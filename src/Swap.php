<?php

namespace app\gridSortColumnEnh;

use yii;
use yii\db\ActiveRecord;

class Swap extends yii\base\Action
{
    public $attribute;
    public $model;
    public $parentAttribute = null;

    public function run($id, $dir) {

        $dir = mb_strtolower($dir);
        if ($dir != 'up' && $dir != 'down') return;

        $model = $this->model->findOne($id);
        if ($model === null) return;

        $q = $this->model->find()
            ->orderBy('' . $this->attribute . ' ASC')
            ->where('' . $this->attribute . ($dir == 'up' ? ' < ' : ' > ') . $model->attributes[$this->attribute]);

        if ($this->parentAttribute !== null) {
            $modelParent = $model->attributes[$this->parentAttribute];
            $q->andWhere('' . $this->parentAttribute . ($modelParent === null ? ' is null' : ' = ' . $modelParent));
        }

        $model2 = $q->one();

        if ($model2 === null) return;

        $temp = $model->attributes[$this->attribute];
        $model->{$this->attribute} = $model2->{$this->attribute};
        $model2->{$this->attribute} = $temp;
        $model2->save(true, [$this->attribute]);
        $model->save(true, [$this->attribute]);
    }
}