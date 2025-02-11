<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211003928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_details (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_849D792AF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, livraisondetails_id INT NOT NULL, date_livraison DATETIME NOT NULL, adresse_livraison VARCHAR(100) NOT NULL, INDEX IDX_A60C9F1F82EA2E54 (commande_id), INDEX IDX_A60C9F1FB47A3B3 (livraisondetails_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison_details (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, livraison_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_32D065E8F347EFB (produit_id), INDEX IDX_32D065E88E54FB25 (livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_details ADD CONSTRAINT FK_849D792AF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FB47A3B3 FOREIGN KEY (livraisondetails_id) REFERENCES livraison_details (id)');
        $this->addSql('ALTER TABLE livraison_details ADD CONSTRAINT FK_32D065E8F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE livraison_details ADD CONSTRAINT FK_32D065E88E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE produits ADD fournisseur_id INT NOT NULL, ADD slug VARCHAR(100) NOT NULL, CHANGE nom nom VARCHAR(100) NOT NULL, CHANGE description description VARCHAR(250) NOT NULL, CHANGE prix prix NUMERIC(8, 2) NOT NULL, CHANGE url_photo url_photo VARCHAR(250) NOT NULL, CHANGE reference_fournisseur reference_fournisseur VARCHAR(250) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C670C757F ON produits (fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_details DROP FOREIGN KEY FK_849D792AF347EFB');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FB47A3B3');
        $this->addSql('ALTER TABLE livraison_details DROP FOREIGN KEY FK_32D065E8F347EFB');
        $this->addSql('ALTER TABLE livraison_details DROP FOREIGN KEY FK_32D065E88E54FB25');
        $this->addSql('DROP TABLE commande_details');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE livraison_details');
        $this->addSql('DROP TABLE produit');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C670C757F');
        $this->addSql('DROP INDEX IDX_BE2DDF8C670C757F ON produits');
        $this->addSql('ALTER TABLE produits DROP fournisseur_id, DROP slug, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE prix prix INT NOT NULL, CHANGE reference_fournisseur reference_fournisseur VARCHAR(255) NOT NULL, CHANGE url_photo url_photo VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
