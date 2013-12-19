<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Codeigniter PHP framework library class for dealing with gettext.
 *
 * @package     CodeIgniter
 * @subpackage    Libraries
 * @category	Language
 * @author	Marko Martinović <marko@techytalk.info>
 * @link	https://github.com/Marko-M/codeigniter-gettext
 */
class Gettext {
    /**
     * Initialize gettext inside Codeigniter PHP framework.
     *
     * @param array $config Override default configuration
     */
    public function __construct($config = array()) {
        $CI = &get_instance();

        // Merge $config and config/gettext.php $config
        $config = array_merge (
            array(
                'gettext_locale_dir' => $CI->config->item('gettext_locale_dir'),
                'gettext_text_domain' => $CI->config->item('gettext_text_domain'),
                'gettext_catalog_codeset' => $CI->config->item('gettext_catalog_codeset'),
                'gettext_locale' => $CI->config->item('gettext_locale')
            ),
            $config
        );

        // Gettext catalog codeset
        bind_textdomain_codeset (
            $config['gettext_text_domain'],
            $config['gettext_catalog_codeset']
        );

        log_message (
            'debug',
            'Gettext catalog_codeset: '.$config['gettext_catalog_codeset']
        );

        // Path to gettext locales directory relative to FCPATH.APPPATH
        bindtextdomain (
            $config['gettext_text_domain'],
            FCPATH.APPPATH.$config['gettext_locale_dir']
        );

        log_message (
            'debug',
            'Gettext locale_dir: '.$config['gettext_locale_dir']
        );

        // Gettext domain
        textdomain (
            $config['gettext_text_domain']
        );

        log_message (
            'debug',
            'Gettext text_domain: '.$config['gettext_text_domain']
        );

        // Gettext locale
        setlocale (
            LC_ALL,
            $config['gettext_locale']
        );

        log_message (
            'debug',
            'Gettext locale: '.$config['gettext_locale']
        );
        
        // Change environment language for CLI
        putenv('LANGUAGE=' . $config['gettext_locale']);
        
        log_message (
            'debug',
            'Environment language: ' . $config['gettext_locale']
        );
    }
}

/* End of file Gettext.php */
