<?php

namespace App\Models;

use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Token extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $guarded = [];

    /* Constants */

    const TOKEN_USER_REGISTRATION = 1;
    const TOKEN_RESET_PASSWORD = 2;

    /* Constructor */

    public function __construct(array $attributes = [])
    {
        parent::__construct( $attributes );

        $this->deleted_at = now()->addMinutes(30);
    }

    /* Relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* Methods */

    public function generateToken(int $type, string $id)
    {
        return Token::create([
            'user_id' => $id,
            'token' => Str::random(128),
            'type' => $type
        ]);
    }
}
