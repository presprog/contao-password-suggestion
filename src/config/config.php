<?php

$GLOBALS['TL_HOOKS']['parseWidget'][] = [
    'PwSuggestion', 'enhancePasswordWidget'
];

// add assets
if (TL_MODE == 'BE') {
    if (Config::get('debugMode')) {
        $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/password-suggestion/assets/pws.js';
        $GLOBALS['TL_CSS'][] = 'system/modules/password-suggestion/assets/pws.css';
    } else {
        $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/password-suggestion/assets/pws.min.js';
        $GLOBALS['TL_CSS'][] = 'system/modules/password-suggestion/assets/pws.min.css';
    }
}
