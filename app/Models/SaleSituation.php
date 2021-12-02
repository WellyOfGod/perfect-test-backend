<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleSituation extends BaseModel
{
    protected $table = 'sale_situations';

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
