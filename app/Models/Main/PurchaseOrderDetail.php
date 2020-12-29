<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderDetail extends Model
{
    protected $table = 'order_details';
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'purchase_order_id', 'product_id', 'seller_id', 'supplier_id', 'product_name_en', 'product_name_ar', 'qty', 'unit_price',
        'sub_total', 'total_tax', 'total_discount', 'discount_format', 'tax_format', 'variation', 'variation_id',
        'commission', 'payment_status', 'delivery_status', 'type', 'tax', 'discount'
    ];

    public function order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function supllier()
    {
        return $this->belongsTo(Supllier::class, 'supplier_id');
    }

    public function Variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}
