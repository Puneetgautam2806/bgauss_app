<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkTbl extends Model
{
    protected $table = 'linktbl';

    protected $fillable = [
        'menu_name', 'path', 'is_parent', 'icon', 'order', 'display', 'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(LinkTbl::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(LinkTbl::class, 'parent_id');
    }
}
