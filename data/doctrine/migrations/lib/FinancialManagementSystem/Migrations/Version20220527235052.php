<?php

declare(strict_types=1);

namespace FinancialManagementSystem\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220527235052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('create table perfil (
            id int primary key auto_increment,
            tipo varchar(50) not null,
            pontuacao_min int not null,
            pontuacao_max int not null,
            descricao text default null,
            imagem varchar(255) default null
        )');

        $this->addSql('create table usuario (
          codigo int primary key auto_increment,
          nome varchar(50) not null,
          email varchar(255) not null unique,
          id_perfil int default null,
          senha varchar(255) not null,
          imagem varchar(100) default null
         )');
        $this->addSql('alter table usuario add constraint foreign key (id_perfil) references perfil(id)');

        $this->addSql('create table questionario(
            id int primary key auto_increment,
            quantidadePerguntas int not null
        )');

        $this->addSql('create table pergunta(
            id int primary key auto_increment,
            texto text not null,
            id_questionario int not null
        )');
        $this->addSql('alter table pergunta add constraint foreign key (id_questionario) references questionario(id)');

        $this->addSql('create table alternativa (
            id int primary key auto_increment,
            texto text not null,
            id_pergunta int not null,
            pontuacao int not null
        )');
        $this->addSql('alter table alternativa add constraint foreign key (id_pergunta) references pergunta(id)');

        $this->addSql("create table movimentacao (
            id int primary key auto_increment,
            data date not null,
            valor int not null,
            nome varchar(155) not null,
            id_usuario int not null,
            tipo enum('ganho', 'gasto', 'despesa') not null default 'ganho'
        )");
        $this->addSql('alter table movimentacao add constraint foreign key (id_usuario) references usuario(codigo);');


        $this->addSql('insert into questionario (id, quantidadePerguntas) values (1, 10)');
        $this->addSql("insert into pergunta (id, texto, id_questionario) values
            (1, 'O que você ganha por mês é suficiente para arcar com os seus gastos?', 1),
            (2, 'Você tem conseguido pagar suas despesas em dia e à vista?', 1),
            (3, 'Você realiza seu orçamento financeiro mensalmente?', 1),
            (4, 'Você consegue fazer algum tipo de investimento?', 1),
            (5, 'Como você planeja a sua aposentadoria?', 1),
            (6, 'O que você entende sobre ser Independente Financeiramente?', 1),
            (7, 'Você sabe quais são seus sonhos e objetivos de curto, médio e longo prazos?', 1),
            (8, 'Se um imprevisto alterasse a sua situação financeira, qual seria a sua reação?', 1),
            (9, 'Se a partir de hoje você não recebesse mais seu ganho, por quanto tempo você conseguiria manter seu atual padrão de vida?', 1),
            (10, 'Quando você decide comprar um produto, qual é a sua atitude?', 1)"
        );
        $this->addSql("insert into alternativa (texto, id_pergunta, pontuacao) values
            ('Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês', 1, 10),
            ('É suficiente, mas não sobra nada', 1, 5),
            ('Gasto todo o meu dinheiro e ainda uso o limite de cheque especial ou peço emprestado para parentes e amigos', 1, 0),
        
            ('Pago em dia, à vista e, em alguns casos, com bons descontos', 2, 10),
            ('Quase sempre, mas tenho que parcelar as compras de maior valor', 2, 5),
            ('Sempre parcelo meus compromissos e utilizo linhas de crédito como cheque especial, cartão de crédito e crediário', 2, 0),
        
            ('Faço periodicamente e comparo o orçado com o realizado', 3, 10),
            ('Somente registro o realizado, sem analisar os gastos', 3, 5),
            ('Não faço o meu orçamento financeiro', 3, 0),
        
            ('Utilizo mais de 10% do meu ganho em linhas de investimentos, que variam de acordo com os meus sonhos', 4, 10),
            ('Quando sobra dinheiro, invisto, normalmente, na poupança', 4, 5),
            ('Nunca sobra dinheiro para esse tipo de ação', 4, 0),
        
            ('Tenho planos alternativos de previdência privada para garantir minha segurança financeira', 5, 10),
            ('Contribuo para a previdência social, sei que preciso de reserva extra, mas não consigo poupar', 5, 5),
            ('Não contribuo para a previdência social e nem para a privada', 5, 0),
        
            ('Que posso trabalhar por prazer e não por necessidade', 6, 10),
            ('Que posso ter dinheiro para viver bem o dia a dia', 6, 5),
            ('Que posso curtir a vida intensamente e não pensar no futuro', 6, 0),
        
            ('Sei quais são, quanto custam e por quanto tempo terei que guardar dinheiro para realizá-los', 7, 10),
            ('Tenho muitos sonhos e sei quanto custam, mas não sei como realizá-los', 7, 5),
            ('Sempre acabo deixando os meus sonhos e objetivos para o futuro, porque não consigo guardar dinheiro para eles', 7, 0),
        
            ('Faria um bom diagnóstico financeiro, registrando o que ganho e o que gasto, além dos meus investimentos e dívidas, se os tiverem', 8, 10),
            ('Cortaria despesas e gastos desnecessários', 8, 5),
            ('Não saberia por onde começar e teria medo de encarar a minha verdadeira situação financeira', 8, 0),
        
            ('Conseguiria fazer tudo o que faço por 10 anos ou mais', 9, 10),
            ('Manteria o meu padrão de vida por, no máximo, um ano', 9, 5),
            ('Não conseguiria me manter nem por alguns meses', 9, 0),
        
            ('Planejo uma forma de investimento para comprar à vista e com desconto', 10, 10),
            ('Parcelo dentro do meu orçamento', 10, 5),
            ('Compro e depois me preocupo como vou pagar', 10, 0)"
        );

        $this->addSql("insert into perfil (tipo, pontuacao_max, pontuacao_min, descricao, imagem) values
            ('Investidor', 100, 70, 'Parabéns, você é uma pessoa que sabe como gerir bem o seu dinheiro e consegue gerir e poupar suas finanças a fim de alcançar seus objetivos. Busque inverstir em títulos como CDB e tesouro', 'https://res.cloudinary.com/davifelix/image/upload/v1653501383/cofre_yud05c.png'),
            ('Equilibrado', 60, 45, 'Você é uma pessoa que consegue manter sua vida financeira controlada, sem muitas dívidas ou sufocos. No entanto, você ainda não tem muito o hábito de economizar para poder ter uma reserva e investir. Busque sair da zona de conforto', 'https://res.cloudinary.com/davifelix/image/upload/v1653501383/balanca_sxhxqt.png'),
            ('Desequilibrado', 0, 40, 'Você não está em uma situação financeira e deve tomar providências quanto a isso para o seu bem estar, e nossa plataforma está aqui para te ajudar. Busque planejar o que vai gastar e anotar todos os seus ganhos e gastos para poder criar mais o hábito de controle e disciplina financeira', 'https://res.cloudinary.com/davifelix/image/upload/v1653501383/danger_ojrvd8.png')"
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0;');
        $this->addSql("DROP TABLE IF EXISTS usuario");
        $this->addSql("DROP TABLE IF EXISTS perfil");
        $this->addSql("DROP TABLE IF EXISTS movimentacao");
        $this->addSql("DROP TABLE IF EXISTS alternativa");
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
