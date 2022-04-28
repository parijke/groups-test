<?php

namespace App\Controller\Admin;

use App\Entity\Permission;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PermissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Permission::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
