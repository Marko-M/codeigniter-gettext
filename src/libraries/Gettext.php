<?php
// @codeCoverageIgnoreStart
defined('BASEPATH') || exit('No direct script access allowed');
// @codeCoverageIgnoreEnd

/**
 * Codeigniter PHP framework library class for dealing with gettext.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Language
 * @author      Joël Gaujard <joel@depiltech.com>
 * @author      Marko Martinović <marko@techytalk.info>
 * @link        https://github.com/joel-depiltech/codeigniter-gettext
 */
class Gettext
{
    /**
     * Initialize Codeigniter PHP framework and get configuration
     *
     * @codeCoverageIgnore
     * @param array $config Override default configuration
     */
    public function __construct($config = array())
    {
        log_message('info', 'Gettext Library Class Initialized');

        // Merge $config and config/gettext.php $config
        $config = array_merge(
            array(
                'gettext_locale_dir' => config_item('gettext_locale_dir'),
                'gettext_text_domain' => config_item('gettext_text_domain'),
                'gettext_catalog_codeset' => config_item('gettext_catalog_codeset'),
                'gettext_locale' => config_item('gettext_locale')
            ),
            $config
        );

        self::init($config);
    }

    /**
     * Initialize gettext inside Codeigniter PHP framework.
     *
     * @param array $config configuration
     */
    public static function init(array $config)
    {
        // Gettext catalog codeset
        $isBindTextDomainCodeset = bind_textdomain_codeset(
            $config['gettext_text_domain'],
            $config['gettext_catalog_codeset']
        );

        log_message(
            (is_string($isBindTextDomainCodeset) ? 'info' : 'error'),
            'Gettext Library -> Bind text domain code set: ' .
            $config['gettext_catalog_codeset']
        );

        // Path to gettext locales directory relative to FCPATH.APPPATH
        $isBindTextDomain = bindtextdomain(
            $config['gettext_text_domain'],
            APPPATH . $config['gettext_locale_dir']
        );

        log_message(
            (is_string($isBindTextDomain) ? 'info' : 'error'),
            'Gettext Library -> Bind text domain directory: ' .
            APPPATH . $config['gettext_locale_dir']
        );

        // Gettext domain
        $isSetTextDomain = textdomain(
            $config['gettext_text_domain']
        );

        log_message(
            (is_string($isSetTextDomain) ? 'info' : 'error'),
            'Gettext Library -> Set text domain: ' .
            $config['gettext_text_domain']
        );

        // Gettext locale
        $isSetLocale = setlocale(
            LC_ALL,
            $config['gettext_locale']
        );

        log_message(
            (is_string($isSetLocale) ? 'info' : 'error'),
            'Gettext Library -> Set locale: ' .
            (is_array($config['gettext_locale']) ?
                print_r($config['gettext_locale'], TRUE) : $config['gettext_locale']
            )
        );

        // Change environment language for CLI
        $gettext_locale = is_array($config['gettext_locale'])
            ? $config['gettext_locale'][key($config['gettext_locale'])]
            : $config['gettext_locale']
        ;
        $isPutEnv = putenv('LANGUAGE=' . $gettext_locale);

        log_message(
            ($isPutEnv === TRUE ? 'info' : 'error'),
            'Gettext Library -> Set environment language: ' . $gettext_locale
        );

        // MO file exists for language
        $file = APPPATH . $config['gettext_locale_dir'] .
            '/' . $isSetLocale .
            '/LC_MESSAGES/' .
            $config['gettext_text_domain'] . '.mo'
        ;
        $isFileExists = is_file($file);

        log_message(
            ($isFileExists === TRUE ? 'info' : 'error'),
            'Gettext Library -> Check MO file exists: ' .
            $file
        );
    }
}

/* End of file Gettext.php */
/* Location: ./libraries/config/gettext.php */