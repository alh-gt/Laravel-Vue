<?php
namespace App\Providers\UserProvider;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class MyUserProvider extends EloquentUserProvider implements UserProvider
{
    /**
     * 与えられた credentials からユーザーのインスタンスを探す
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {

        $query = $this->createModel()->newQuery();

        $user = $query
        ->where('login_id', $credentials['login_id'] ?? null )
        ->orWhere('email', $credentials['login_id'] ?? null )
        ->first();
        return $user;
    }
}
