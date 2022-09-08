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

  }