<?php

namespace App\Models\Users;

trait UserModelMethods
{
    /**
     * @param $email
     * @return mixed
     */
    public static function findByEmail( $email ): mixed
    {
        return self::where( 'email', $email )->first();
    }

    /**
     * @param $phone_number
     * @return mixed
     */
    public static function findByPhoneNumber( $phone_number ): mixed
    {
        return self::where( 'phone_number', $phone_number )->first();
    }

    /**
     * @param $user_id
     * @param $tokenName
     * @return mixed
     */
    public static function createTokenByUserId( $user_id, $tokenName ): mixed
    {
        return self::show( $user_id )->first()->createToken( $tokenName );
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public static function indexTokens( $user_id ): mixed
    {
        return self::show( $user_id )->first()->tokens()->get();
    }

    /**
     * @param $user_id
     * @param $token_id
     * @return mixed
     */
    public static function findTokenById( $user_id, $token_id ): mixed
    {
        return self::show( $user_id )->tokens()->where( 'id', $token_id )->first();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public static function deleteToken( $user_id ): mixed
    {
        return self::show( $user_id )->first()->tokens()->delete();
    }
}
