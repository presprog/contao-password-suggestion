# Contao Password Suggestion

This extension adds an one click password generator to the Contao Open Source CMS backend. It enhances the password widget in the user and member module as well as the personal data module. The next time you add a user or member you can simply generate a random password. Supports Contao 3.5 LTS and 4.4 LTS.

![Short demo of the Contao Password Suggestion](demo.gif)

```
## Install ##
With Contao 3 you only need to install this extension via Composer: 

```bash

composer require presprog/contao-password-suggestion

```

If you are running Contao 4, you have to register this extension in the AppKernel and manually trigger a cache warmup afterwards:

```php

file: /AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // (...),
            new ContaoModuleBundle('password-suggestion', $this->getRootDir()),
        ]
    }
    // (...)
}

```

```bash

php bin/console cache:warmup

```

## Config ##
This extensions respects the minimum password length defined in the configuration array (Contao sets a minimum of 8 characters). You may overwrite it in your localconfig.php:

```php

// localconfig.php
$GLOBALS['TL_CONFIG']['minPasswordLength'] = 16;
