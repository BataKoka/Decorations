<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180329235953 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE balloons_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE balloons (id INT NOT NULL, color_id INT DEFAULT NULL, color_type_id INT DEFAULT NULL, diameter_id INT DEFAULT NULL, material_id INT DEFAULT NULL, print_type_id INT DEFAULT NULL, shape_id INT DEFAULT NULL, supplier_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT \'true\' NOT NULL, price NUMERIC(8, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB6567745E237E06 ON balloons (name)');
        $this->addSql('CREATE INDEX IDX_EB6567747ADA1FB5 ON balloons (color_id)');
        $this->addSql('CREATE INDEX IDX_EB65677496DA01BD ON balloons (color_type_id)');
        $this->addSql('CREATE INDEX IDX_EB656774E657FBFC ON balloons (diameter_id)');
        $this->addSql('CREATE INDEX IDX_EB656774E308AC6F ON balloons (material_id)');
        $this->addSql('CREATE INDEX IDX_EB656774E02F994D ON balloons (print_type_id)');
        $this->addSql('CREATE INDEX IDX_EB65677450266CBB ON balloons (shape_id)');
        $this->addSql('CREATE INDEX IDX_EB6567742ADD6D8C ON balloons (supplier_id)');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB6567747ADA1FB5 FOREIGN KEY (color_id) REFERENCES colors (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB65677496DA01BD FOREIGN KEY (color_type_id) REFERENCES color_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB656774E657FBFC FOREIGN KEY (diameter_id) REFERENCES diameters (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB656774E308AC6F FOREIGN KEY (material_id) REFERENCES materials (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB656774E02F994D FOREIGN KEY (print_type_id) REFERENCES print_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB65677450266CBB FOREIGN KEY (shape_id) REFERENCES shapes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balloons ADD CONSTRAINT FK_EB6567742ADD6D8C FOREIGN KEY (supplier_id) REFERENCES suppliers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE balloons_id_seq CASCADE');
        $this->addSql('DROP TABLE balloons');
    }
}
