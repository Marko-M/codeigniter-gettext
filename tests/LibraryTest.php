<?php
namespace CodeIgniterGetText\Tests;

class LibraryTest extends \PHPUnit_Framework_TestCase
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

        // Load default config array
        require(realpath(dirname(__FILE__) . '/../') . '/src/config/gettext.php');

        \Gettext::init($config);
    }

}
