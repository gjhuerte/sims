<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('public\rendering-engine\wkhtmltopdf\bin\wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => array(
            // 'margin-right' => 3,
            // 'margin-left' => 3,
            // 'margin-bottom' => 3,
            'footer-center' => 'Page [page] of [toPage]',
            'footer-font-size' => 3,
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('public\rendering-engine\wkhtmltopdf\bin\wkhtmltoimage.exe'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
