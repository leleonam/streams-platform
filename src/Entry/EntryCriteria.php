<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Model\EloquentCriteria;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Database\Query\Builder;

/**
 * Class EntryCriteria
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Entry\Plugin
 */
class EntryCriteria extends EloquentCriteria
{

    /**
     * The query builder.
     *
     * @var Builder
     */
    protected $query;

    /**
     * The stream instance.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Set the get method.
     *
     * @var string
     */
    protected $method;

    /**
     * Create a new EntryCriteria instance.
     *
     * @param Builder         $query
     * @param StreamInterface $stream
     */
    public function __construct(Builder $query, StreamInterface $stream, $method = 'get')
    {
        $this->stream = $stream;

        parent::__construct($query, $method);
    }

    /**
     * Get the entries.
     *
     * @param array $columns
     * @return EntryCollection|EntryPresenter
     */
    public function get(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->{$this->method}($columns));
    }

    /**
     * Find the entry.
     *
     * @param       $id
     * @param array $columns
     * @return EntryPresenter
     */
    public function find($id, array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->find($id, $columns));
    }

    /**
     * Return the first entry.
     *
     * @param array $columns
     * @return EntryPresenter
     */
    public function first(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->first($columns));
    }

    /**
     * Return whether the method is safe or not.
     *
     * @param $name
     * @return bool
     */
    protected function methodIsSafe($name)
    {
        return (in_array($name, $this->safe));
    }

    /**
     * Route through __call.
     *
     * @param $name
     * @return Builder|null
     */
    function __get($name)
    {
        return $this->__call($name, []);
    }

    /**
     * Call the method on the query.
     *
     * @param $name
     * @param $arguments
     * @return Builder|null
     */
    function __call($name, $arguments)
    {
        if ($this->methodIsSafe($name)) {

            call_user_func_array([$this->query, $name], $arguments);

            return $this;
        }

        return $this;
    }
}