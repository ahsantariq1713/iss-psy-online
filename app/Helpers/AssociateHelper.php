<?php


namespace App\Helpers;


class AssociateHelper
{
    public static function ensureUserAssociated($entity, $user)
    {
        if ($entity->user_id == null) {
            $entity->user()->associate($user);
        }
    }
}
