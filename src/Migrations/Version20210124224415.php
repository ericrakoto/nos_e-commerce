<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124224415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entana (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, category_id INT DEFAULT NULL, titre_produit VARCHAR(255) NOT NULL, sary VARCHAR(255) NOT NULL, vidiny INT NOT NULL, description VARCHAR(255) NOT NULL, quantite_vendu INT DEFAULT NULL, INDEX IDX_A37A775DF77D927C (panier_id), INDEX IDX_A37A775D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, total INT NOT NULL, INDEX IDX_24CC0DF2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantite_vendu (id INT AUTO_INCREMENT NOT NULL, quantite_id INT DEFAULT NULL, category_id INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_AAA6F2496444A2DB (quantite_id), INDEX IDX_AAA6F24912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, tel INT NOT NULL, adresse VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entana ADD CONSTRAINT FK_A37A775DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE entana ADD CONSTRAINT FK_A37A775D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quantite_vendu ADD CONSTRAINT FK_AAA6F2496444A2DB FOREIGN KEY (quantite_id) REFERENCES entana (id)');
        $this->addSql('ALTER TABLE quantite_vendu ADD CONSTRAINT FK_AAA6F24912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entana DROP FOREIGN KEY FK_A37A775D12469DE2');
        $this->addSql('ALTER TABLE quantite_vendu DROP FOREIGN KEY FK_AAA6F24912469DE2');
        $this->addSql('ALTER TABLE quantite_vendu DROP FOREIGN KEY FK_AAA6F2496444A2DB');
        $this->addSql('ALTER TABLE entana DROP FOREIGN KEY FK_A37A775DF77D927C');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE entana');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE quantite_vendu');
        $this->addSql('DROP TABLE user');
    }
}
