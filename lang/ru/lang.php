<?php return [
    'plugin' => [
        'name' => 'Формы',
        'description' => 'Плагин добавляет создание простых форм для сайта'
    ],
    'fields' => [
        'name' => 'Название',
        'code' => 'Код',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления',
    ],
    'menu' => [
        'forms' => 'Формы',
        'results' => 'Заявки',
    ],
    'component' => [
        'name' => 'Форма',
        'description' => 'Добавляет возможность создать простые формы',
        'properties' => [
            'rules' => 'Валидация'
        ],
    ],
    'component_properties' => [
        'rules_title' => 'Список полей',
        'rules_group' => 'Валидация',
        'attributes_title' => 'Список полей',
        'attributes_group' => 'Атрибуты',
    ],
    'validator' => [
        'messages' => [
           'required' => 'Поле ":attribute" обязательно для заполнения.'
        ]
    ],
];
