<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($validated)
 */
class Product extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
