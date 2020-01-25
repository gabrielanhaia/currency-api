<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Currency
 * @package App\Models
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class Currency extends Model
{
    use SoftDeletes;

    /** @var string $table Table name. */
    protected $table = 'currencies';

    /** @var array $fillable Fillable fields. */
    protected $fillable = [
        'name',
        'initial',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
