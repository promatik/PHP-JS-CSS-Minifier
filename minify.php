<body style="font-family: monospace;">
<?php
    include_once 'minifier.php';

    /**
     * FILES ARRAYs
     * Keys as input, Values as output.
     */
    $js = [
        'js/main.js' => 'js/main.min.js',
        // ...
    ];

    $css = [
        'css/main.css' => 'css/main.min.css',
        // ...
    ];

    minifyJS($js);
    minifyCSS($css);
?>
</body>
