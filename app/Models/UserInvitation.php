<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'institution'
    ];

    /**
     * Gives the rules for creating invitation for the user
     *
     * @return array{email: string, name: string}
     */
    public static function rules(): array
    {
        return [
            'email' => 'required|unique:users,email|unique:user_invitations,email',
            'name' => 'required',
            'institution' => 'required'
        ];
    }
}
