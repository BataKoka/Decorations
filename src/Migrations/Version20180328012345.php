<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180328012345 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE locations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE locations (id INT NOT NULL, location_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, percentage INT DEFAULT 0 NOT NULL, is_active BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17E64ABA5E237E06 ON locations (name)');
        $this->addSql('CREATE INDEX IDX_17E64ABA2B099F37 ON locations (location_type_id)');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA2B099F37 FOREIGN KEY (location_type_id) REFERENCES location_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE locations_id_seq CASCADE');
        $this->addSql('DROP TABLE locations');
    }
}
