<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Subscription extends Model
{
    use HasFactory;

    public static function add($email)
    {
        $sub = new static;
        $sub->email = $email;
        $sub->save();

        return $sub;
    }

    public function generateToken()
    {
        return $this->token =  Str::random(50) . uniqid();
        $this->save();
    }

    public function remive()
    {
        $this->delete();
    }
}
