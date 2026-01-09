<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'projects';

    public function images()
    {
        return $this->hasMany(ProjectImages::class, 'project_id', 'id');
    }

    public function primary_image()
    {
        return $this->hasOne(ProjectImages::class, 'project_id', 'id');
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
