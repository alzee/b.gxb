<?php

namespace App\Controller\Admin;

use App\Entity\Dividend;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DividendCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dividend::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '分红记录')
            ->setSearchFields(['id', 'total', 'share'])
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
        $total = NumberField::new('total');
        $share = TextField::new('share');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $date, $total, $share];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $date, $total, $share];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$date, $total, $share];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$date, $total, $share];
        }
    }
}
