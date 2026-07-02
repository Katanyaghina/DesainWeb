<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_code',
        'client_name',
        'email',
        'phone_country_code',
        'phone_number',
        'address_street',
        'address_street2',
        'address_city',
        'address_province',
        'address_postal',
        'project_description',
        'status'
    ];
}
