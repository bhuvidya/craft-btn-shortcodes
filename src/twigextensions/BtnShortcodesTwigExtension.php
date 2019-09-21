<?php
/**
 * Btn Shortcodes plugin for Craft CMS 3.x
 *
 * Button shortcode support.
 *
 * @link      https://github.com/bhuvidya
 * @copyright Copyright (c) 2019 bhu Boue vidya
 */

namespace bhuvidya\btnshortcodes\twigextensions;

use bhuvidya\btnshortcodes\BtnShortcodes;

use Craft;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    bhu Boue vidya
 * @package   BtnShortcodes
 * @since     1.0.0
 */
class BtnShortcodesTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'BtnShortcodes';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('btnshortcodes', [ $this, 'btnShortcodes' ]),
        ];
    }

    /**
     * Search for and replace button shortcodes.
     *
     * @param null $text
     *
     * @return string
     */
    public function btnShortcodes($text = null)
    {
        if (!$text) {
            return $text;
        }

        preg_match_all('/\[btn\|([^\]]+?)\]/', $text, $matches);

        // Craft::trace("------------------- MATCHES ------------------");
        // Craft::trace("matches: " . print_r($matches, true));

        if (!$matches || count($matches) !== 2) {
            return $text;
        }

        for ($i = 0; $i < count($matches[0]); $i++) {
            $full = $matches[0][$i];
            $spec = $matches[1][$i];
            $bits = explode('|', $spec);

            if (count($bits ?? []) <= 3) {
                continue;
            }

            $cnt = count($bits);

            $pattern = '/' . preg_quote("[btn|{$spec}]", '/') . '/';

            $ext = $bits[0] === 'ext';
            $url = (preg_match('/^http/', $bits[1]) ? '' : 'https://') . $bits[1];
            $label = $bits[2];
            $cls = 'btn ' . ($cnt >= 4 ? $bits[3] : '');

            $replace = sprintf('<a class="%s" href="%s" %s data-gen="shortcode">%s</a>', $cls, htmlspecialchars($url), $ext ? 'target="_blank"' : '', htmlspecialchars($label));

            // Craft::trace("pattern: $pattern  replace $replace");

            $text = preg_replace($pattern, $replace, $text);
        }

        return $text;
    }
}
