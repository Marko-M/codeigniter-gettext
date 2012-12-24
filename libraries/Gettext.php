<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Codeigniter PHP framework library class for dealing with gettext.
 */
class Gettext {
    /**
     * Initialize gettext inside Codeigniter PHP framework.
     *
     * @param array $override Override default configuration
     */
    public function __construct($override) {
        $CI =& get_instance();

        // Merge $config and $override
        $config = array_merge(
            array(
                'gettext_locale_dir' => $CI->config->item('gettext_locale_dir'),
                'gettext_text_domain' => $CI->config->item('gettext_text_domain'),
                'gettext_catalog_codeset' => $CI->config->item('gettext_catalog_codeset'),
                'gettext_locale' => $CI->config->item('gettext_locale')
            ),
            $override
        );

        // Gettext catalog codeset
        bind_textdomain_codeset(
            $config['gettext_text_domain'],
            $config['gettext_catalog_codeset']
        );

        // Path to gettext locales directory relative to FCPATH.APPPATH
        bindtextdomain(
            $config['gettext_text_domain'],
            FCPATH.APPPATH.$config['gettext_locale_dir']
        );

        // Gettext domain
        textdomain(
                $config['gettext_text_domain']
        );

        // Gettext locale
        setlocale(
            LC_ALL,
            $config['gettext_locale']
        );
    }
}

/* End of file Gettext.php */