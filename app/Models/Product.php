<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'quantity', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function OrderItems(){
        return $this->hasMany(OrderItem::class);
    }
}

?>
