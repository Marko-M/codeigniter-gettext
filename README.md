Codeigniter gettext
===================

This is Codeigniter PHP framework library for dealing with gettext.

Instructions
------------

Please note that following steps assume that you have correctly installed gettext and configured Codeigniter on your server.

1. Place gettext.php inside application/config.
2. Place Gettext.php inside application/libraries.
3. Adjust application/config/gettext.php with your `$config['gettext_catalog_codeset']`, `$config['gettext_text_domain']`, `$config['gettext_locale_dir']` and `$config['gettext_locale']`.
4. Create gettext locales directory according to your `$config['gettext_locale_dir']` (application/language/locale by default). Inside that directory create locale_name/LC_MESSAGES path for each of your locales and place your .mo files inside.
5. Add `'gettext'` to Auto-load Config files array or use `$this->config->load('gettext')` inside your controller.
6. Add `'gettext'` to Auto-load Libraries array or use `$this->load->library('gettext')` inside your controller.

If you are loading this library inside your controller you can override any of the default configuration directives. For example if you want to override default `$config['gettext_locale']` with hr_HR.UTF-8 you could use something like this:

 ```php
 <?php
class Example extends CI_Controller {
   public function __construct() {
        parent::__construct();

        $this->load->library(
            'gettext',
            array(
                'gettext_locale' => 'hr_HR.UTF-8'
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
