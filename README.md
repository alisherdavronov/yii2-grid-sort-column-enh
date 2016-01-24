Bootstrap Grid Sort Column Enhanced Widget for Yii2
====================================
based on greshnik/yii2-grid-sort-column

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require alisherdavronov/yii2-grid-sort-column-enh "*"
```
or add

```json
"alisherdavronov/yii2-grid-sort-column-enh" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

***Example***

```
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'name',
        'class',

        ['class' => 'yii\grid\ActionColumn'],
        ['class' => 'app\gridSortColumnEnh\SortColumn'],
    ],
]); ?>
```  
***Example add sort action in controller***

```  
public function actions()
{
    return [
        'swap' => [
            'class' => 'app\gridSortColumnEnh\Swap',
            'model' => new Mark,
            'attribute' => 'sortAttribute',
        ]
    ];
}
```

***Example add behavior in model***

```
public function behaviors()
{
    return [
        'sort' => [
            'class' => 'app\gridSortColumnEnh\SortBehavior',
            'attribute' => 'sort',
            'parentAttribute' => 'parentId', // optional
        ]
    ];
}
```

License
-------

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.