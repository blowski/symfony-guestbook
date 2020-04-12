<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200412082634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create conference and comment tables';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE conference (id UUID NOT NULL, city VARCHAR(255) DEFAULT NULL, year VARCHAR(4) DEFAULT NULL, is_international BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id UUID NOT NULL, conference_id UUID NOT NULL, author VARCHAR(255) DEFAULT NULL, text VARCHAR(255) DEFAULT NULL, photo_filename VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C604B8382 ON comment (conference_id)');
        $this->addSql('COMMENT ON COLUMN comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C604B8382');
        $this->addSql('DROP TABLE conference');
        $this->addSql('DROP TABLE comment');
    }
}
