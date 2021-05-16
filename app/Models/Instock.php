<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instock extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const SOURCE_SELECT = [
        'vendors'  => 'Vendors',
        'internal' => 'Internal Transfer',
        'ho'       => 'HO',
    ];

    public $table = 'instocks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type_id',
        'vendor_id',
        'serialno',
        'source',
        'orderno',
        'remarks',
        'category_id',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        Instock::observe(new \App\Observers\InstockActionObserver());
    }

    public function type()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
