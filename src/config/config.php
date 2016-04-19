<?php

if (TL_MODE == 'BE' && (
        \Input::get('do') == 'user' ||
        \Input::get('do') == 'member' ||
        \Input::get('do') == 'login'
)) {
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/password-suggestion/assets/pws.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/password-suggestion/assets/pws.css';
}
