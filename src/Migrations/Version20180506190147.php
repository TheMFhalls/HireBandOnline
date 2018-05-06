<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180506190147 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_musico (categoria_id INT NOT NULL, musico_id INT NOT NULL, INDEX IDX_9BA7CD2B3397707A (categoria_id), INDEX IDX_9BA7CD2B79398F67 (musico_id), PRIMARY KEY(categoria_id, musico_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musico_categoria (musico_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_8AE5A1C479398F67 (musico_id), INDEX IDX_8AE5A1C43397707A (categoria_id), PRIMARY KEY(musico_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estabelecimento (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria_musico ADD CONSTRAINT FK_9BA7CD2B3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_musico ADD CONSTRAINT FK_9BA7CD2B79398F67 FOREIGN KEY (musico_id) REFERENCES musico (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musico_categoria ADD CONSTRAINT FK_8AE5A1C479398F67 FOREIGN KEY (musico_id) REFERENCES musico (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musico_categoria ADD CONSTRAINT FK_8AE5A1C43397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categoria_musico DROP FOREIGN KEY FK_9BA7CD2B3397707A');
        $this->addSql('ALTER TABLE musico_categoria DROP FOREIGN KEY FK_8AE5A1C43397707A');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE categoria_musico');
        $this->addSql('DROP TABLE musico_categoria');
        $this->addSql('DROP TABLE estabelecimento');
    }
}
