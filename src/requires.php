<?php

$filesToRequire = [

// Models
    '/models/model-validation-base.php',
    '/models/user-model.php',
// Repositories   
    '/repositories/repository-base.php',
    '/repositories/user-repository.php',
// Services    
    '/services/user-service.php',
// Routes   
    '/routes/pages-route.php',
    '/routes/users-route.php'
];

foreach($filesToRequire as $file) {
    require __DIR__ . $file;
}