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
        'types' => 'Типы форм',
    ],
    'component' => [
        'name' => 'Форма',
        'description' => 'Добавляет возможность создать простые формы',
        'properties' => [
            'rules' => 'Валидация'
        ],
    ],
    'controller' => [
        'list_title' => 'Список элементов',
        'updating' => 'Редактирование записи',
        'creating' => 'Создание записи',
        'previewing' => 'Просмотр записи',
    ],
    'buttons' => [
        'create' => ''
    ],
    'validator' => [
        'messages' => [
           'required' => 'Поле ":attribute" обязательно для заполнения.'
        ]
    ],
];
