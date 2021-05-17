<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517172530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649798C22DB FOREIGN KEY (referrer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B47C99C0 FOREIGN KEY (ror_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_coupon ADD CONSTRAINT FK_1ED243FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_coupon ADD CONSTRAINT FK_1ED243F66C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vip ADD CONSTRAINT FK_4B076C22534B549B FOREIGN KEY (uid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564460D9FD7 FOREIGN KEY (node_id) REFERENCES node (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68804DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F8DB60186');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F97139001');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F6BF700BD');
        $this->addSql('ALTER TABLE bid DROP FOREIGN KEY FK_4AF2B3F38DB60186');
        $this->addSql('ALTER TABLE coin DROP FOREIGN KEY FK_5569975DA76ED395');
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC6C755722');
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC8DE820D9');
        $this->addSql('ALTER TABLE exchange DROP FOREIGN KEY FK_D33BB079A76ED395');
        $this->addSql('ALTER TABLE finance DROP FOREIGN KEY FK_CE28EAE0A76ED395');
        $this->addSql('ALTER TABLE gxb DROP FOREIGN KEY FK_F683F73DA76ED395');
        $this->addSql('ALTER TABLE land DROP FOREIGN KEY FK_A800D5D87E3C61F9');
        $this->addSql('ALTER TABLE land_post DROP FOREIGN KEY FK_C97E57441994904A');
        $this->addSql('ALTER TABLE land_post DROP FOREIGN KEY FK_C97E57447E3C61F9');
        $this->addSql('ALTER TABLE land_trade DROP FOREIGN KEY FK_9C31CD491994904A');
        $this->addSql('ALTER TABLE land_trade DROP FOREIGN KEY FK_9C31CD498DE820D9');
        $this->addSql('ALTER TABLE land_trade DROP FOREIGN KEY FK_9C31CD496C755722');
        $this->addSql('ALTER TABLE node DROP FOREIGN KEY FK_857FE845F675F31B');
        $this->addSql('ALTER TABLE node DROP FOREIGN KEY FK_857FE845C54C8C93');
        $this->addSql('ALTER TABLE `read` DROP FOREIGN KEY FK_98574167A76ED395');
        $this->addSql('ALTER TABLE `read` DROP FOREIGN KEY FK_985741674B89032C');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844DDCCBDE');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB257E3C61F9');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25FFE6496F');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2512469DE2');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256BF700BD');
        $this->addSql('ALTER TABLE task_tag DROP FOREIGN KEY FK_6C0B4F048DB60186');
        $this->addSql('ALTER TABLE task_tag DROP FOREIGN KEY FK_6C0B4F04BAD26311');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6495FB14BA7');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649798C22DB');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649B47C99C0');
        $this->addSql('ALTER TABLE user_coupon DROP FOREIGN KEY FK_1ED243FA76ED395');
        $this->addSql('ALTER TABLE user_coupon DROP FOREIGN KEY FK_1ED243F66C5951B');
        $this->addSql('ALTER TABLE vip DROP FOREIGN KEY FK_4B076C22534B549B');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564A76ED395');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564460D9FD7');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E68804DDCCBDE');
    }
}
