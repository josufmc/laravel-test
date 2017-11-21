<?php

namespace App\Presenters;

use App\User;
use App\Presenters\Presenter;
use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter {

    public function link(){
        return new HtmlString('<a href="' . route('users.show', $this->model->id) . '">'. $this->model->name .'</a>');
    }

    public function roles(){
        return $this->model->roles->pluck('display_name')->implode(', ');
    }

    public function notes(){
        return $this->model->note ? $this->model->note->body : '';
    }

    public function tags(){
        return $this->model->tags ? $this->model->tags->pluck('name')->implode(', ') : '';
    }
}