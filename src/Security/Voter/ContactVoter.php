<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ContactVoter extends Voter
{


    protected function supports(string $attribute, $subject): bool
    {
//        dd($attribute, $subject);
        return in_array($attribute, [
                'CAN_ACCESS_CONTACTS',
                'CAN_VIEW_CONTACTS',
                'CAN_EDIT_CONTACTS',
                'CAN_DELETE_CONTACTS',
                'CAN_INDEX_CONTACTS',
            ])
            && $subject instanceof \App\Entity\Contact;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
//        dd($attribute, $subject);
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        dump($attribute);

        return match ($attribute) {
            'CAN_ACCESS_CONTACTS' => rand(0, 1) === 1,
            'CAN_EDIT_CONTACTS' =>  rand(0, 1) === 1,
            'CAN_DELETE_CONTACTS' =>  rand(0, 1) === 1,
            'CAN_VIEW_CONTACTS' => rand(0, 1) === 1,
            'CAN_INDEX_CONTACTS' => rand(0, 1) === 1,
            default => false,
        };


        return false;
    }
}
