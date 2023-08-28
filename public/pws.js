const PasswordSuggestion = (function () {
    function PasswordSuggestion(options) {
        this.options = {
            characters:          options.characters,
            passwordLength:      options.passwordLength,
            generateButtonLabel: options.generateButtonLabel,
        }
    }

    PasswordSuggestion.prototype.init = function () {
        this.passwordField = document.getElementById('ctrl_password')
        this.toggle = document.getElementById('pw_password')

        this.generateButton = document.createElement('button')
        this.generateButton.setAttribute('id', 'js-pws-button')
        this.generateButton.setAttribute('class', 'pws-button')
        this.generateButton.innerHTML = this.options.generateButtonLabel
        this.generateButton.inject(this.passwordField, 'after')

        this.generateButton.addEventListener('click', onGenerateClick.bind(this))
    }

    PasswordSuggestion.prototype.generatePassword = function (e) {
        const suggestion = getRandomString(this.options.passwordLength, this.options.characters)
        this.passwordField.setAttribute('value', suggestion)
    }

    const onGenerateClick = function (e) {
        e.preventDefault()
        this.generatePassword()

        if (this.toggle.getAttribute('src').includes('visible.svg')) {
            this.toggle.click()
        }

        this.passwordField.select()

        if (window.navigator.clipboard) {
            window.navigator.clipboard.writeText(this.passwordField.value)
        }
    }

    const getRandomString = function (length, characters) {
        let str = ''
        for (let i = 0; i <= length; i++) {
            const pointer = Math.floor(Math.random() * characters.length)
            str += characters[pointer]
        }
        return str
    }

    return PasswordSuggestion
})()
