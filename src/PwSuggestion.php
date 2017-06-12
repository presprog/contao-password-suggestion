<?php

namespace PresProg\PwSuggestion;

class PwSuggestion
{

    public function enhancePasswordWidget($buffer, \Widget $widget)
    {
        if (TL_MODE != 'BE' || $widget->type !== 'password') {
            return $buffer;
        }

        // add wrapper class to first password field
        // add class for Contao 4
        $isC4 = ( ( (int) substr(VERSION, 0, 1) ) >= 4) ? true : false;
        $class = 'w50 pws-wrapper';
        $class .= ($isC4) ? ' c4' : ' c3';
        $buffer = preg_replace('/w50/', $class, $buffer, 1);

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
