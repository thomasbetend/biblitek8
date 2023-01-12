<?php

namespace App\Controller\Admin;

use App\Entity\PostShare;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PostShareCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostShare::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextEditorField::new('description');
        yield TextEditorField::new('image');
        yield CollectionField::new('postImages');
        yield DateField::new('updatedAt');
        yield DateField::new('createdAt');
    }
}
