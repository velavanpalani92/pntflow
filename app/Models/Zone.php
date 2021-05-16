<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const REGION_SELECT = [
        'north' => 'North',
        'south' => 'South',
    ];

    public $table = 'zones';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'zone',
        'region',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function zoneErpnames()
    {
        return $this->hasMany(Erpname::class, 'zone_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
