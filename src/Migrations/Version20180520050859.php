<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180520050859 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE estabelecimento (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, bairro_id INT NOT NULL, nome VARCHAR(150) NOT NULL, historia LONGTEXT NOT NULL, endereco LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_C81CFEF0DB38439E (usuario_id), INDEX IDX_C81CFEF0A94EF08D (bairro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estabelecimento ADD CONSTRAINT FK_C81CFEF0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE estabelecimento ADD CONSTRAINT FK_C81CFEF0A94EF08D FOREIGN KEY (bairro_id) REFERENCES bairro (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE estabelecimento');
    }
}
