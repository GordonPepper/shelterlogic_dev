<?php


 function autoload_79f56f642f1f4e1effd8f45e35025527($class)
{
    $classes = array(
        'Visual\NotationService\NotationService' => __DIR__ .'/NotationService.php',
        'Visual\NotationService\TestAddNotation' => __DIR__ .'/TestAddNotation.php',
        'Visual\NotationService\TestAddNotationResponse' => __DIR__ .'/TestAddNotationResponse.php',
        'Visual\NotationService\TestLoadNotation' => __DIR__ .'/TestLoadNotation.php',
        'Visual\NotationService\TestLoadNotationResponse' => __DIR__ .'/TestLoadNotationResponse.php',
        'Visual\NotationService\SampleNotation' => __DIR__ .'/SampleNotation.php',
        'Visual\NotationService\SampleNotationResponse' => __DIR__ .'/SampleNotationResponse.php',
        'Visual\NotationService\NotationData' => __DIR__ .'/NotationData.php',
        'Visual\NotationService\AddNotation2' => __DIR__ .'/AddNotation2.php',
        'Visual\NotationService\AddNotation2Response' => __DIR__ .'/AddNotation2Response.php',
        'Visual\NotationService\LoadNotation2' => __DIR__ .'/LoadNotation2.php',
        'Visual\NotationService\LoadNotation2Response' => __DIR__ .'/LoadNotation2Response.php',
        'Visual\NotationService\LoadNotation' => __DIR__ .'/LoadNotation.php',
        'Visual\NotationService\LoadNotationResponse' => __DIR__ .'/LoadNotationResponse.php',
        'Visual\NotationService\Header' => __DIR__ .'/Header.php',
        'Visual\NotationService\AddNotation' => __DIR__ .'/AddNotation.php',
        'Visual\NotationService\AddNotationResponse' => __DIR__ .'/AddNotationResponse.php',
        'Visual\NotationService\CurrentVersion' => __DIR__ .'/CurrentVersion.php',
        'Visual\NotationService\CurrentVersionResponse' => __DIR__ .'/CurrentVersionResponse.php',
        'Visual\NotationService\LoginCreds' => __DIR__ .'/LoginCreds.php',
        'Visual\NotationService\LoginCredsResponse' => __DIR__ .'/LoginCredsResponse.php',
        'Visual\NotationService\NextNumberGenAppenditure' => __DIR__ .'/NextNumberGenAppenditure.php',
        'Visual\NotationService\NextNumberGenAppenditureResponse' => __DIR__ .'/NextNumberGenAppenditureResponse.php',
        'Visual\NotationService\UserPermission' => __DIR__ .'/UserPermission.php',
        'Visual\NotationService\UserPermissionResponse' => __DIR__ .'/UserPermissionResponse.php',
        'Visual\NotationService\UserPermissionEnum' => __DIR__ .'/UserPermissionEnum.php',
        'Visual\NotationService\NextNumberGen2' => __DIR__ .'/NextNumberGen2.php',
        'Visual\NotationService\NextNumberGen2Response' => __DIR__ .'/NextNumberGen2Response.php',
        'Visual\NotationService\InstallSchemaDatabaseLogMessage' => __DIR__ .'/InstallSchemaDatabaseLogMessage.php',
        'Visual\NotationService\InstallSchemaDatabaseLogMessageResponse' => __DIR__ .'/InstallSchemaDatabaseLogMessageResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_79f56f642f1f4e1effd8f45e35025527');

// Do nothing. The rest is just leftovers from the code generation.
{
}
