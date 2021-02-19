<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219002733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE land DROP INDEX UNIQ_A800D5D87E3C61F9, ADD INDEX IDX_A800D5D87E3C61F9 (owner_id)');
        $this->addSql('ALTER TABLE land ADD code VARCHAR(255) NOT NULL, ADD name VARCHAR(255) DEFAULT NULL, DROP topic, DROP city, CHANGE owner_id owner_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE land DROP INDEX IDX_A800D5D87E3C61F9, ADD UNIQUE INDEX UNIQ_A800D5D87E3C61F9 (owner_id)');
        $this->addSql('ALTER TABLE land ADD city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP name, CHANGE owner_id owner_id INT NOT NULL, CHANGE code topic VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
