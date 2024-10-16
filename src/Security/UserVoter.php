<?php

// src/Security/PostVoter.php
namespace App\Security;

use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\CaseStudy;
use App\Entity\RestaurantDetails;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;

class UserVoter extends Voter
{
    public function __construct(
        private Security $security,
    ) {}

    protected function supports(string $attribute, $subject): bool
    {
               // Zdefiniuj, jakie atrybuty i typy obiektów są obsługiwane
        return in_array($attribute, ['VIEW', 'EDIT'])
            && $subject instanceof RestaurantDetails;
       
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
    //    $user = $token->getUser();

    //     // Sprawdź, czy użytkownik jest zalogowany
    //     if (!$user instanceof User) {
    //         return false;
    //     }

    //     switch ($attribute) {
    //         case 'VIEW':
    //             return $this->canView($subject, $user);
    //         case 'EDIT':
    //             //return $this->canEdit($subject, $user);
    //     }
        return true;
    }

    private function canView(RestaurantDetails $restaurant, User $user)
    {
        return $restaurant->getCustomer()->getId() === $user->getCustomer()->getId()    ; // Użytkownik może widzieć, jeśli jest właścicielem
    }
}