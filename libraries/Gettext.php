<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Codeigniter PHP framework library class for dealing with gettext.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category	Language
 * @author      Joël Gaujard <joel@depiltech.com>
 * @author      Marko Martinović <marko@techytalk.info>
 * @link        https://github.com/joel-depiltech/codeigniter-gettext
 */
class Gettext
{
    /**
     * Initialize gettext inside Codeigniter PHP framework.
     *
     * @param array $config Override default configuration
     */
    public function __construct($config = array())
    {
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
        $IsBindTextDomainCodeset = bind_textdomain_codeset (
            $config['gettext_text_domain'],
            $config['gettext_catalog_codeset']
        );

        log_message (
            'info',
            'Try to bind gettext catalog_codeset: ' . $config['gettext_catalog_codeset'] . " - " .
                ($IsBindTextDomainCodeset ? 'Successful' : '*** FAILED ***')
        );

        // Path to gettext locales directory relative to FCPATH.APPPATH
        $IsBindTextDomain = bindtextdomain (
            $config['gettext_text_domain'],
            APPPATH . $config['gettext_locale_dir']
        );

        log_message (
            'info',
            'Try to bind gettext text domain (locale dir): ' . (empty($IsBindTextDomain) ? $IsBindTextDomain : APPPATH.$config['gettext_locale_dir'] ) . " - " .
                (isset($IsBindTextDomain) ? 'Successful' : '*** FAILED ***')
        );

        // Gettext domain
        $IsSetTextDomain = textdomain (
            $config['gettext_text_domain']
        );

        log_message (
            'info',
            'Try to set gettext text_domain: '.$config['gettext_text_domain'] . " - " .
                ($IsSetTextDomain ? 'Successful' : '*** FAILED ***')
        );

        // Gettext locale
        $IsSetLocale = setlocale (
            LC_ALL,
            $config['gettext_locale']
        );

        log_message (
            'info',
            'Try to set gettext locale: '.(is_array($config['gettext_locale']) ? print_r($config['gettext_locale'],TRUE) : $config['gettext_locale']) . " - " .
                ($IsSetLocale ? 'Successful' : '*** FAILED ***')
        );
        
        // Change environment language for CLI
        $IsPutEnv = putenv('LANGUAGE=' . (is_array($config['gettext_locale']) ? $config['gettext_locale'][0] : $config['gettext_locale']));
        
        log_message (
            'info',
            'Try to set Environment LANGUAGE: ' . (is_array($config['gettext_locale']) ? $config['gettext_locale'][0] : $config['gettext_locale']) . " - " .
                ( $IsPutEnv ? 'Successful' : '*** FAILED ***')
        );
    }
}

/* End of file Gettext.php */