<?php namespace Anomaly\Streams\Platform\Addon\Extension\Command;

/**
 * Class InstallAllExtensions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class InstallAllExtensions
{

    /**
     * The seed flag.
     *
     * @var bool
     */
    protected $seed;

    /**
     * Create a new InstallAllExtensions instance.
     *
     * @param bool $seed
     */
    public function __construct($seed = false)
    {
        $this->seed = $seed;
    }

    /**
     * Get the seed flag.
     *
     * @return bool
     */
    public function getSeed()
    {
        return $this->seed;
    }
}
