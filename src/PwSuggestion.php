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
