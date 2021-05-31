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
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

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
            ->setSearchFields(['id'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail')
            ->disable('new', 'edit', 'delete', 'detail');
    }

    public function configureFields(string $pageName): iterable
    {
        $date = DateTimeField::new('date');
        $user = AssociationField::new('user');
        $id = IntegerField::new('id', 'ID');
        $amount = MoneyField::new('amount')->setCurrency('CNY');
        $coin = IntegerField::new('coin', 'coinUser');
        $coinTotal = IntegerField::new('coinTotal');
        $fund = MoneyField::new('fund')->setCurrency('CNY');
        $coinThreshold = IntegerField::new('coinThreshold');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $user, $date, $amount, $coin, $coinTotal, $fund, $coinThreshold];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $date];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$date];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$date];
        }
    }
}
