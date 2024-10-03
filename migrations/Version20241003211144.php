<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241003211144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_kitchen CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE free_extras CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE poi CHANGE lat lat VARCHAR(255) DEFAULT NULL, CHANGE lon lon VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_category CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_contact_details CHANGE tin tin VARCHAR(64) DEFAULT NULL, CHANGE phone_sms2 phone_sms2 VARCHAR(16) DEFAULT NULL, CHANGE phone_owner phone_owner VARCHAR(16) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_details CHANGE average_opinion average_opinion DOUBLE PRECISION DEFAULT NULL, CHANGE min_purchase_amount min_purchase_amount NUMERIC(10, 2) DEFAULT NULL, CHANGE min_delivery_amount min_delivery_amount NUMERIC(10, 0) DEFAULT NULL, CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_opinions CHANGE opinion opinion VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_kitchen CHANGE logo logo VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE poi CHANGE lat lat VARCHAR(255) DEFAULT \'NULL\', CHANGE lon lon VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE free_extras CHANGE description description VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE restaurant_category CHANGE image image VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE restaurant_contact_details CHANGE tin tin VARCHAR(64) DEFAULT \'NULL\', CHANGE phone_sms2 phone_sms2 VARCHAR(16) DEFAULT \'NULL\', CHANGE phone_owner phone_owner VARCHAR(16) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE restaurant_opinions CHANGE opinion opinion VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product CHANGE description description VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE restaurant_details CHANGE average_opinion average_opinion DOUBLE PRECISION DEFAULT \'NULL\', CHANGE min_purchase_amount min_purchase_amount NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE min_delivery_amount min_delivery_amount NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE logo logo VARCHAR(255) DEFAULT \'NULL\'');
    }
}
