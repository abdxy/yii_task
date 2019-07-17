<?php

/* @var $dataProvider */

?>
<?=
\yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'email',
        'created_at',
        'birth_date',
        [
            'label' => 'gender',
            'value' => function($model){
                return $model->gender == 'm'?'male':'female';
            }
        ],
        [
            'label' => 'city',
            'value' => 'city.name'
        ],
        [
            'label' => 'country',
            'value' => 'country.name'
        ],
        [
            'label' => 'phones',
            'value' => function($model){
                $phones=[];
                foreach ($model->phones as $phone) {
                    $phones[] = $phone->number;
                }
                return implode(', ', $phones);
            }
        ]
    ],
]); ?>