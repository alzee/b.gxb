<?php

namespace App\Controller\Admin;

use App\Entity\EquityTrade;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class EquityTradeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquityTrade::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(50)
            ->setDefaultSort(['id' => 'DESC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', Action::DETAIL)
            ->disable('new', 'edit', 'delete')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'ID');
        $equity = IntegerField::new('equity');
        $price = MoneyField::new('rmb', 'amount')->setCurrency('CNY');
        $date = DateTimeField::new('date');
        $status = IntegerField::new('status');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $equity, $price, $date, $status];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $equity, $price, $date, $status];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$id, $equity, $price, $date, $status];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$id, $equity, $price, $date, $status];
        }
    }
}
