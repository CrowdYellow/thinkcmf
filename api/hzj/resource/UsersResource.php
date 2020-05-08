<?php


namespace api\hzj\resource;


use app\api\model\User;

class UsersResource
{
    public static function transfer(User $user)
    {
        $claimWishes = $user->myClaimWishes;
        return [
            'id'                   => $user->id,
            'name'                 => $user->name,
            'phone'                => $user->phone,
            'user_ident'           => $user->user_ident,
            'organization'         => $user->organization,
            'display_organization' => $user->organization,
            'create_time'          => $user->create_time,
            'my_claim_wish_count'  => $claimWishes->count(),
        ];
    }
}