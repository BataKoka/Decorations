<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180403155319 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE celebrations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE celebrations (id INT NOT NULL, celebration_type_id INT DEFAULT NULL, location_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT \'true\' NOT NULL, location_percentage INT DEFAULT 0 NOT NULL, date DATE NOT NULL, revenue INT DEFAULT 0 NOT NULL, worker_expense INT DEFAULT 0 NOT NULL, transport_expense INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9A1CCF75E237E06 ON celebrations (name)');
        $this->addSql('CREATE INDEX IDX_C9A1CCF7EA6436B8 ON celebrations (celebration_type_id)');
        $this->addSql('CREATE INDEX IDX_C9A1CCF764D218E ON celebrations (location_id)');
        $this->addSql('ALTER TABLE celebrations ADD CONSTRAINT FK_C9A1CCF7EA6436B8 FOREIGN KEY (celebration_type_id) REFERENCES celebration_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE celebrations ADD CONSTRAINT FK_C9A1CCF764D218E FOREIGN KEY (location_id) REFERENCES locations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE celebrations_id_seq CASCADE');
        $this->addSql('DROP TABLE celebrations');
    }
}
