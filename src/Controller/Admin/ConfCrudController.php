<?php

namespace App\Controller\Admin;

use App\Entity\Conf;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

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
            IntegerField::new('landMinDays', 'landMinDays')->hideOnIndex(),
            IntegerField::new('maxPerDay', 'maxPerDay')->hideOnIndex(),
            NumberField::new('equityGXBRate', 'equityGXBRate')->hideOnIndex(),
            NumberField::new('equityPrice', 'equityPrice')->hideOnIndex(),
            NumberField::new('equityPriceMax', 'equityPriceMax')->hideOnIndex(),
            NumberField::new('equityPriceMin', 'equityPriceMin')->hideOnIndex(),
            NumberField::new('dividendFund', 'dividendFund')->hideOnIndex(),
        ];
    }
}
