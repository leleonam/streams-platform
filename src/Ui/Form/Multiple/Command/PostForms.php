<?php namespace Anomaly\Streams\Platform\Ui\Form\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Http\Request;

/**
 * Class PostForms
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class PostForms
{

    /**
     * The multiple form builder.
     *
     * @var MultipleFormBuilder
     */
    protected $builder;

    /**
     * Create a new PostForms instance.
     *
     * @param MultipleFormBuilder $builder
     */
    public function __construct(MultipleFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        if (!$request->isMethod('post')) {
            return;
        }

        $this->builder->fire('posting_forms', ['builder' => $this->builder]);

        /* @var FormBuilder $builder */
        foreach ($forms = $this->builder->getForms() as $slug => $builder) {
            $this->builder->fire('posting_' . $slug, compact('builder', 'forms'));

            $builder->post();
        }
    }
}
