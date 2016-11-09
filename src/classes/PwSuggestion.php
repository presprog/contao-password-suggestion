<?php

class PwSuggestion
{

    public function enhancePasswordWidget($buffer, Widget $widget)
    {
        if (TL_MODE != 'BE' || $widget->type !== 'password') {
            return $buffer;
        }

        // add assets
        if (Config::get('debugMode')) {
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/password-suggestion/assets/pws.js';
            $GLOBALS['TL_CSS'][] = 'system/modules/password-suggestion/assets/pws.css';
        } else {
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/password-suggestion/assets/pws.min.js';
            $GLOBALS['TL_CSS'][] = 'system/modules/password-suggestion/assets/pws.min.css';
        }

        // add wrapper class to first password field
        $buffer = preg_replace('/w50/', 'w50 pws-wrapper', $buffer, 1);

        // initialize PwSuggestion
        $buffer .= "
        <script>

            window.addEvent('domready', function() {
                var pws = new PwSuggestion({
                    charCount: " . $widget->minlength . ",
                    generateButtonLabel: '" . $GLOBALS['TL_LANG']['pws']['generateButtonLabel'] . "'
                });
                pws.init();
            });
        </script>";

        return $buffer;
    }

}
