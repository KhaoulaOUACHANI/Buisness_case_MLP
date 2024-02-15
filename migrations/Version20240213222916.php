<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213222916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name_c VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, client_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, status_commande_id_id INT DEFAULT NULL, date_command DATETIME NOT NULL, nbr_article INT NOT NULL, INDEX IDX_F52993989D86650F (user_id_id), INDEX IDX_F5299398C664EE0E (status_commande_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_transition (id INT AUTO_INCREMENT NOT NULL, matter_id_id INT DEFAULT NULL, service_id_id INT DEFAULT NULL, article_id_id INT DEFAULT NULL, order_id_id INT DEFAULT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_44CF5A0FA9DDE9FF (matter_id_id), INDEX IDX_44CF5A0FD63673B0 (service_id_id), INDEX IDX_44CF5A0F8F3EC46 (article_id_id), INDEX IDX_44CF5A0FFCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, city_id_id INT DEFAULT NULL, gender_id_id INT DEFAULT NULL, firstname_u VARCHAR(255) NOT NULL, lastname_u VARCHAR(255) NOT NULL, mail_u VARCHAR(255) NOT NULL, password_u VARCHAR(255) NOT NULL, birth_u DATE NOT NULL, adress_u VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, INDEX IDX_8D93D6493CCE3900 (city_id_id), INDEX IDX_8D93D6496F7F214C (gender_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398C664EE0E FOREIGN KEY (status_commande_id_id) REFERENCES status_commande (id)');
        $this->addSql('ALTER TABLE order_transition ADD CONSTRAINT FK_44CF5A0FA9DDE9FF FOREIGN KEY (matter_id_id) REFERENCES matter (id)');
        $this->addSql('ALTER TABLE order_transition ADD CONSTRAINT FK_44CF5A0FD63673B0 FOREIGN KEY (service_id_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE order_transition ADD CONSTRAINT FK_44CF5A0F8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE order_transition ADD CONSTRAINT FK_44CF5A0FFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496F7F214C FOREIGN KEY (gender_id_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE city ADD country_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_2D5B0234D8A48BBD ON city (country_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989D86650F');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398C664EE0E');
        $this->addSql('ALTER TABLE order_transition DROP FOREIGN KEY FK_44CF5A0FA9DDE9FF');
        $this->addSql('ALTER TABLE order_transition DROP FOREIGN KEY FK_44CF5A0FD63673B0');
        $this->addSql('ALTER TABLE order_transition DROP FOREIGN KEY FK_44CF5A0F8F3EC46');
        $this->addSql('ALTER TABLE order_transition DROP FOREIGN KEY FK_44CF5A0FFCDAEAAA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493CCE3900');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496F7F214C');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_transition');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234D8A48BBD');
        $this->addSql('DROP INDEX IDX_2D5B0234D8A48BBD ON city');
        $this->addSql('ALTER TABLE city DROP country_id_id');
    }
}
