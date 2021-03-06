<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;
use Illuminate\Routing\ResponseFactory;

/**
 * Class SetGridResponse
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class SetGridResponse
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new SetGridResponse instance.
     *
     * @param GridBuilder $builder
     */
    public function __construct(GridBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ResponseFactory $response
     */
    public function handle(ResponseFactory $response)
    {
        $grid = $this->builder->getGrid();

        $options = $grid->getOptions();
        $data    = $grid->getData();

        $grid->setResponse($response->view($options->get('wrapper_view', 'streams::blank'), $data));
    }
}
