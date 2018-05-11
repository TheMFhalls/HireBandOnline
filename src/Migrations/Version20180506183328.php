<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180506183328 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mensagem (id INT AUTO_INCREMENT NOT NULL, usuario01_id INT NOT NULL, usuario02_id INT NOT NULL, mensagem LONGTEXT NOT NULL, datahora DATETIME NOT NULL, INDEX IDX_9E4532B082CBC676 (usuario01_id), INDEX IDX_9E4532B0907E6998 (usuario02_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensagem ADD CONSTRAINT FK_9E4532B082CBC676 FOREIGN KEY (usuario01_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensagem ADD CONSTRAINT FK_9E4532B0907E6998 FOREIGN KEY (usuario02_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mensagem');
    }
}
