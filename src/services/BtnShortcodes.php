<?php
/**
 * Btn Shortcodes plugin for Craft CMS 3.x
 *
 * Button shortcode support.
 *
 * @link      https://github.com/bhuvidya
 * @copyright Copyright (c) 2019 bhu Boue vidya
 */

namespace bhuvidya\btnshortcodes\services;

use bhuvidya\btnshortcodes\BtnShortcodes;

use Craft;
use craft\base\Component;

/**
 * BtnShortcodes Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    bhu Boue vidya
 * @package   BtnShortcodes
 * @since     1.0.0
 */
class BtnShortcodes extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     BtnShortcodes::$plugin->btnShortcodes->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';

        return $result;
    }
}
