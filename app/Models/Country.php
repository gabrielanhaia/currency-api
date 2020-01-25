<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country
 * @package App\Models
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class Country extends Model
{
    use SoftDeletes;

    /** @var string $table Table name. */
    protected $table = 'countries';

    /** @var array $fillable Fillable fields. */
    protected $fillable = [
        'name',
        'initial',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
