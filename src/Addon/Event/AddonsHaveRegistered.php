<?php namespace Anomaly\Streams\Platform\Addon\Event;

use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class AddonsHaveRegistered
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class AddonsHaveRegistered
{

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * Create a new AddonsHaveRegistered instance.
     *
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
    }

    /**
     * Get the addon collection.
     *
     * @return AddonCollection
     */
    public function getAddons()
    {
        return $this->addons;
    }
}
