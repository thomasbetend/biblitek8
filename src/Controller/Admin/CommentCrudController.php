<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Form\PostShareAdminType;
use App\Form\PostShareType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('content'),
            CollectionField::new('postShare')
                ->setEntryType(PostShareAdminType::class),
        ];
    }

}
