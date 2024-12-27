<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company_id', 'project_id', 'update_name', 'document'];

    

}
