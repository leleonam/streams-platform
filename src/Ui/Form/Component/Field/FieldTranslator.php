<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FieldTranslator
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Component\Field
 */
class FieldTranslator
{

    /**
     * Translate form fields.
     *
     * @param FormBuilder $builder
     */
    public function translate(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getFormEntry();

        /**
         * If the entry is not of the interface
         * or not translatable then skip it.
         */
        if (!$entry instanceof EntryInterface || !$entry->isTranslatable()) {
            return;
        }

        $translations = [];

        /**
         * For each field if the assignment is translatable
         * then duplicate it and set a couple simple
         * parameters to assist in rendering.
         */
        foreach ($fields as $field) {

            $translations[] = array_set($field, 'locale', config('app.locale'));

            $assignment = $entry->getAssignment($field['field']);

            if (!$assignment->isTranslatable()) {
                continue;
            }

            foreach (array_diff(config('streams.available_locales'), [config('app.locale')]) as $locale) {

                $translation = $field;

                array_set($translation, 'locale', $locale);
                array_set($translation, 'hidden', true);

                $translations[] = $translation;
            }
        }

        $builder->setFields($translations);
    }
}