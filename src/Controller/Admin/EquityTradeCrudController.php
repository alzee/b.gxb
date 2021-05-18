<?php

namespace App\Controller\Admin;

use App\Entity\EquityTrade;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquityTradeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquityTrade::class;
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
