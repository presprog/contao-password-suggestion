var PwSuggestion = (function () {
    "use strict";

    function PwSuggestion(options) {
        // default options
        this.options = {
            charCount: 16,
            chars: 'abcdefghijklmnopqrstuvwxyz' +
                'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
                '0123456789' +
                '!§$%&/=?',
            generateButtonLabel: 'Generate'
        };

        // user defined options
        for (var i in options) {
          this.options[i] = options[i];
        }
    }

    PwSuggestion.prototype.init = function() {
        this.passwordField = document.getElementById('ctrl_password');
        this.confirmField = document.getElementById('ctrl_password_confirm');

        this.generateButton = document.createElement('button');
        this.generateButton.setAttribute('id', 'js-pws-generate');
        this.generateButton.setAttribute('class', 'pws-btn pws-btn--generate');
        this.generateButton.innerHTML =  this.options.generateButtonLabel;
        this.generateButton.inject(this.passwordField, 'after');

        this.copyButton = document.createElement('button');
        this.copyButton.setAttribute('id', 'js-pws-copy');
        this.copyButton.setAttribute('class', 'pws-btn pws-btn--copy is-hidden');
        this.copyButton.inject(this.generateButton, 'after');

        this.generateButton.addEventListener('click', (function(e) {
            e.preventDefault();
            this._generateButtonClick();
        }).bind(this));

        this.copyButton.addEventListener('click', (function(e) {
            e.preventDefault();
            this._copyButtonClick();
        }).bind(this));

    };

    PwSuggestion.prototype._copyButtonClick = function(e) {
        try {
            this.passwordField.select();
            document.execCommand('copy');
        } catch(err) {}

        this.copyButton.classList.add('is-hidden');
    };

    PwSuggestion.prototype._generateButtonClick = function(e) {
        var suggestion = _pwRandomString(this.options.charCount, this.options.chars);

        this.passwordField.setAttribute('type', 'text');
        this.confirmField.setAttribute('type', 'text');

        this.passwordField.setAttribute('value', suggestion);
        this.confirmField.setAttribute('value', suggestion);

        this.copyButton.classList.remove('is-hidden');
    };

    var _pwRandomString = function(len, chars) {
        var str = '';
        for(var i = 0; i <= len; i++) {
            var pointer = Math.floor(Math.random() * chars.length);
            str += chars[pointer];
        }
        return str;
    };

    return PwSuggestion;

})();
