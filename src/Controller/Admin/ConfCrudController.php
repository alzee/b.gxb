<?php

namespace App\Controller\Admin;

use App\Entity\Conf;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ConfCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conf::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new', 'delete')
            ->remove('detail', 'index')
        ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(null)
            // ->setPaginatorPageSize(50)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('equity', 'equityTotal'),
            NumberField::new('referReward', 'referReward'),
            NumberField::new('referReward2', 'referReward2'),
            IntegerField::new('referGXB', 'referGXB'),
            NumberField::new('mainlandMinPrice', 'mainlandMinPrice'),
            NumberField::new('landMinPrice', 'landMinPrice'),
            IntegerField::new('mainlandMinDays', 'mainlandMinDays'),
            IntegerField::new('landMinDays', 'landMinDays'),
            IntegerField::new('maxPerDay', 'maxPerDay'),
            NumberField::new('equityGXBRate', 'equityGXBRate'),
            NumberField::new('equityPrice', 'equityPrice'),
            NumberField::new('equityPriceMax', 'equityPriceMax'),
            NumberField::new('equityPriceMin', 'equityPriceMin'),
            NumberField::new('dividendFund', 'dividendFund'),
            BooleanField::new('forceUpdate', 'forceUpdate'),
        ];
    }
}
