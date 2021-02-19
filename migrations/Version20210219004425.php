<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219004425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE land_post (id INT AUTO_INCREMENT NOT NULL, land_id INT DEFAULT NULL, owner_id INT DEFAULT NULL, price VARCHAR(255) NOT NULL, days INT NOT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, INDEX IDX_C97E57441994904A (land_id), INDEX IDX_C97E57447E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE land_post ADD CONSTRAINT FK_C97E57441994904A FOREIGN KEY (land_id) REFERENCES land (id)');
        $this->addSql('ALTER TABLE land_post ADD CONSTRAINT FK_C97E57447E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE land_post');
    }
}
