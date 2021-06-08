<?php

namespace App\Controller\Admin;

use App\Entity\Finance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;

class FinanceCrudController extends AbstractCrudController
{
    private $types = [
        '任务发布' => 1,
        '任务置顶' => 2,
        '任务推荐' => 3,
        '任务竞价' => 4,
        '购买股权' => 5,
        '占领格子' => 6,
        '购买领地' => 7,
        '购买会员' => 8,
        '奖励提现' => 18,
        '余额提现' => 19,
        '充值' => 50,
        '任务分销奖励1级' => 51,
        '任务分销奖励2级' => 52,
        '任务奖励' => 53,
        '出售股权' => 54,
        '出售领地' => 55,
        '解冻-任务下架' => 56,
        '格子收益' => 57,
        '购买会员返利' => 58,
        '全民分红' => 59,
        '退款-首页竞价' => 60,
        '解冻-任务审核拒绝' => 61,
    ];
    private $methods = ['余额' => 0, '微信' => 1, '支付宝' => 2, '提现至微信(手动)' => 11, '提现至支付宝(手动)' => 12, '提现至微信' => 13, '提现至支付宝' => 14];
    private $statuses = ['待处理' => 0, '处理中' => 1, '失败' => 4, '已完成' => 5];

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

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('user'))
            ->add(ChoiceFilter::new('type')->setChoices($this->types))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $note = TextField::new('note');
        $date = DateTimeField::new('date');
        $amount = MoneyField::new('amount')->setCurrency('CNY');
        $prepayid = TextField::new('prepayid');
        $orderid = TextField::new('orderid');
        $wxOrderid = TextField::new('wx_orderid');
        $type = ChoiceField::new('type')->setChoices($this->types);
        $status = ChoiceField::new('status')->setChoices($this->statuses);
        $method = ChoiceField::new('method')->setChoices($this->methods);
        $couponId = IntegerField::new('couponId');
        $fee = MoneyField::new('fee')->setCurrency('CNY');
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
