<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Queues extends Model
{
    
    protected $table = "queues";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function queue_types(): BelongsTo
    {
        return $this->belongsTo(Queues::class, "queue_type_id", "id");
    }

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Queues::class, "customer_id", "id");
    }
}
