<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127050512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apply (id INT AUTO_INCREMENT NOT NULL, task_id INT NOT NULL, applicant_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_BD2F8C1F8DB60186 (task_id), INDEX IDX_BD2F8C1F97139001 (applicant_id), INDEX IDX_BD2F8C1F6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F8DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F97139001 FOREIGN KEY (applicant_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('DROP TABLE task_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F6BF700BD');
        $this->addSql('CREATE TABLE task_user (task_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE204232A76ED395 (user_id), INDEX IDX_FE2042328DB60186 (task_id), PRIMARY KEY(task_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE2042328DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE204232A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE apply');
        $this->addSql('DROP TABLE status');
    }
}
