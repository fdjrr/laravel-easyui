<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menus';
    protected $guarded = ['id'];

    /**
     * Get all of the childrens for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
