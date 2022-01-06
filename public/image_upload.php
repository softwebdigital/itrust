<?php

// Include the editor SDK.
//require 'PATH_TO_FROALA_SDK/lib/froala_editor.php';
require 'vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php';

// Store the image.
try {
    $options = array(
        'resize' => array(
            // Width.
            'columns' => 300,

            // Height.
            'rows' => 300,

            // Keep aspect ratio.
            'bestfit' => true
        )
    );
    $response = FroalaEditor_Image::upload('/uploads/', $options);
    echo stripslashes(json_encode($response));
}
catch (Exception $e) {
    http_response_code(404);
}
