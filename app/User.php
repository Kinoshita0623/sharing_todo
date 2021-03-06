<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Group;
use App\Todo;
use App\Comment;
use App\Message;
use App\Category;
use App\GroupInvitation;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    public function groups()
    {
        // 第二引数結合テーブル名
        // 第３引数はリレーションを定義しているモデルの外部キー名で、
        // 一方の第４引数には結合するモデルの外部キー名を渡します。
        return $this->belongsToMany(Group::class, 'members', 'user_id', 'group_id');

        //return $this->belongsToMany(Group::class);
    }

    

    /*
    作成者でもグループに属しない場合がありアクセスできるとまずいことになる場合があるので
    作者というだけでは取得できない仕様とする。
    public function createdTodos()
    {
        return $this->hasMany(Todo::class, 'author_id');

    }*/


    public function todos()
    {
        return $this->hasMany(Todo::class, 'user_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function categoriesUsed()
    {
        return $this->morphMany(Category::class, 'author');
    }

    public function invitations()
    {
        return $this->hasMany(GroupInvitation::class, 'invitation_user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
