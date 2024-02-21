<?php

namespace App\Models\Users;

trait UserModelMethods
{
    /**
     * @param $email
     * @return mixed
     */
    public static function findByEmail( $email )
    {
        return self::where( 'email', $email )->first();
    }

    /**
     * @param $phone_number
     * @return mixed
     */
    public static function findByPhoneNumber( $phone_number )
    {
        return self::where( 'phone_number', $phone_number )->first();
    }

    /**
     * @param $userId
     * @param $tokenName
     * @return mixed
     */
    public static function createTokenByUserId( $userId, $tokenName )
    {
        return self::show( $userId )->first()->createToken( $tokenName );
    }

    /**
     * @param $userId
     * @return mixed
     */
    public static function indexTokens($userId)
    {
        return self::show( $userId )->first()->tokens()->get();
    }

    /**
     * @param $userId
     * @param $tokenId
     * @return mixed
     */
    public static function findTokenById($userId, $tokenId )
    {
        return self::show( $userId )->tokens()->where( 'id', $tokenId )->first();
    }

    /**
     * @param $userId
     * @param $tokenId
     * @return mixed
     */
    public static function deleteToken( $userId, $tokenId )
    {
        return self::findTokenById( $userId, $tokenId )->delete();
    }
}
