<?php

// Simulate constants defined in CodeIgniter
define('APPPATH', dirname(__FILE__));

// Simulate helper
function log_message($level, $message) {
    echo "\n\r" . $level . '|' . $message;
}

class GettextTest extends PHPUnit_Framework_TestCase
{

    private function _regex($expression, $successful = TRUE)
    {
        $state = ($successful ? 'Successful' : 'FAILED');
        $regex = '/(info|).*(' . $expression . ').*(' . $state . ')/';

        return ($regex);
    }

    public function testCatalogCodeset()
    {
        $this->expectOutputRegex($this->_regex('catalog_codeset'));
        $this->_library();
    }

    public function testLocaleDir()
    {
        $this->expectOutputRegex($this->_regex('text domain \(locale dir\)'));
        $this->_library();
    }

    public function testTextDomain()
    {
        $this->expectOutputRegex($this->_regex('text_domain'));
        $this->_library();
    }

    public function testLocale()
    {
        $this->expectOutputRegex($this->_regex('locale'));
        $this->_library();
    }

    public function testEnvironmentLanguage()
    {
        $this->expectOutputRegex($this->_regex('Environment LANGUAGE'));
        $this->_library();
    }

    private function _library()
    {
        $config = array();
        /*
        $config = array(
            'gettext_locale_dir' => $CI->config->item('gettext_locale_dir'),
            'gettext_text_domain' => $CI->config->item('gettext_text_domain'),
            'gettext_catalog_codeset' => $CI->config->item('gettext_catalog_codeset'),
            'gettext_locale' => $CI->config->item('gettext_locale')
        );
        */
        require(realpath(dirname(__FILE__) . '/../') . '/src/config/gettext.php');

        Gettext::init($config);
    }

}
