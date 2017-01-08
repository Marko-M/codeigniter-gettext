<?php
namespace CodeIgniterGetText\Tests;

require_once('include/gettext_test_functions.php');
require_once('include/gettext_test_constants.php');

class GettextTest extends \PHPUnit_Framework_TestCase
{

    private function _regex($expression, $successful = TRUE)
    {
        $log = ($successful ? 'info' : 'debug');
        $regex = '/(' . $log . '|).*(' . $expression . ')/';

        return ($regex);
    }

    public function testCatalogCodeset()
    {
        $this->expectOutputRegex($this->_regex('bind text domain code set'));
        $this->_library();
    }

    public function testLocaleDir()
    {
        $this->expectOutputRegex($this->_regex('bind text domain directory'));
        $this->_library();
    }

    public function testTextDomain()
    {
        $this->expectOutputRegex($this->_regex('set text domain'));
        $this->_library();
    }

    public function testLocale()
    {
        $this->expectOutputRegex($this->_regex('set locale'));
        $this->_library();
    }

    public function testEnvironmentLanguage()
    {
        $this->expectOutputRegex($this->_regex('set environment language'));
        $this->_library();
    }

    public function testFileExists()
    {
        $this->expectOutputRegex($this->_regex('check MO file exists'));
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

        // Load default config array
        require(realpath(dirname(__FILE__) . '/../') . '/src/config/gettext.php');

        \Gettext::init($config);
    }

}
