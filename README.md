Helpbundle
===========

```
HelpBundle used following bundles(see HelpBundle's composer.json):
1. FOSRestBundle
2. JMSDiExtraBundle
3. JMSSerializerBundle
4. NelmioApiDocBundle
5. StofDoctrineExtensionsBundle
6. StfalconTinymceBundle
```

```
HelpBundle used following modules to overwrite base template (see HelpBundle's layout.html.twig):
1. angular
2. ngResource
3. ngSanitize
4. ngAnimate
5. ngStrap
6. Bootstrap CSS
```

Add HelpBundle in your composer.json:

```js
{
    "require": {
        "yit/help-bundle": "dev-master",
    }
}
```

Now update composer.

Composer will install the bundle to your project's `vendor/yit` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Yit\HelpBundle\YitHelpBundle(),
    );
}
```

### Step 3: Configure the HelpBundle

Add the following configuration to your `config.yml` file

``` yaml
# app/config/config.yml
stfalcon_tinymce:
    include_jquery:       false
    tinymce_jquery:       false
    theme:
          # Simple theme: same as default theme
          simple:
               plugins:
                   - "advlist autolink lists link image charmap print preview hr anchor pagebreak"
                   - "searchreplace wordcount visualblocks visualchars code fullscreen"
                   - "insertdatetime media nonbreaking save table contextmenu directionality"
                   - "emoticons template paste textcolor"
               toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
               toolbar2: "print preview media | forecolor backcolor emoticons | stfalcon | example"
               image_advtab: true

stof_doctrine_extensions:
    default_locale: en_EN
    translation_fallback: false
    orm:
        default:
            sluggable: true
```

### Step 3.1: Configure the HelpBundle

If project don't have user authentication, add following configuration to your `config.yml` file

``` yaml
# app/config/config.yml
yit_help:
    secure: false
```

###Step 4: Import HelpBundle routing files

``` yaml
# app/config/routing.yml
yit_help:
    resource: "@YitHelpBundle/Controller/"
    type:     annotation
    prefix:   /

help_article_rest:
    type:     rest
    resource: Yit\HelpBundle\Controller\Rest\ArticleController

help_category_rest:
    type:     rest
    resource: Yit\HelpBundle\Controller\Rest\CategoryController
```
### Step 5: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema.


