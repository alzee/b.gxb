<?php

namespace App\Controller\Admin;

use App\Entity\Exchange;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class ExchangeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exchange::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail')
            ->disable('new', 'edit', 'delete')
        ;
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
