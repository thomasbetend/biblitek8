<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield Field::new('email');
        yield Field::new('plainPassword');
        yield Field::new('pseudo');
        yield Field::new('avatar');
        yield CollectionField::new('postShares');
        yield Field::new('plainPassword')
            ->setHelp('let it empty not to change')
            ->onlyOnForms();
    }
}
