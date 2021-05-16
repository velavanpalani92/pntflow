<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outward extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'outwards';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'erp_id',
        'serialno_id',
        'category_id',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        Outward::observe(new \App\Observers\OutwardActionObserver());
    }

    public function erp()
    {
        return $this->belongsTo(Erpname::class, 'erp_id');
    }

    public function serialno()
    {
        return $this->belongsTo(Instock::class, 'serialno_id');
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
