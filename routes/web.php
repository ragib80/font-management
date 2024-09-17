<?php

return [

    'dashboard' => ['controller' => 'DashboardController', 'action' => 'index'],

    'fonts/upload' => ['controller' => 'FontController', 'action' => 'upload'],
    'fonts/list' => ['controller' => 'FontController', 'action' => 'list'],
    'fonts/delete' => ['controller' => 'FontController', 'action' => 'delete'],
    'get-fonts' => ['controller' => 'FontController', 'action' => 'getAllFonts'],


    'font-groups/create' => ['controller' => 'FontGroupController', 'action' => 'create'],
    'font-groups/list' => ['controller' => 'FontGroupController', 'action' => 'list'],
    'font-groups/edit' => ['controller' => 'FontGroupController', 'action' => 'edit'],
    'font-groups/update' => ['controller' => 'FontGroupController', 'action' => 'update'],
    'font-groups/delete' => ['controller' => 'FontGroupController', 'action' => 'delete'],
];
