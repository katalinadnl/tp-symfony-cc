<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241222130150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deliverable DROP CONSTRAINT FK_A17DA441166D1F9C');
        $this->addSql('ALTER TABLE deliverable ADD CONSTRAINT FK_A17DA441166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE19EB6921');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_category DROP CONSTRAINT FK_3B02921A6C1197C9');
        $this->addSql('ALTER TABLE project_category DROP CONSTRAINT FK_3B02921A9777D11E');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A6C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25166D1F9C');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25F3C6560A');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F3C6560A FOREIGN KEY (deliverable_id) REFERENCES deliverable (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT FK_E6BDCDF719EB6921');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT FK_E6BDCDF7166D1F9C');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE49D86650F');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE46C1197C9');
        $this->addSql('ALTER TABLE user_project ALTER user_id_id DROP NOT NULL');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE49D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE46C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_task DROP CONSTRAINT FK_28FF97EC9D86650F');
        $this->addSql('ALTER TABLE user_task DROP CONSTRAINT FK_28FF97ECB8E08577');
        $this->addSql('ALTER TABLE user_task ADD CONSTRAINT FK_28FF97EC9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_task ADD CONSTRAINT FK_28FF97ECB8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb25166d1f9c');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb25f3c6560a');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb25166d1f9c FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb25f3c6560a FOREIGN KEY (deliverable_id) REFERENCES deliverable (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_category DROP CONSTRAINT fk_3b02921a6c1197c9');
        $this->addSql('ALTER TABLE project_category DROP CONSTRAINT fk_3b02921a9777d11e');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT fk_3b02921a6c1197c9 FOREIGN KEY (project_id_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT fk_3b02921a9777d11e FOREIGN KEY (category_id_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_task DROP CONSTRAINT fk_28ff97ec9d86650f');
        $this->addSql('ALTER TABLE user_task DROP CONSTRAINT fk_28ff97ecb8e08577');
        $this->addSql('ALTER TABLE user_task ADD CONSTRAINT fk_28ff97ec9d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_task ADD CONSTRAINT fk_28ff97ecb8e08577 FOREIGN KEY (task_id_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT fk_77becee49d86650f');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT fk_77becee46c1197c9');
        $this->addSql('ALTER TABLE user_project ALTER user_id_id SET NOT NULL');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT fk_77becee49d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT fk_77becee46c1197c9 FOREIGN KEY (project_id_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT fk_e6bdcdf719eb6921');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT fk_e6bdcdf7166d1f9c');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT fk_e6bdcdf719eb6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT fk_e6bdcdf7166d1f9c FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deliverable DROP CONSTRAINT fk_a17da441166d1f9c');
        $this->addSql('ALTER TABLE deliverable ADD CONSTRAINT fk_a17da441166d1f9c FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0ee19eb6921');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0ee19eb6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
