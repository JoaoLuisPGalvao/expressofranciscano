<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function creating($model){
        if (Auth::check()) {
            $model->created_by_name = Auth::user()->name;
        }
    }

    public function updating($model){
        if (Auth::check()) {
            $model->updated_by_name = Auth::user()->name;
        }
    }

    public function deleting($model){
        if (Auth::check()) {
            $model->deleted_by_name = Auth::user()->name;
            $model->save();
        }
    }
}
