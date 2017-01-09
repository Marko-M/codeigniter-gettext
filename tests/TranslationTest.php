<?php
namespace CodeIgniterGetText\Tests;

require_once('include/gettext_test_functions.php');
require_once('include/gettext_test_constants.php');

class TranslationTest extends \PHPUnit_Framework_TestCase
{
    const EXPRESSION = "Let me test this expression";

    /**
     * @before
     */
    public function testFrenchLocale()
    {
        $config = array(
            'gettext_locale_dir' => 'testTranslations',
            'gettext_text_domain' => 'my-domain',
            'gettext_catalog_codeset' => 'UTF-8',
            'gettext_locale' => 'fr_FR'
        );

        // only for avoid output when launch test
        $this->expectOutputRegex('//');

        \Gettext::init($config);
    }

    public function testDoubleUnderscore()
    {
        $this->assertEquals("Une expression en Français", __("A expression in English"));
    }

    public function testUnderscroreE()
    {
        $this->expectOutputRegex("/(Une expression en Français)$/");
        _e("A expression in English");
    }

    public function testUnderscroreN_Singular()
    {
        $this->assertEquals(
            "Une expression en Français", __("A expression in English"), 1
        );
    }

    public function testUnderscroreN_Plural()
    {
        $this->assertEquals(
            "Une expression en Français", __("A expression in English"), 2
        );
    }

}