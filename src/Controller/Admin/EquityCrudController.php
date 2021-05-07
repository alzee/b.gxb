<?php

namespace App\Controller\Admin;

use App\Entity\Equity;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EquityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equity::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '股权交易记录')
            ->setSearchFields(['id', 'ratio'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new');
    }

    public function configureFields(string $pageName): iterable
    {
        $date = DateTimeField::new('date');
        $ratio = TextField::new('ratio');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $date, $ratio];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $date, $ratio];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$date, $ratio];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$date, $ratio];
        }
    }
}
