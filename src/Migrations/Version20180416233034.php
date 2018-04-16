<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416233034 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE decoration_items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE decoration_items (id INT NOT NULL, balloon_id INT DEFAULT NULL, decoration_id INT DEFAULT NULL, price NUMERIC(8, 2) NOT NULL, quantity INT NOT NULL, is_active BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7A2B1F716EB7BB8 ON decoration_items (balloon_id)');
        $this->addSql('CREATE INDEX IDX_F7A2B1F73446DFC4 ON decoration_items (decoration_id)');
        $this->addSql('ALTER TABLE decoration_items ADD CONSTRAINT FK_F7A2B1F716EB7BB8 FOREIGN KEY (balloon_id) REFERENCES balloons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decoration_items ADD CONSTRAINT FK_F7A2B1F73446DFC4 FOREIGN KEY (decoration_id) REFERENCES decorations (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decorations DROP CONSTRAINT FK_53BB9DDD4741E894');
        $this->addSql('ALTER TABLE decorations ADD CONSTRAINT FK_53BB9DDD4741E894 FOREIGN KEY (celebration_id) REFERENCES celebrations (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE decoration_items_id_seq CASCADE');
        $this->addSql('DROP TABLE decoration_items');
        $this->addSql('ALTER TABLE decorations DROP CONSTRAINT fk_53bb9ddd4741e894');
        $this->addSql('ALTER TABLE decorations ADD CONSTRAINT fk_53bb9ddd4741e894 FOREIGN KEY (celebration_id) REFERENCES celebrations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
