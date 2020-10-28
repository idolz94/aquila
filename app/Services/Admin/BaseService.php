<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class BaseService
{

    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @param App $app
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try {
            return $this->model->findOrFail($id)->delete();
        } catch (\Exception $e) {
            Log::debug($e);
            return false;
        }
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }


    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            Log::debug($e);
            return false;
        }
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    public function findOrFailWithTrash($id)
    {
        return $this->model->withTrashed()->findOrFail($id);
    }

    public function updateWithTrash($data, $id)
    {
        return $this->model->withTrashed()->find($id)->update($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model->newQuery();
    }

    public function search($query, $keyword, $searchColumns, $order, $limit, $page)
    {
        if (empty($query)) {
            $query = $this->model;
        }

        if ($keyword) {
            $query->where(function ($currentQuery) use ($keyword, $searchColumns) {
                foreach ($searchColumns as $col) {
                    $currentQuery->orWhere($col, 'like', "%$keyword%");
                }
            });
        }

        if (!empty($order)) {
            $query->orderBy($order['column'], $order['dir']);
        }

        return $query->paginate($limit, ['*'], 'page', $page);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createMany(array $data)
    {
        return $this->model->insert($data);
    }
}