<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $fillable = ['user_id', 'total', 'status'];

    public function user(){
        return $this->belondsTo(User::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
?>