<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Database\Eloquent\Model;

class Category extends Model{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}

?>