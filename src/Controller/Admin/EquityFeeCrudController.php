<?php

namespace App\Controller\Admin;

use App\Entity\EquityFee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquityFeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquityFee::class;
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
