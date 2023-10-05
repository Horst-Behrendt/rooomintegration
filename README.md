# OXID eShop Module Template

[![Development](https://github.com/OXID-eSales/module-template/actions/workflows/trigger.yml/badge.svg?branch=b-7.0.x)](https://github.com/OXID-eSales/module-template/actions/workflows/trigger.yml)
[![Latest Version](https://img.shields.io/packagist/v/OXID-eSales/module-template?logo=composer&label=latest&include_prereleases&color=orange)](https://packagist.org/packages/oxid-esales/module-template)
[![PHP Version](https://img.shields.io/packagist/php-v/oxid-esales/module-template)](https://github.com/oxid-esales/module-template)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=OXID-eSales_module-template&metric=alert_status)](https://sonarcloud.io/dashboard?id=OXID-eSales_module-template)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=OXID-eSales_module-template&metric=coverage)](https://sonarcloud.io/dashboard?id=OXID-eSales_module-template)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=OXID-eSales_module-template&metric=sqale_index)](https://sonarcloud.io/dashboard?id=OXID-eSales_module-template)


This module template extends OXID eShop core functionality so that Rooom 3D Objekt can be displayed together with articles.

The module template contains the common use case like OXID suggests it could be implemented. 

This module also comes with all the quality tools OXID recommends to use.

## Branch compatibility
* b-7.0.x branch is compatible with OXID eShop compilation b-7.0.x

## Installation
### Install 

This module is in working state and can be directly installed via composer:
```
 composer require r3d/rooomintegrationmodule
```

and [activate the module](https://docs.oxid-esales.com/developer/en/7.0/development/modules_components_themes/module/installation_setup/setup.html#setup-activation).



Before starting to do something, please, read the whole section once, then decide on required questions, decide 
what you want to achieve, and follow the procedure.



**NOTE:** From OXID eShop 7.0 on, module code will no longer be duplicated into source/modules directory. This means that after normal composer install
your module code will only be located in the vendor directory. Still we suggest that for development, you git clone your module into
the shop's source/modules folder, register this path as local repository and then composer install your module using symlink.

* In the procedure, we will use our best practices on [module installation for development](https://docs.oxid-esales.com/developer/en/7.0/development/modules_components_themes/module/tutorials/module_setup.html)
  to make your development process as smooth and easy as possible.

#### Procedure

The following procedure describes how to create a base for your further module, and shows the basic 
installation for development process:



1. Clone this repository to your local shop modules directory:
   ```
   cd <shopRoot>
   git clone <thisGithubRepositoryUrl> source/modules/r3d/rooomintegrationmodule --branch=b-7.0.x
   ```

2. At this point you have a working module as a starting point to implement whatever you 
   want to extend in your OXID eShop. Initialize and activate the module:
   ```
   cd <shopRoot>
   bin/oe-console oe:module:install source/modules/r3d/rooomintegrationmodule
   bin/oe-console oe:module:activate r3d_rooomintegrationmodule 
   ```


## Idea

OXID eSales would like to provide a lightweight reusable example module incorporating 
our best practices recommendations to be used as a template for developing own module solutions.

Story: 
- Module will extend a block on shop start page to show a greeting message (visible when module is active).
- Module will have a setting to switch between generic greeting message for a logged in user and a personal custom greeting. The Admin's choice which way it will be.
- A logged in user will be able to set a custom greeting depending on module setting. Press the button on start page and be redirected to a module controller which handles the input.
- User custom greetings are saved via shop model save method. We subscribe to BeforeModelUpdate to track how often a user changed his personal greeting.
- Tracking of this information will be done in a new database table to serve as an example for module's own shop model.

### Extend shop functionality

#### Sometimes we just need to extend what the shop is already offering us:
* extending a shop model (`OxidEsales\ModuleTemplate\Model\User`)
* extending a shop controller (`OxidEsales\ModuleTemplate\Controller\StartController`)
* extending a shop database table (`oxuser`)
* extending a shop template block (`start_welcome_text`)

**HINT**: only extend the shop core if there is no other way like listen and handle shop events,
extend/replace some DI service. Your module might be one of many in the class chain and you should 
act accordingly (always ensure to call the parent method and return the result). When extending
shop classes with additional methods, best prefix those methods in order not to end up with another 
module picking the same method name and wreacking havoc.
In case there is no other way than to extend existing shop methods try the minimal invasion principle. 
Put module business logic to a service (which make it easier to test as well) and call the service in the extended shop class.
If you need to extend the shop class chain by overwriting, try to stick to the public methods.




## Things to be aware of

The module template is intended to act as a tutorial module so keep your eyes open for comments in the code.

**NOTES:** 
* Acceptance tests are way easier to write if you put an id on relevant fields and buttons in the templates. 
* If you can, try to develop on OXID eShop Enterprise Edition to get shop aware stuff right from the start.

### Module migrations

* migrations are intended to bump the database (and eventual existing data) to a new module version (this also goes for first time installation).
* ensure migrations are stable against rerun

Migrations have to be run via console command (`./vendor/bin/oe-console` if shop was installed from metapackage, `./bin/oe-console` otherwise)

```bash
./vendor/bin/oe-eshop-db_migrate migrations:migrate 
```
 and activate the database changes by 

```bash
./vendor/bin/oe-eshop-db_views_generate 
```

For more information, check the [developer documentation](https://docs.oxid-esales.com/developer/en/latest/development/tell_me_about/migrations.html).


### in Source composer.json
Add the following snippets at the respective places

```bash
   "require": {
   ...
       "r3d/rooomintegrationmodule": "*"
        }
    },
    "autoload": {
        "psr-4": {
            ...
            "SmartCommerceSE\\RooomIntegration\\":"./source"
        },
    "repositories": {
    ...
     "r3d/rooomintegrationmodule": {
            "type": "path",
            "url": "./source/modules/r3d/rooomintegrationmodule",
            "options": {
                "symlink": true
            }
        },
        ...
       }
```

### Integration/Acceptance tests

- install this module into a running OXID eShop


And just in case you need it, admin user can now also be created via commandline
```bash
$ bin/oe-console oe:admin:create-user --admin-email <admin-email> --admin-passowrd <admin-password>
```
for example
```bash
$ bin/oe-console oe:admin:create-user --admin-email admin@admin.com --admin-password admin
```
