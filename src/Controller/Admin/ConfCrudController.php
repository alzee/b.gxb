<?php

namespace App\Controller\Admin;

use App\Entity\Conf;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

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
            PercentField::new('referReward', 'referReward'),
            PercentField::new('referReward2', 'referReward2'),
            IntegerField::new('referGXB', 'referGXB'),
            MoneyField::new('landPrice', 'landPrice')->setCurrency('CNY'),
            MoneyField::new('mainCellMinPrice', 'mainCellMinPrice')->setCurrency('CNY')->setStoredAsCents(false),
            MoneyField::new('cellMinPrice', 'cellMinPrice')->setCurrency('CNY')->setStoredAsCents(false),
            IntegerField::new('mainCellMinDays', 'mainCellMinDays'),
            IntegerField::new('cellMinDays', 'cellMinDays'),
            IntegerField::new('maxPerDay', 'maxPerDay'),
            NumberField::new('equityGXBRate', 'equityGXBRate'),
            MoneyField::new('equityPrice', 'equityPrice')->setCurrency('CNY')->setStoredAsCents(false),
            MoneyField::new('equityPriceMax', 'equityPriceMax')->setCurrency('CNY')->setStoredAsCents(false),
            MoneyField::new('equityPriceMin', 'equityPriceMin')->setCurrency('CNY')->setStoredAsCents(false),
            MoneyField::new('dividendFund', 'dividendFund')->setCurrency('CNY')->setStoredAsCents(false),
            IntegerField::new('coinsPerYuan', 'coinsPerYuan'),
            IntegerField::new('coinThreshold', 'coinThreshold'),
            TextEditorField::new('welcome', 'welcome'),
            BooleanField::new('forceUpdate', 'forceUpdate'),
        ];
    }
}
