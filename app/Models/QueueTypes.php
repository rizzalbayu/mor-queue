<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QueueTypes extends Model
{
    protected $table = "queue_types";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function queue(): HasMany
    {
        return $this->hasMany(Queues::class, "queue_type_id", "id");
    }
}
