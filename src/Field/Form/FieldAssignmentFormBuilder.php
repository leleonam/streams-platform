<?php namespace Anomaly\Streams\Platform\Field\Form;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class FieldAssignmentFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Field\Form
 */
class FieldAssignmentFormBuilder extends MultipleFormBuilder
{

    /**
     * Initialize the form builder.
     *
     * @param FieldFormBuilder $field
     */
    public function onInit(
        FieldFormBuilder $field,
        AssignmentFormBuilder $assignment,
        AssignmentRepositoryInterface $assignments
    ) {

        $assignment->setEntry(21);
        $field->setEntry($assignments->find(21)->getField()->getId());

        $this
            ->addForm('field', $field)
            ->addForm('assignment', $assignment);
    }
}
