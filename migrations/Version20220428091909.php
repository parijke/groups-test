<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428091909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, permission VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_4C62E638C05172BA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, belongs_to_group_id, name, created_by, updated_by FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, belongs_to_group_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_4C62E638C05172BA FOREIGN KEY (belongs_to_group_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO contact (id, belongs_to_group_id, name, created_by, updated_by) SELECT id, belongs_to_group_id, name, created_by, updated_by FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('CREATE INDEX IDX_4C62E638C05172BA ON contact (belongs_to_group_id)');
        $this->addSql('DROP INDEX IDX_6DC044C5727ACA70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__group AS SELECT id, parent_id, name, created_by, updated_by FROM "group"');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('CREATE TABLE "group" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_6DC044C5727ACA70 FOREIGN KEY (parent_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "group" (id, parent_id, name, created_by, updated_by) SELECT id, parent_id, name, created_by, updated_by FROM __temp__group');
        $this->addSql('DROP TABLE __temp__group');
        $this->addSql('CREATE INDEX IDX_6DC044C5727ACA70 ON "group" (parent_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX IDX_8D93D649382C368F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, member_of_id, email, roles, password, created_by, updated_by FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_of_id INTEGER NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_8D93D649382C368F FOREIGN KEY (member_of_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, member_of_id, email, roles, password, created_by, updated_by) SELECT id, member_of_id, email, roles, password, created_by, updated_by FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649382C368F ON user (member_of_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP INDEX IDX_4C62E638C05172BA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, belongs_to_group_id, name, created_by, updated_by FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, belongs_to_group_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO contact (id, belongs_to_group_id, name, created_by, updated_by) SELECT id, belongs_to_group_id, name, created_by, updated_by FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('CREATE INDEX IDX_4C62E638C05172BA ON contact (belongs_to_group_id)');
        $this->addSql('DROP INDEX IDX_6DC044C5727ACA70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__group AS SELECT id, parent_id, name, created_by, updated_by FROM "group"');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('CREATE TABLE "group" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO "group" (id, parent_id, name, created_by, updated_by) SELECT id, parent_id, name, created_by, updated_by FROM __temp__group');
        $this->addSql('DROP TABLE __temp__group');
        $this->addSql('CREATE INDEX IDX_6DC044C5727ACA70 ON "group" (parent_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX IDX_8D93D649382C368F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, member_of_id, email, roles, password, created_by, updated_by FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_of_id INTEGER NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO "user" (id, member_of_id, email, roles, password, created_by, updated_by) SELECT id, member_of_id, email, roles, password, created_by, updated_by FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649382C368F ON "user" (member_of_id)');
    }
}
