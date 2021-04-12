<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412100112 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77848DB60186');
        $this->addSql('DROP INDEX UNIQ_C42F77848DB60186 ON report');
        $this->addSql('ALTER TABLE report ADD desc_a VARCHAR(255) DEFAULT NULL, ADD pics_a LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD desc_b VARCHAR(255) DEFAULT NULL, ADD pics_b LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', DROP description, CHANGE task_id apply_id INT NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77844DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77844DDCCBDE ON report (apply_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844DDCCBDE');
        $this->addSql('DROP INDEX UNIQ_C42F77844DDCCBDE ON report');
        $this->addSql('ALTER TABLE report ADD description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP desc_a, DROP pics_a, DROP desc_b, DROP pics_b, CHANGE apply_id task_id INT NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77848DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77848DB60186 ON report (task_id)');
    }
}
