<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '任务类别')
            ->setSearchFields(['id', 'name', 'label', 'rate'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('show');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $rate = MoneyField::new('rate', 'cate.rate')->setCurrency('CNY')->setStoredAsCents(false);
        $id = IntegerField::new('id', 'ID');
        $label = TextField::new('label');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $rate];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $rate];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $rate];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $rate];
        }
    }
}
