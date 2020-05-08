<?php


namespace api\hzj\resource;


use app\api\model\User;

/**
 * @OA\Schema(
 *   schema="Users",
 *   type="object",
 *   @OA\Property(property="id", type="integer", description="ID"),
 *   @OA\Property(property="name", type="string", description="用户名"),
 *   @OA\Property(property="phone", type="string", description="手机号"),
 *   @OA\Property(property="user_ident", type="string", description="身份证"),
 *   @OA\Property(property="organization", type="integer", description="党组织"),
 *   @OA\Property(property="display_organization", type="string", description="党组织"),
 *   @OA\Property(property="create_time", type="string", description="创建时间"),
 *   @OA\Property(property="my_resource", type="integer", description="我的发布数量"),
 *   @OA\Property(property="my_claim_wish_count", type="integer", description="我的认领数量"),
 * )
 */
class UsersResource
{
    public static function transfer(User $user)
    {
        $claimWishes = $user->myClaimWishes;
        $myResource  = $user->resources;
        return [
            'id'                   => $user->id,
            'name'                 => $user->name,
            'phone'                => $user->phone,
            'user_ident'           => $user->user_ident,
            'organization'         => $user->organization,
            'display_organization' => User::$organization[$user->organization],
            'create_time'          => $user->create_time,
            'my_resource'          => $myResource->count(),
            'my_claim_wish_count'  => $claimWishes->count(),
        ];
    }
}