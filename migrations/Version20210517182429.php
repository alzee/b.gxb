<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517182429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apply (id INT AUTO_INCREMENT NOT NULL, task_id INT NOT NULL, applicant_id INT NOT NULL, status_id INT NOT NULL, date DATETIME NOT NULL, pic LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', submit_at DATETIME DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_BD2F8C1F8DB60186 (task_id), INDEX IDX_BD2F8C1F97139001 (applicant_id), INDEX IDX_BD2F8C1F6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bid (id INT AUTO_INCREMENT NOT NULL, task_id INT NOT NULL, price INT NOT NULL, position INT NOT NULL, date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_buy_now TINYINT(1) DEFAULT NULL, INDEX IDX_4AF2B3F38DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) DEFAULT NULL, rate DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coin (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount INT NOT NULL, type SMALLINT NOT NULL, INDEX IDX_5569975DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conf (id INT AUTO_INCREMENT NOT NULL, equity INT NOT NULL, refer_reward DOUBLE PRECISION NOT NULL, refer_reward2 DOUBLE PRECISION NOT NULL, refer_gxb SMALLINT NOT NULL, mainland_min_price DOUBLE PRECISION NOT NULL, land_min_price DOUBLE PRECISION NOT NULL, mainland_min_days SMALLINT NOT NULL, land_min_days SMALLINT NOT NULL, max_per_day INT NOT NULL, equity_gxbrate DOUBLE PRECISION NOT NULL, equity_price DOUBLE PRECISION NOT NULL, equity_price_max DOUBLE PRECISION NOT NULL, equity_price_min DOUBLE PRECISION NOT NULL, dividend_fund DOUBLE PRECISION NOT NULL, force_update TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, value INT DEFAULT NULL, type SMALLINT DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dividend (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, total DOUBLE PRECISION NOT NULL, share VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equity (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, ratio VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equity_fee (id INT AUTO_INCREMENT NOT NULL, l1 INT NOT NULL, l2 INT NOT NULL, rate DOUBLE PRECISION NOT NULL, is_star TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equity_trade (id INT AUTO_INCREMENT NOT NULL, buyer_id INT DEFAULT NULL, seller_id INT NOT NULL, equity INT NOT NULL, rmb INT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status SMALLINT NOT NULL, INDEX IDX_222DAC6C755722 (buyer_id), INDEX IDX_222DAC8DE820D9 (seller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exchange (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, equity INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', gxb INT NOT NULL, INDEX IDX_D33BB079A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, amount INT NOT NULL, prepayid VARCHAR(255) DEFAULT NULL, orderid VARCHAR(255) DEFAULT NULL, wx_orderid VARCHAR(255) DEFAULT NULL, type INT DEFAULT NULL, status SMALLINT DEFAULT NULL, coupon_id SMALLINT DEFAULT NULL, fee INT DEFAULT NULL, method SMALLINT DEFAULT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', wxpay_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_CE28EAE0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gxb (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount INT NOT NULL, type SMALLINT DEFAULT NULL, INDEX IDX_F683F73DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE land (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, for_sale TINYINT(1) NOT NULL, pre_price INT DEFAULT NULL, update_at DATETIME DEFAULT NULL, INDEX IDX_A800D5D87E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE land_post (id INT AUTO_INCREMENT NOT NULL, land_id INT DEFAULT NULL, owner_id INT DEFAULT NULL, price INT NOT NULL, days INT NOT NULL, title VARCHAR(255) DEFAULT NULL, body VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, pics LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', show_until DATETIME DEFAULT NULL, INDEX IDX_C97E57441994904A (land_id), INDEX IDX_C97E57447E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE land_trade (id INT AUTO_INCREMENT NOT NULL, land_id INT DEFAULT NULL, seller_id INT DEFAULT NULL, buyer_id INT DEFAULT NULL, price VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9C31CD491994904A (land_id), INDEX IDX_9C31CD498DE820D9 (seller_id), INDEX IDX_9C31CD496C755722 (buyer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, task_least INT NOT NULL, post_fee DOUBLE PRECISION DEFAULT NULL, withdraw_fee DOUBLE PRECISION DEFAULT NULL, days INT NOT NULL, task_limit SMALLINT DEFAULT NULL, sticky_price SMALLINT DEFAULT NULL, recommend_price SMALLINT DEFAULT NULL, land_trade_ratio DOUBLE PRECISION DEFAULT NULL, topup_ratio DOUBLE PRECISION DEFAULT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE node (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', body LONGTEXT DEFAULT NULL, approved TINYINT(1) NOT NULL, INDEX IDX_857FE845F675F31B (author_id), INDEX IDX_857FE845C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE node_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `read` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, post_id INT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_98574167A76ED395 (user_id), INDEX IDX_985741674B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, apply_id INT NOT NULL, desc_a VARCHAR(255) DEFAULT NULL, pics_a LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', desc_b VARCHAR(255) DEFAULT NULL, pics_b LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_C42F77844DDCCBDE (apply_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, platform_id INT DEFAULT NULL, category_id INT NOT NULL, status_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, quantity INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', bid_position INT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, guides LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', reviews LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', sticky_until DATETIME DEFAULT NULL, recommend_until DATETIME DEFAULT NULL, show_until DATETIME DEFAULT NULL, work_hours INT DEFAULT NULL, review_hours INT DEFAULT NULL, INDEX IDX_527EDB257E3C61F9 (owner_id), INDEX IDX_527EDB25FFE6496F (platform_id), INDEX IDX_527EDB2512469DE2 (category_id), INDEX IDX_527EDB256BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_tag (task_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_6C0B4F048DB60186 (task_id), INDEX IDX_6C0B4F04BAD26311 (tag_id), PRIMARY KEY(task_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, level_id INT DEFAULT NULL, referrer_id INT DEFAULT NULL, ror_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nick VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, topup INT DEFAULT NULL, earnings INT DEFAULT NULL, gxb INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, equity INT DEFAULT NULL, frozen INT DEFAULT NULL, refcode VARCHAR(255) DEFAULT NULL, coin INT DEFAULT NULL, date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', vip_until DATETIME DEFAULT NULL, cell_profit INT DEFAULT NULL, land_profit INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D6495FB14BA7 (level_id), INDEX IDX_8D93D649798C22DB (referrer_id), INDEX IDX_8D93D649B47C99C0 (ror_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_coupon (user_id INT NOT NULL, coupon_id INT NOT NULL, INDEX IDX_1ED243FA76ED395 (user_id), INDEX IDX_1ED243F66C5951B (coupon_id), PRIMARY KEY(user_id, coupon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vip (id INT AUTO_INCREMENT NOT NULL, uid_id INT DEFAULT NULL, level VARCHAR(255) NOT NULL, date DATETIME NOT NULL, days INT NOT NULL, UNIQUE INDEX UNIQ_4B076C22534B549B (uid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, node_id INT DEFAULT NULL, is_up TINYINT(1) NOT NULL, date DATETIME NOT NULL, INDEX IDX_5A108564A76ED395 (user_id), INDEX IDX_5A108564460D9FD7 (node_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, apply_id INT DEFAULT NULL, img_url VARCHAR(255) DEFAULT NULL, INDEX IDX_534E68804DDCCBDE (apply_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F8DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F97139001 FOREIGN KEY (applicant_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE bid ADD CONSTRAINT FK_4AF2B3F38DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE coin ADD CONSTRAINT FK_5569975DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC6C755722 FOREIGN KEY (buyer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC8DE820D9 FOREIGN KEY (seller_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE exchange ADD CONSTRAINT FK_D33BB079A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE finance ADD CONSTRAINT FK_CE28EAE0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE gxb ADD CONSTRAINT FK_F683F73DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE land ADD CONSTRAINT FK_A800D5D87E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE land_post ADD CONSTRAINT FK_C97E57441994904A FOREIGN KEY (land_id) REFERENCES land (id)');
        $this->addSql('ALTER TABLE land_post ADD CONSTRAINT FK_C97E57447E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE land_trade ADD CONSTRAINT FK_9C31CD491994904A FOREIGN KEY (land_id) REFERENCES land (id)');
        $this->addSql('ALTER TABLE land_trade ADD CONSTRAINT FK_9C31CD498DE820D9 FOREIGN KEY (seller_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE land_trade ADD CONSTRAINT FK_9C31CD496C755722 FOREIGN KEY (buyer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE node ADD CONSTRAINT FK_857FE845F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE node ADD CONSTRAINT FK_857FE845C54C8C93 FOREIGN KEY (type_id) REFERENCES node_type (id)');
        $this->addSql('ALTER TABLE `read` ADD CONSTRAINT FK_98574167A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `read` ADD CONSTRAINT FK_985741674B89032C FOREIGN KEY (post_id) REFERENCES land_post (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77844DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB257E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT FK_6C0B4F048DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT FK_6C0B4F04BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649798C22DB FOREIGN KEY (referrer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649B47C99C0 FOREIGN KEY (ror_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_coupon ADD CONSTRAINT FK_1ED243FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_coupon ADD CONSTRAINT FK_1ED243F66C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vip ADD CONSTRAINT FK_4B076C22534B549B FOREIGN KEY (uid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564460D9FD7 FOREIGN KEY (node_id) REFERENCES node (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68804DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id)');

        // insert some
        $this->addSql('insert into user (username,roles,password) values (\'al\',\'["ROLE_ADMIN","ROLE_ROOT"]\',\'$argon2id$v=19$m=65536,t=4,p=1$rB/yf3xkfuYC2jUKscXgEA$Jc0Rhypda+svV6TnooA91yzCpz7jPVISSt5csz0eAGg\'),(\'admin\',\'["ROLE_ADMIN"]\',\'$argon2id$v=19$m=65536,t=4,p=1$MkdxUzXE2cMBkNcYwUHOHw$K1uRSs3ZDynS70xv8kYrDolFJwC/yCr1nG1NfHdnNkA\')');
        $this->addSql('INSERT INTO `conf` VALUES (1,99999,0.08,0.02,100,1,0.05,1,20,10000,0.001,18.88,1,0.01,100,0)');
        $this->addSql('INSERT INTO `coupon` VALUES (1,500,1,\'任务发布\'),(2,500,2,\'任务置顶\'),(3,500,3,\'任务推荐\'),(4,500,8,\'VIP充值\')');
        $this->addSql('INSERT INTO `equity_fee` VALUES (1,0,0,0.95,0),(2,1,1,0.9,0),(3,3,3,0.85,0),(4,5,10,0.8,0),(5,10,20,0.75,0),(6,20,50,0.7,0),(7,30,60,0.65,0),(8,50,100,0.6,0),(9,80,200,0.55,0),(10,100,300,0.5,0),(11,200,600,0.45,0),(12,300,1000,0.4,0),(13,500,2000,0.35,0),(14,1000,3000,0.3,0),(15,2000,6000,0.25,0),(16,3000,10000,0.2,0),(17,5000,20000,0.15,0)');
        $this->addSql('INSERT INTO `level` VALUES (1,\'体验卡\',10,5,0.1,0.05,2,0,5,2,0.2,0.1,1),(2,\'周卡\',28,5,0.1,0.05,7,0,5,2,0.2,0.1,2),(3,\'月卡\',68,5,0.1,0.05,30,0,5,2,0.25,0.15,3),(4,\'季卡\',188,5,0.1,0.05,90,0,5,2,0.3,0.2,4),(5,\'年卡\',688,5,0.1,0.05,360,0,5,2,0.35,0.25,5),(6,\'银卡\',1288,3,0.1,0.05,720,0,5,2,0.4,0.3,6),(7,\'金卡\',1688,2,0.1,0.05,1080,0,5,2,0.45,0.35,7),(8,\'钻卡\',2688,1,0.1,0.05,1800,0,5,2,0.5,0.4,8),(9,\'普通会员\',0,10,0.15,0.1,0,3,10,5,0.2,0.1,0)');
        $this->addSql('INSERT INTO `node_type` VALUES (1,\'股东大会\'),(2,\'股东话题\'),(3,\'新闻\'),(4,\'条款\')');
        $this->addSql('INSERT INTO `status` VALUES (1,\'待审核\',NULL),(2,\'已审核\',NULL),(3,\'已暂停\',NULL),(4,\'已下架\',NULL),(5,\'审核拒绝\',NULL),(11,\'待提交\',NULL),(12,\'验收中\',NULL),(13,\'不合格\',NULL),(14,\'已完成\',NULL)');
        $this->addSql('INSERT INTO `node` (id,title,date,body,author_id,approved,type_id) VALUES (1,\'用户协议\',\'2021-04-23 05:12:00\',\'\',2,1,4),(2,\'隐私条款\',\'2021-04-23 05:12:00\',\'\',2,1,4),(3,\'联系客服\',\'2021-04-23 05:12:55\',\'\',2,1,4),(4,\'常见问题\',\'2021-04-23 05:13:09\',\'\',2,1,4),(5,\'关于我们\',\'2021-04-23 05:13:25\',\'\',2,1,4),(6,\'发布规则\',\'2021-04-23 05:13:47\',\'\',2,1,4),(7,\'领地规则\',\'2021-04-23 05:14:10\',\'\',2,1,4),(8,\'分红说明\',\'2021-04-23 05:14:23\',\'\',2,1,4),(9,\'兑换说明\',\'2021-04-23 05:14:31\',\'\',2,1,4),(10,\'竞价规则\',\'2021-04-23 05:14:00\',\'\',2,1,4),(11,\'推广说明\',\'2021-04-23 05:14:00\',\'\',2,1,4),(12,\'排行榜说明\',\'2021-04-23 05:14:00\',\'\',2,1,4)');
        $this->addSql('INSERT INTO `category` VALUES (1,\'下载APP\',\'download\',1),(2,\'账号注册\',\'register\',0.5),(3,\'认证/绑卡\',\'authen\',2),(4,\'小视频点赞/评论/关注/收藏/转发\',\'ecomm\',0.2),(5,\'简单关注/投票\',\'follow\',0.2),(6,\'简单转发/采集\',\'forward\',0.2),(7,\'助力/砍价\',\'poll\',0.2),(8,\'推广引流\',\'promo\',1),(9,\'直播间任务\',\'other\',0.2),(10,\'电商相关\',\'\',0.5),(11,\'问卷调查\',NULL,0.5),(12,\'其他任务\',NULL,0.5)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844DDCCBDE');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E68804DDCCBDE');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2512469DE2');
        $this->addSql('ALTER TABLE user_coupon DROP FOREIGN KEY FK_1ED243F66C5951B');
        $this->addSql('ALTER TABLE land_post DROP FOREIGN KEY FK_C97E57441994904A');
        $this->addSql('ALTER TABLE land_trade DROP FOREIGN KEY FK_9C31CD491994904A');
        $this->addSql('ALTER TABLE `read` DROP FOREIGN KEY FK_985741674B89032C');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6495FB14BA7');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564460D9FD7');
        $this->addSql('ALTER TABLE node DROP FOREIGN KEY FK_857FE845C54C8C93');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25FFE6496F');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F6BF700BD');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256BF700BD');
        $this->addSql('ALTER TABLE task_tag DROP FOREIGN KEY FK_6C0B4F04BAD26311');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F8DB60186');
        $this->addSql('ALTER TABLE bid DROP FOREIGN KEY FK_4AF2B3F38DB60186');
        $this->addSql('ALTER TABLE task_tag DROP FOREIGN KEY FK_6C0B4F048DB60186');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F97139001');
        $this->addSql('ALTER TABLE coin DROP FOREIGN KEY FK_5569975DA76ED395');
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC6C755722');
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC8DE820D9');
        $this->addSql('ALTER TABLE exchange DROP FOREIGN KEY FK_D33BB079A76ED395');
        $this->addSql('ALTER TABLE finance DROP FOREIGN KEY FK_CE28EAE0A76ED395');
        $this->addSql('ALTER TABLE gxb DROP FOREIGN KEY FK_F683F73DA76ED395');
        $this->addSql('ALTER TABLE land DROP FOREIGN KEY FK_A800D5D87E3C61F9');
        $this->addSql('ALTER TABLE land_post DROP FOREIGN KEY FK_C97E57447E3C61F9');
        $this->addSql('ALTER TABLE land_trade DROP FOREIGN KEY FK_9C31CD498DE820D9');
        $this->addSql('ALTER TABLE land_trade DROP FOREIGN KEY FK_9C31CD496C755722');
        $this->addSql('ALTER TABLE node DROP FOREIGN KEY FK_857FE845F675F31B');
        $this->addSql('ALTER TABLE `read` DROP FOREIGN KEY FK_98574167A76ED395');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB257E3C61F9');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649798C22DB');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649B47C99C0');
        $this->addSql('ALTER TABLE user_coupon DROP FOREIGN KEY FK_1ED243FA76ED395');
        $this->addSql('ALTER TABLE vip DROP FOREIGN KEY FK_4B076C22534B549B');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564A76ED395');
        $this->addSql('DROP TABLE apply');
        $this->addSql('DROP TABLE bid');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE coin');
        $this->addSql('DROP TABLE conf');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE dividend');
        $this->addSql('DROP TABLE equity');
        $this->addSql('DROP TABLE equity_fee');
        $this->addSql('DROP TABLE equity_trade');
        $this->addSql('DROP TABLE exchange');
        $this->addSql('DROP TABLE finance');
        $this->addSql('DROP TABLE gxb');
        $this->addSql('DROP TABLE land');
        $this->addSql('DROP TABLE land_post');
        $this->addSql('DROP TABLE land_trade');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP TABLE node');
        $this->addSql('DROP TABLE node_type');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE `read`');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_tag');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_coupon');
        $this->addSql('DROP TABLE vip');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE work');
    }
}
