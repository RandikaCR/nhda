<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressReleases extends Model
{
    use HasFactory;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'press_releases';

    public function images()
    {
        return $this->hasMany(PressReleaseImages::class, 'press_release_id', 'id');
    }

    public function primary_image()
    {
        return $this->hasOne(PressReleaseImages::class, 'press_release_id', 'id');
    }

    public function status(){

        $status = 'Inactive';
        $statusClass = 'bg-warning';

        if ($this->status == 1){
            $status = 'Active';
            $statusClass = 'bg-success';
        }

        return (Object)[
            'text' => $status,
            'class' => $statusClass,
        ];
    }
}
