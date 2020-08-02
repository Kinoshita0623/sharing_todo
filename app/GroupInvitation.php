<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class GroupInvitation extends Model
{
    
    // 招待グループ
    // 招待対象ユーザー
    // 招待有効期限
    // 招待の作成者
    // is_accept(招待者の承諾)
    protected $fillable = [
        'invitation_group_id',
        'invitation_user_id',
        'expiration_date',
        'author_id',
        'is_accept'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     *  招待対象のユーザー
     */
    public function inviteUser()
    {
        return $this->belongsTo(User::class, 'invitation_user_id');
    }

    //public function 

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}