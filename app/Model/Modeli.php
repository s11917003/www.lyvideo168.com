<?php
namespace App\Model;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Modeli extends Eloquent
{
    use Rememberable;
}