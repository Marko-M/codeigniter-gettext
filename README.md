Codeigniter gettext
===================

[![Latest Stable Version](https://poser.pugx.org/joel-depiltech/codeigniter-gettext/v/stable.svg)](https://packagist.org/packages/joel-depiltech/codeigniter-gettext)
[![License](https://poser.pugx.org/joel-depiltech/codeigniter-gettext/license)](https://packagist.org/packages/joel-depiltech/codeigniter-gettext)

This is Codeigniter PHP framework library for dealing with gettext.

This library is a fork from Marko Martivović : https://github.com/Marko-M/codeigniter-gettext

Please use composer to install it and include it as a package in your CodeIgniter application. 

Instructions
------------

Please note that following steps assume that you have correctly installed gettext and configured Codeigniter on your server.

1. Use composer to install this package `composer require joel-depiltech/codeigniter-gettext`
2. Add this package to Auto-load Packages files array :
`$autoload['packages'] = array(FCPATH . 'vendor/joel-depiltech/codeigniter-gettext');`
or include it with Loader library
`$this->load->add_package_path(FCPATH . 'vendor/joel-depiltech/codeigniter-gettext');`
3. Adjust configuration when loading the library
`$this->load->library('gettext', array('gettext_locale' => 'fr_FR', 'gettext_locale_dir' => 'language/locale'));`
or just copy the file `application/vendor/joel-depiltech/codeigniter-gettext/config/gettext.php` in your folder `application/config/gettext.php`
4. Create gettext locales directory according to your `gettext_locale_dir` (application/language/locales by default). Inside that directory create locale_name/LC_MESSAGES path for each of your locales and place your .mo files inside.

This is an example how to load Library overwriting default configuration:

```php
<?php
class My_controller extends CI_Controller
{
   public function __construct()
   {
        parent::__construct();

        $this->load->library(
            'gettext',
            array(
                'gettext_text_domain' => 'my-project',
                'gettext_locale' => 'fr_FR.UTF-8',
                'gettext_locale_dir' => 'language/gettext'
            )
        );
   }
}
?>
```

Additional Usage
-----------------------

If you want to use URIs in i18n Style, you can easily add a Post-Controller-Hook like the sample below.
Place the following code inside your application/config/hooks.php.

```php

$hook['post_controller_constructor'] = function()
{
    /**
     * Localisation Strings Windows:
     * @link https://msdn.microsoft.com/en-us/library/cdax410z(v=vs.90).aspx
     * @link https://msdn.microsoft.com/en-us/library/39cwe7zf(v=vs.90).aspx
     * Localisation Strings Unix:
     * Verify that the selected locales are available by running `locale -a`. 
     * 
     * in addition take a look at
     * @link http://avenir.ro/create-cms-using-codeigniter-3/create-multilanguage-site-codeigniter/
     **/

    $locale = Array(
        "de" => Array(
            'de_DE.UTF-8',
            'de_DE@euro',
            'de_DE',
            'german',
            'ger',
            'deu',
            'de'
        ),
        "en" => Array(
            "en_GB.UTF-8",
            "en_GB@euro",
            "en_GB",
            "english",
            "eng",
            "gbr",
            "en"
        )
    );

    $CI = &get_instance();
    $lang = $this->uri->segment(1);
    if(isset($locale[$lang])){
        $getTextConfig = Array( 
            'gettext_catalog_codeset' => 'UTF8',
            'gettext_text_domain' => 'example',
            'gettext_locale_dir' => './language/locale/';
            'gettext_locale' => $locale[$lang]
        );
        $CI->load->library('gettext', $getTextConfig);
    }
    else {
        $CI->load->library('gettext');
    }

};
```
