<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180506193633 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categoria ADD musico_id INT NOT NULL');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122D79398F67 FOREIGN KEY (musico_id) REFERENCES musico (id)');
        $this->addSql('CREATE INDEX IDX_4E10122D79398F67 ON categoria (musico_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122D79398F67');
        $this->addSql('DROP INDEX IDX_4E10122D79398F67 ON categoria');
        $this->addSql('ALTER TABLE categoria DROP musico_id');
    }
}
