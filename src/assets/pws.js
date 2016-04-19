var PwSuggestion = (function() {

    function PwSuggestion(charCount, chars) {
        this.charCount = charCount || 16;
        this.chars = chars;
    }

    PwSuggestion.prototype.init = function() {

        this.passwordField = document.getElementById('ctrl_password');
        this.confirmField = document.getElementById('ctrl_password_confirm');
        this.toggleButton = document.getElementById('js-pw-new-suggestion');

        var that = this;

        this.toggleButton.addEvent('click', function(e) {

            e.preventDefault();

            var suggestion = PwRandomString(that.charCount, that.chars);

            that.passwordField.setAttribute('type', 'text');
            that.confirmField.setAttribute('type', 'text');

            that.passwordField.setAttribute('value', suggestion);
            that.confirmField.setAttribute('value', suggestion);

        });

    };

    return PwSuggestion;

})();


var PwRandomString = (function() {
    return function(len, chars) {
        var str = '';
        for(var i = 0; i <= len; i++) {
            var pointer = Math.floor(Math.random() * chars.length);
            str += chars[pointer];
        }
        return str;
    }
})();

