<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219003942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE land_trade (id INT AUTO_INCREMENT NOT NULL, land_id INT DEFAULT NULL, seller_id INT DEFAULT NULL, buyer_id INT DEFAULT NULL, price VARCHAR(255) NOT NULL, INDEX IDX_9C31CD491994904A (land_id), INDEX IDX_9C31CD498DE820D9 (seller_id), INDEX IDX_9C31CD496C755722 (buyer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE land_trade ADD CONSTRAINT FK_9C31CD491994904A FOREIGN KEY (land_id) REFERENCES land (id)');
        $this->addSql('ALTER TABLE land_trade ADD CONSTRAINT FK_9C31CD498DE820D9 FOREIGN KEY (seller_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE land_trade ADD CONSTRAINT FK_9C31CD496C755722 FOREIGN KEY (buyer_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE land_trade');
    }
}
