<?php namespace Anomaly\Streams\Platform\Addon\Extension\Command;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasDisabled;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class DisableExtension
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class DisableExtension
{

    /**
     * The extension to uninstall.
     *
     * @var Extension
     */
    protected $extension;

    /**
     * Create a new DisableExtension instance.
     *
     * @param Extension $extension
     */
    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @param  ExtensionRepositoryInterface $extensions
     * @param  Dispatcher                   $events
     * @return bool
     */
    public function handle(ExtensionRepositoryInterface $extensions, Dispatcher $events)
    {
        $extensions->disable($this->extension);

        $events->fire(new ExtensionWasDisabled($this->extension));

        return true;
    }
}
