<?php

namespace App\Controller\Admin;

use App\Entity\Level;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LevelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Level::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '会员等级')
            ->setSearchFields(['id', 'name', 'price', 'taskLeast', 'postFee', 'withdrawFee', 'days', 'taskLimit', 'stickyPrice', 'recommendPrice', 'landTradeRatio', 'topupRatio', 'level'])
            ->setDefaultSort(['level' => 'ASC'])
            ->setPaginatorPageSize(50);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $price = MoneyField::new('price')->setCurrency('CNY')->setStoredAsCents(false);
        $days = IntegerField::new('days');
        $taskLimit = IntegerField::new('taskLimit');
        $postFee = PercentField::new('postFee');
        $withdrawFee = PercentField::new('withdrawFee');
        $stickyPrice = MoneyField::new('stickyPrice')->setCurrency('CNY')->setStoredAsCents(false);
        $recommendPrice = MoneyField::new('recommendPrice')->setCurrency('CNY')->setStoredAsCents(false);
        $landTradeRatio = PercentField::new('landTradeRatio');
        $topupRatio = PercentField::new('topupRatio');
        $taskLeast = IntegerField::new('taskLeast');
        $id = IntegerField::new('id', 'ID');
        $level = IntegerField::new('level');
        $users = AssociationField::new('users');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$level, $name, $price, $days, $taskLimit, $postFee, $withdrawFee, $stickyPrice, $recommendPrice, $landTradeRatio, $topupRatio, $taskLeast];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $price, $taskLeast, $postFee, $withdrawFee, $days, $taskLimit, $stickyPrice, $recommendPrice, $landTradeRatio, $topupRatio, $level, $users];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$level, $name, $price, $days, $taskLimit, $postFee, $withdrawFee, $stickyPrice, $recommendPrice, $landTradeRatio, $topupRatio, $taskLeast];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$level, $name, $price, $days, $taskLimit, $postFee, $withdrawFee, $stickyPrice, $recommendPrice, $landTradeRatio, $topupRatio, $taskLeast];
        }
    }
}
