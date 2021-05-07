<?php

namespace App\Controller\Admin;

use App\Entity\LandTrade;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LandTradeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LandTrade::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '领地交易记录')
            ->setSearchFields(['id', 'price'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new');
    }

    public function configureFields(string $pageName): iterable
    {
        $price = TextField::new('price');
        $date = DateTimeField::new('date');
        $land = AssociationField::new('land');
        $seller = AssociationField::new('seller');
        $buyer = AssociationField::new('buyer');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $price, $date, $land, $seller, $buyer];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $price, $date, $land, $seller, $buyer];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$price, $date, $land, $seller, $buyer];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$price, $date, $land, $seller, $buyer];
        }
    }
}
