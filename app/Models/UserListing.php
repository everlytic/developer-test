<?php

namespace Everlytic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Everlytic\Models\UserListing
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $position
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class UserListing extends Model
{
    use SoftDeletes;

}
