<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param string $value
     * @return string
     */
    public function getCreatedAtAttribute(string $value): string
    {
        return date('d/m/Y', strtotime($value));
    }

    /**
     * @param string $value
     * @return string
     */
    public function getUpdatedAtAttribute(string $value): string
    {
        return date('d/m/Y', strtotime($value));
    }
}
