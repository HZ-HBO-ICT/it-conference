<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Spatie\Permission\Models{

    use Barryvdh\LaravelIdeHelper\Eloquent;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
 * Spatie\Permission\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission permission($permissions)
 * @method static Builder|Permission query()
 * @method static Builder|Permission role($roles, $guard = null)
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereGuardName($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 */
	abstract class Permission extends Eloquent implements \Spatie\Permission\Contracts\Permission {}



    /**
 * Spatie\Permission\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role permission($permissions)
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereGuardName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 */
	abstract class Role extends Eloquent implements \Spatie\Permission\Contracts\Role {}
}

