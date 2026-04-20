<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Product[] $products
 */
class Category extends Model
{
    public function products(): HasMany|Category
    {
        return $this->hasMany(Product::class);
    }
}
