<?php
/**
 * captcha plugin for Craft CMS 3.x
 *
 * Flows Captcha Plugin
 *
 * @link      www.flowsa.com
 * @copyright Copyright (c) 2021 Flow
 */

namespace flowsa\captcha\utilities;

use flowsa\captcha\Captcha;
use flowsa\captcha\assetbundles\captchautilityutility\CaptchaUtilityUtilityAsset;

use Craft;
use craft\base\Utility;

/**
 * captcha Utility
 *
 * Utility is the base class for classes representing Control Panel utilities.
 *
 * https://craftcms.com/docs/plugins/utilities
 *
 * @author    Flow
 * @package   Captcha
 * @since     1.0.0
 */
class CaptchaUtility extends Utility
{
    // Static
    // =========================================================================

    /**
     * Returns the display name of this utility.
     *
     * @return string The display name of this utility.
     */
    public static function displayName(): string
    {
        return Craft::t('captcha', 'CaptchaUtility');
    }

    /**
     * Returns the utility’s unique identifier.
     *
     * The ID should be in `kebab-case`, as it will be visible in the URL (`admin/utilities/the-handle`).
     *
     * @return string
     */
    public static function id(): string
    {
        return 'captcha-captcha-utility';
    }

    /**
     * Returns the path to the utility's SVG icon.
     *
     * @return string|null The path to the utility SVG icon
     */
    public static function iconPath()
    {
        return Craft::getAlias("@flowsa/captcha/assetbundles/captchautilityutility/dist/img/CaptchaUtility-icon.svg");
    }

    /**
     * Returns the number that should be shown in the utility’s nav item badge.
     *
     * If `0` is returned, no badge will be shown
     *
     * @return int
     */
    public static function badgeCount(): int
    {
        return 0;
    }

    /**
     * Returns the utility's content HTML.
     *
     * @return string
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(CaptchaUtilityUtilityAsset::class);

        $someVar = 'Have a nice day!';
        return Craft::$app->getView()->renderTemplate(
            'captcha/_components/utilities/CaptchaUtility_content',
            [
                'someVar' => $someVar
            ]
        );
    }
}
