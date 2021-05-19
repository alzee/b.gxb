<?php

namespace App\Controller\Admin;

use App\Entity\Finance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class FinanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Finance::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '财务明细')
            ->setSearchFields(['id', 'note', 'amount', 'prepayid', 'orderid', 'wx_orderid', 'type', 'status', 'couponId', 'fee', 'method', 'data', 'wxpayData'])
            ->setPaginatorPageSize(50)
            ->setDefaultSort(['id' => 'DESC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail')
            ->disable('new', 'edit', 'delete');
    }

    public function configureFields(string $pageName): iterable
    {
        $note = TextField::new('note');
        $date = DateTimeField::new('date');
        $amount = MoneyField::new('amount')->setCurrency('CNY');
        $prepayid = TextField::new('prepayid');
        $orderid = TextField::new('orderid');
        $wxOrderid = TextField::new('wx_orderid');
        $type = IntegerField::new('type');
        $status = IntegerField::new('status');
        $couponId = IntegerField::new('couponId');
        $fee = MoneyField::new('fee')->setCurrency('CNY');
        $method = IntegerField::new('method');
        $data = ArrayField::new('data');
        $wxpayData = ArrayField::new('wxpayData');
        $user = AssociationField::new('user');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $user, $note, $date, $amount, $fee, $couponId, $method, $type, $status];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $note, $date, $amount, $prepayid, $orderid, $wxOrderid, $type, $status, $couponId, $fee, $method, $user];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$note, $date, $amount, $prepayid, $orderid, $wxOrderid, $type, $status, $couponId, $fee, $method,  $user];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$note, $date, $amount, $prepayid, $orderid, $wxOrderid, $type, $status, $couponId, $fee, $method,  $user];
        }
    }
}
