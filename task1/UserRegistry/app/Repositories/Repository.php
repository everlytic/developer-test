<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function all()
    {
        return $this->model->all();
    }
    
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    
    public function with($relations)
    {
        return $this->model->with($relations);
    }
    
    public function paginate(int $qty = 10)
    {
        return $this->model->paginate($qty);
    }
}