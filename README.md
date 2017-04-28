# Plugin for wallabag: Try to guess creation date by using carbon date

This bundle allows you to try to guess the creation date of an article by using carbon date (http://carbondate.cs.odu.edu).

## Requirements

* wallabag >= 2.2.2

## Installation

### Download the bundle

```
composer require nicosomb/wallabag-carbondate-bundle
```

### Enable the bundle

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Nicosomb\WallabagCarbondateBundle\NicosombWallabagCarbondateBundle(),
        );

        // ...
    }

    // ...
}
```

### Configure your application

```yml
# app/config/config.yml

nicosomb_wallabag_carbondate:
    url: http://carbondate.cs.odu.edu
    enabled: true
```
