<?php

  namespace App\Repositories;

  use Illuminate\Database\Eloquent\Model;

  abstract class AbstractRepository {

    public function __construct(Model $model) {
      $this->model = $model;
    }

    public function selectRelatedAttributes($attributes) {
      $this->model = $this->model->with($attributes);
    }

    public function selectFilterAttributes($attributes) {
      $this->model = $this->model->selectRaw($attributes);
    }

    public function selectSearchAttributes($attributes) {
      $search = explode('|', $attributes);
      foreach($search as $key => $value) {
          $query_array = explode(',', $value);
          $this->model = $this->model->where(...$query_array);
      }
    }

    public function get() {
      return $this->model->get();
    }

    public function getWithPaginate($qtdPage) {
      return $this->model->paginate($qtdPage);
    }

    public function getById($id) {
      $this->model = $this->model->find($id);
    }

    public function validateAttributes($request) {    
      $dinamic_rules = array();

      $method = $request->method();
      $attributes = $request->all();

      if ($method === 'PATCH') {
          foreach($this->model->rules() as $key => $value) {
              if (array_key_exists($key, $attributes)){
                  $dinamic_rules[$key] = $value;
              }
          }
      } else {
          $dinamic_rules = $this->model->rules();
      }
      
      $request->validate($dinamic_rules);

    }

    public function saveAttributes($attributes) {
      return $this->model->create($attributes);
    }

    public function updateAttributes($attributes) {
      return $this->model->update($attributes);
    }

    public function destroy() {
      $this->model->delete();
    }


  }