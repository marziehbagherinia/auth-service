<?php

namespace App\Utils\CacheManager;

use App\Enums\Cache\CacheTags;
use Illuminate\Support\Facades\Cache;

/**
 * Class CacheManager.
 */
class CacheManager
{
    /**
     * Set user reset password token.
     *
     * @param $token
     * @param $user_id
     * @return void
     */
    public static function setUserResetPasswordToken( $token, $user_id ): void
    {
        $keyCache = config( 'cache_manager.user.reset_password.token.key' ).$token;

        $ttl = config( 'cache_manager.user.reset_password.token.ttl' );

        Cache::tags( CacheTags::USER_RESET_PASSWORD )->put( $keyCache, $user_id, $ttl );
    }

    /**
     * Get user reset password token.
     *
     * @param $token
     * @return mixed
     */
    public static function getUserResetPasswordToken( $token ): mixed
    {
        $keyCache = config( 'cache_manager.user.reset_password.token.key' ).$token;

        return Cache::tags( CacheTags::USER_RESET_PASSWORD )->get( $keyCache );
    }

    /**
     * Set user reset password done.
     *
     * @param $user_id
     * @return void
     */
    public static function setUserResetPasswordDone( $user_id ): void
    {
        $keyCache = config( 'cache_manager.user.reset_password.done.key' ).$user_id;

        $ttl = config( 'cache_manager.user.reset_password.ttl' );

        Cache::tags( CacheTags::USER_RESET_PASSWORD )->put( $keyCache, true, $ttl );
    }

    /**
     * Get user reset password done.
     *
     * @param $user_id
     * @return mixed
     */
    public static function getUserResetPasswordDone( $user_id ): mixed
    {
        $keyCache = config( 'cache_manager.user.reset_password.done.key' ).$user_id;

        return Cache::tags( CacheTags::USER_RESET_PASSWORD )->get( $keyCache );
    }


    /**
     * Set user permissions.
     *
     * @param $user_id
     * @param $user_permissions
     * @return void
     */
    public static function setUserPermissions( $user_id, $user_permissions ): void
    {
        $keyCache = config( 'cache_manager.user.permissions.key' ).$user_id;

        $ttl = config( 'cache_manager.user.permissions.ttl' );

        Cache::tags( CacheTags::USER_PERMISSIONS )->put( $keyCache, $user_permissions, $ttl );
    }

    /**
     * Get user permissions.
     *
     * @param $user_id
     * @return array|mixed
     */
    public static function getUserPermissions( $user_id ): mixed
    {
        $keyCache = config( 'cache_manager.user.permissions.key' ).$user_id;

        return Cache::tags( CacheTags::USER_PERMISSIONS )->get( $keyCache, [] );
    }

    /**
     * Reset user permissions.
     *
     * @param $user_id
     * @return void
     */
    public static function resetUserPermissions( $user_id ): void
    {
        $keyCache = config( 'cache_manager.user.permissions.key' ).$user_id;

        Cache::tags( CacheTags::USER_PERMISSIONS )->forget( $keyCache );
    }

    /**
     * Set user roles.
     *
     * @param $user_id
     * @param $user_roles
     * @return void
     */
    public static function setUserRoles( $user_id, $user_roles ): void
    {
        $keyCache = config( 'cache_manager.user.roles.key' ).$user_id;

        $ttl = config( 'cache_manager.user.roles.ttl' );

        Cache::tags( CacheTags::USER_ROLES )->put( $keyCache, $user_roles, $ttl );
    }

    /**
     * Get user roles.
     *
     * @param $user_id
     * @return array|mixed
     */
    public static function getUserRoles( $user_id ): mixed
    {
        $keyCache = config( 'cache_manager.user.roles.key' ).$user_id;

        return Cache::tags( CacheTags::USER_ROLES )->get( $keyCache, [] );
    }

    /**
     * Reset user roles.
     *
     * @param $user_id
     * @return void
     */
    public static function resetUserRoles( $user_id ): void
    {
        $keyCache = config( 'cache_manager.user.roles.key' ).$user_id;

        Cache::tags( CacheTags::USER_ROLES )->forget( $keyCache );
    }
}
