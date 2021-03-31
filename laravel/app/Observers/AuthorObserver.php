<?php

namespace App\Observers;

use Auth;
use Illuminate\Database\Eloquent\Model;

class AuthorObserver
{
    /**
     * 追加
     * 
     * @param Model $model Eloquentモデル
     */
    public function creating(Model $model)
    {
        $user=Auth::user();
        if($user){
            $model->created_id = Auth::user()->id;
        }
        
    }

    /**
     * 更新
     * 
     * @param Model $model Eloquentモデル
     */
    public function updating(Model $model)
    {
        $user=Auth::user();
        if($user){
            $model->updated_id = $user->id;
        }
       
    }

    /**
     * 保存
     * 
     * @param Model $model Eloquentモデル
     */
    public function saving(Model $model)
    {
        $user=Auth::user();
        if($user){
            $model->updated_id = $user->id;
        }
    }

    /**
     * 論理削除
     * 
     * @param Model $model Eloquentモデル
     */
    public function deleting(Model $model)
    {
        $user=Auth::user();
        if($user){
            $model->deleted_id = Auth::user()->id;
        }
        
        $model->save();
    }

    /**
     * 復帰
     * 
     * @param Model $model Eloquentモデル
     */
    public function restoring(Model $model)
    {
        $model->deleted_id = 0;
    }
}
