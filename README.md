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
$this->load->library(
    'gettext',
    array(
        'gettext_locale' => 'hr_HR.UTF-8'
    )
);
 ```
