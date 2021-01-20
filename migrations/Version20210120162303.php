<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120162303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task ADD platform_id INT NOT NULL, DROP platform');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25FFE6496F ON task (platform_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25FFE6496F');
        $this->addSql('DROP INDEX UNIQ_527EDB25FFE6496F ON task');
        $this->addSql('ALTER TABLE task ADD platform VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP platform_id');
    }
}
