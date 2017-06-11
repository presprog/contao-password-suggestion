<?php

$GLOBALS['TL_HOOKS']['parseWidget'][] = [
    'PresProg\PwSuggestion\PwSuggestion', 'enhancePasswordWidget'
];

// add assets
if (TL_MODE == 'BE') {
    $fileName = 'pws';
    if (!\Config::get('debugMode')) {
        $fileName .= '.min';
    }
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/password-suggestion/assets/' . $fileName . '.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/password-suggestion/assets/' . $fileName . '.css';
}
