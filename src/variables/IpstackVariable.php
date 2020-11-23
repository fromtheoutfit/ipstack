<?php
/**
 * ipstack plugin for Craft CMS 3.x
 *
 * Simple custom wrapper around the ipstack api.
 *
 * @link      https://www.theout.fit
 * @copyright Copyright (c) 2020 The Outfit, Inc
 */

namespace fromtheoutfit\ipstack\variables;

use fromtheoutfit\ipstack\Ipstack;

use Craft;

/**
 * ipstack Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.ipstack }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    The Outfit, Inc
 * @package   Ipstack
 * @since     1.0.0
 */
class IpstackVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.ipstack.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.ipstack.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function country($optional = null)
    {
        return Ipstack::$plugin->ipstackService->getCountry();
    }
}
