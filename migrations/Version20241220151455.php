<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241220151455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE deliverable (id SERIAL NOT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, due_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A17DA441166D1F9C ON deliverable (project_id)');
        $this->addSql('CREATE TABLE project (id SERIAL NOT NULL, client_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE19EB6921 ON project (client_id)');
        $this->addSql('CREATE TABLE project_category (id SERIAL NOT NULL, project_id_id INT DEFAULT NULL, category_id_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B02921A6C1197C9 ON project_category (project_id_id)');
        $this->addSql('CREATE INDEX IDX_3B02921A9777D11E ON project_category (category_id_id)');
        $this->addSql('CREATE TABLE task (id SERIAL NOT NULL, project_id INT DEFAULT NULL, deliverable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, due_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB25166D1F9C ON task (project_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25F3C6560A ON task (deliverable_id)');
        $this->addSql('CREATE TABLE testimonial (id SERIAL NOT NULL, client_id INT DEFAULT NULL, project_id INT DEFAULT NULL, body TEXT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E6BDCDF719EB6921 ON testimonial (client_id)');
        $this->addSql('CREATE INDEX IDX_E6BDCDF7166D1F9C ON testimonial (project_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_project (id SERIAL NOT NULL, user_id_id INT NOT NULL, project_id_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_77BECEE49D86650F ON user_project (user_id_id)');
        $this->addSql('CREATE INDEX IDX_77BECEE46C1197C9 ON user_project (project_id_id)');
        $this->addSql('CREATE TABLE user_task (id SERIAL NOT NULL, user_id_id INT DEFAULT NULL, task_id_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_28FF97EC9D86650F ON user_task (user_id_id)');
        $this->addSql('CREATE INDEX IDX_28FF97ECB8E08577 ON user_task (task_id_id)');
        $this->addSql('ALTER TABLE deliverable ADD CONSTRAINT FK_A17DA441166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A6C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F3C6560A FOREIGN KEY (deliverable_id) REFERENCES deliverable (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE49D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE46C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_task ADD CONSTRAINT FK_28FF97EC9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_task ADD CONSTRAINT FK_28FF97ECB8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE deliverable DROP CONSTRAINT FK_A17DA441166D1F9C');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE19EB6921');
        $this->addSql('ALTER TABLE project_category DROP CONSTRAINT FK_3B02921A6C1197C9');
        $this->addSql('ALTER TABLE project_category DROP CONSTRAINT FK_3B02921A9777D11E');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25166D1F9C');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25F3C6560A');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT FK_E6BDCDF719EB6921');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT FK_E6BDCDF7166D1F9C');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE49D86650F');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE46C1197C9');
        $this->addSql('ALTER TABLE user_task DROP CONSTRAINT FK_28FF97EC9D86650F');
        $this->addSql('ALTER TABLE user_task DROP CONSTRAINT FK_28FF97ECB8E08577');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE deliverable');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_category');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE testimonial');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_project');
        $this->addSql('DROP TABLE user_task');
    }
}
