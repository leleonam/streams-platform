<?php namespace Anomaly\Streams\Platform\View\Listener;

use Anomaly\Streams\Platform\View\Event\ViewComposed;
use Robbo\Presenter\Decorator;

/**
 * Class DecorateData
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class DecorateData
{

    /**
     * The decorator utility.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * Create a new DecorateData instance.
     *
     * @param Decorator $decorator
     */
    public function __construct(Decorator $decorator)
    {
        $this->decorator = $decorator;
    }

    /**
     * Handle the event.
     *
     * @param ViewComposed $event
     */
    public function handle(ViewComposed $event)
    {
        $view = $event->getView();

        if ($data = array_merge($view->getFactory()->getShared(), $view->getData())) {
            foreach ($data as $key => $value) {
                $view[$key] = $this->decorator->decorate($value);
            }
        }
    }
}
