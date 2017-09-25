<?php
// @codeCoverageIgnoreStart
defined('BASEPATH') || exit('No direct script access allowed');
// @codeCoverageIgnoreEnd

/**
 * CodeIgniter Gettext Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Gettext
 * @author        Joël Gaujard <j.gaujard@gmail.com>
 */

if (!function_exists('__')) {
    /**
     * @param string $expression
     * @return string
     */
    function __($expression)
    {
        return (gettext($expression));
    }
}

if (!function_exists('_e')) {
    /**
     * @param string $expression
     */
    function _e($expression)
    {
        echo (__($expression));
    }
}

if (!function_exists('_n')) {
    /**
     * @param $expression_singular
     * @param $expression_plural
     * @param $number
     * @return string
     */
    function _n($expression_singular, $expression_plural, $number)
    {
        return (ngettext($expression_singular, $expression_plural, (int) $number));
    }
}