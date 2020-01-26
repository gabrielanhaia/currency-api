<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository.
 * That is the base repository, it defines the default repository.
 *
 * @package App\Repositories
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
abstract class AbstractRepository
{
    /** @var Model $model Default model for the repository. */
    public $model;

    /**
     * AbstractRepository constructor.
     * Note: (We could add a different model and they can work together.
     * It would be useful when we are changing/migrating for a different database.)
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
