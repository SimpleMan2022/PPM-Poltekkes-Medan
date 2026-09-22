<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $fillable = [
        'leader_name',
        'leader_title',
        'leader_position',
        'leader_photo',
        'welcome_message',
        'organization_structure',
        'main_duties',
        'duties_functions',
    ];
}
