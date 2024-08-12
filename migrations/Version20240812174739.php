<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240812174739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_item DROP FOREIGN KEY FK_BEB18B9333E1689A');
        $this->addSql('ALTER TABLE command_item DROP FOREIGN KEY FK_BEB18B93ED5CA9E6');
        $this->addSql('ALTER TABLE command_item DROP FOREIGN KEY FK_BEB18B93126F525E');
        $this->addSql('ALTER TABLE item_service DROP FOREIGN KEY FK_EAC0BC86126F525E');
        $this->addSql('ALTER TABLE item_service DROP FOREIGN KEY FK_EAC0BC86ED5CA9E6');
        $this->addSql('DROP TABLE command_item');
        $this->addSql('DROP TABLE item_service');
        $this->addSql('ALTER TABLE command ADD price DOUBLE PRECISION NOT NULL, ADD delivery TINYINT(1) NOT NULL, ADD delivery_date DATETIME NOT NULL, DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_item (id INT AUTO_INCREMENT NOT NULL, command_id INT DEFAULT NULL, item_id INT DEFAULT NULL, service_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_BEB18B9333E1689A (command_id), INDEX IDX_BEB18B93126F525E (item_id), INDEX IDX_BEB18B93ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_service (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, item_id INT DEFAULT NULL, INDEX IDX_EAC0BC86ED5CA9E6 (service_id), INDEX IDX_EAC0BC86126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE command_item ADD CONSTRAINT FK_BEB18B9333E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE command_item ADD CONSTRAINT FK_BEB18B93ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE command_item ADD CONSTRAINT FK_BEB18B93126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_service ADD CONSTRAINT FK_EAC0BC86126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_service ADD CONSTRAINT FK_EAC0BC86ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE command ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP price, DROP delivery, DROP delivery_date');
    }
}
