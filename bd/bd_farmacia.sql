-- Usando Banco de Dados: ktrjteyzfdCategoria
USE ktrjteyzfd;

-- Tabela Usuario: Armazena dados dos usuários do sistema
CREATE TABLE Usuario (
    ID_Usuario INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único do usuário
    Nome VARCHAR(50) NOT NULL,                  -- Nome do usuário
    Email VARCHAR(50) UNIQUE NOT NULL,          -- Email único do usuário
    Senha VARCHAR(20) NOT NULL,                 -- Senha do usuário
    Endereco VARCHAR(100),                      -- Endereço do usuário
    Celular VARCHAR(20),                        -- Número de celular do usuário
    Tipo ENUM('cliente', 'administrador') NOT NULL  -- Tipo de usuário (cliente ou administrador)
);

-- Tabela Categoria: Define as categorias de produtos
CREATE TABLE Categoria (
    ID_Categoria INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único da categoria
    Nome_Categoria VARCHAR(50) UNIQUE NOT NULL    -- Nome da categoria, deve ser único
);

-- Tabela Produto: Armazena dados dos produtos disponíveis
CREATE TABLE Produto (
    ID_Produto INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único do produto
    Nome VARCHAR(50) NOT NULL,                  -- Nome do produto
    Descricao TEXT,                             -- Descrição do produto
    Preco DECIMAL(10,2) NOT NULL,               -- Preço do produto
    Estoque INT NOT NULL,                       -- Quantidade em estoque do produto
    Codigo_Barras VARCHAR(50) UNIQUE,           -- Código de barras único do produto
    ID_Categoria INT,                           -- Categoria do produto
    FOREIGN KEY (ID_Categoria) REFERENCES Categoria(ID_Categoria) ON DELETE RESTRICT  -- Restrição para impedir exclusão de categorias com produtos associados
);

-- Tabela Pedido: Armazena os pedidos realizados pelos usuários
CREATE TABLE Pedido (
    ID_Pedido INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único do pedido
    ID_Usuario INT NOT NULL,                   -- Identificador do usuário que realizou o pedido
    Data_Pedido DATETIME DEFAULT CURRENT_TIMESTAMP,  -- Data do pedido
    Status ENUM('pendente', 'concluido', 'cancelado') NOT NULL,  -- Status do pedido
    FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario) ON DELETE RESTRICT  -- Restrição para evitar a exclusão de usuários com pedidos
);

-- Tabela Transacao: Gerencia os pagamentos dos pedidos
CREATE TABLE Transacao (
    ID_Pagamento INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único do pagamento
    ID_Pedido INT NOT NULL,                       -- Identificador do pedido relacionado
    Forma_Pagamento ENUM('cartao', 'boleto', 'pix') NOT NULL,  -- Forma de pagamento
    Status_Pagamento ENUM('pendente', 'pago', 'cancelado') NOT NULL,  -- Status do pagamento
    Data_Pagamento DATETIME,                      -- Data do pagamento
    Valor_Pago DECIMAL(10,2),                     -- Valor pago
    FOREIGN KEY (ID_Pedido) REFERENCES Pedido(ID_Pedido) ON DELETE CASCADE  -- Exclusão em cascata para remover transações associadas a pedidos excluídos
);

-- Tabela Rastreador: Monitora o status de entrega dos pedidos
CREATE TABLE Rastreador (
    ID_Rastreador INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único do rastreador
    ID_Pedido INT NOT NULL,                        -- Identificador do pedido relacionado
    Status_Entrega ENUM('pendente', 'enviado', 'entregue') NOT NULL,  -- Status de entrega
    Data_Envio DATETIME,                           -- Data de envio do pedido
    Data_Entrega DATETIME,                         -- Data de entrega do pedido
    FOREIGN KEY (ID_Pedido) REFERENCES Pedido(ID_Pedido) ON DELETE CASCADE  -- Exclusão em cascata para remover rastreadores associados a pedidos excluídos
);

-- Tabela Itens_Produtos: Relaciona os produtos aos pedidos, especificando quantidades
CREATE TABLE Itens_Produtos (
    ID_Itens_Produtos INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único dos itens do pedido
    ID_Pedido INT NOT NULL,                            -- Identificador do pedido relacionado
    ID_Produto INT NOT NULL,                           -- Identificador do produto relacionado
    Quantidade INT NOT NULL,                           -- Quantidade do produto no pedido
    FOREIGN KEY (ID_Pedido) REFERENCES Pedido(ID_Pedido) ON DELETE CASCADE,  -- Exclusão em cascata para remover itens associados a pedidos excluídos
    FOREIGN KEY (ID_Produto) REFERENCES Produto(ID_Produto) ON DELETE RESTRICT  -- Restrição para evitar exclusão de produtos associados a pedidos
);

-- Inserindo registros na tabela Usuario
INSERT INTO Usuario (Nome, Email, Senha, Endereco, Celular, Tipo) VALUES
('João Silva', 'joao.silva@email.com', 'senha123', 'Rua A, 123', '999999999', 'cliente'),
('Maria Oliveira', 'maria.oliveira@email.com', 'senha123', 'Rua B, 456', '988888888', 'cliente'),
('Carlos Souza', 'carlos.souza@email.com', 'senha123', 'Rua C, 789', '977777777', 'cliente'),
('Ana Lima', 'ana.lima@email.com', 'senha123', 'Rua D, 101', '966666666', 'cliente'),
('Pedro Martins', 'pedro.martins@email.com', 'senha123', 'Rua E, 202', '955555555', 'cliente'),
('Lucas Costa', 'lucas.costa@email.com', 'senha123', 'Rua F, 303', '944444444', 'cliente'),
('Fernanda Alves', 'fernanda.alves@email.com', 'senha123', 'Rua G, 404', '933333333', 'cliente'),
('Paulo Ferreira', 'paulo.ferreira@email.com', 'senha123', 'Rua H, 505', '922222222', 'cliente'),
('Juliana Ramos', 'juliana.ramos@email.com', 'senha123', 'Rua I, 606', '911111111', 'cliente'),
('Ricardo Pinto', 'ricardo.pinto@email.com', 'senha123', 'Rua J, 707', '900000000', 'cliente'),
('Sofia Santos', 'sofia.santos@email.com', 'senha123', 'Rua K, 808', '988888887', 'cliente'),
('Gabriel Lima', 'gabriel.lima@email.com', 'senha123', 'Rua L, 909', '977777776', 'cliente'),
('Isabela Mendes', 'isabela.mendes@email.com', 'senha123', 'Rua M, 1001', '966666665', 'cliente'),
('Thiago Barbosa', 'thiago.barbosa@email.com', 'senha123', 'Rua N, 111', '955555554', 'cliente'),
('Laura Rocha', 'laura.rocha@email.com', 'senha123', 'Rua O, 212', '944444443', 'administrador');

-- Seleção dos registros
SELECT * FROM Usuario;

-- Inserindo registros na tabela Categoria
INSERT INTO Categoria (Nome_Categoria) VALUES
('Medicamentos'),
('Suplementos'),
('Cosméticos'),
('Higiene Pessoal'),
('Primeiros Socorros'),
('Bebês'),
('Equipamentos Médicos'),
('Vitaminas'),
('Herbal'),
('Cuidados com a Pele'),
('Cuidados com os Cabelos'),
('Perfumes'),
('Produtos Naturais'),
('Ortodontia'),
('Antissépticos');

-- Seleção dos registros
SELECT * FROM Categoria;

-- Inserindo registros na tabela Produto
INSERT INTO Produto (Nome, Descricao, Preco, Estoque, Codigo_Barras, ID_Categoria) VALUES
('Paracetamol', 'Medicamento para dor e febre', 5.99, 100, '789123456001', 1),
('Vitamina C', 'Suplemento vitamínico', 15.50, 200, '789123456002', 8),
('Sabonete Líquido', 'Higiene para mãos', 7.90, 150, '789123456003', 4),
('Fralda Infantil', 'Fraldas para bebês', 45.00, 80, '789123456004', 6),
('Alcool Gel', 'Antisséptico para mãos', 10.50, 300, '789123456005', 15),
('Curativo', 'Curativo adesivo', 3.50, 120, '789123456006', 5),
('Shampoo', 'Shampoo para cabelos', 12.00, 60, '789123456007', 11),
('Creme Hidratante', 'Hidratação para pele', 25.00, 90, '789123456008', 10),
('Perfume Masculino', 'Perfume amadeirado', 150.00, 40, '789123456009', 12),
('Escova Dental', 'Escova macia', 6.00, 180, '789123456010', 14),
('Óleo de Coco', 'Óleo natural', 20.00, 50, '789123456011', 13),
('Termômetro', 'Equipamento para medição de temperatura', 35.00, 70, '789123456012', 7),
('Protetor Solar', 'Proteção contra raios UV', 35.90, 60, '789123456013', 10),
('Condicionador', 'Condicionador para cabelos', 13.50, 60, '789123456014', 11),
('Soro Fisiológico', 'Solução salina', 8.00, 120, '789123456015', 1);

-- Seleção dos registros
SELECT * FROM Produto;

-- Inserindo registros na tabela Pedido
INSERT INTO Pedido (ID_Usuario, Status) VALUES
(1, 'pendente'),
(2, 'concluido'),
(3, 'cancelado'),
(4, 'pendente'),
(5, 'concluido'),
(6, 'pendente'),
(7, 'concluido'),
(8, 'cancelado'),
(9, 'pendente'),
(10, 'concluido'),
(11, 'pendente'),
(12, 'concluido'),
(13, 'pendente'),
(14, 'concluido'),
(15, 'pendente');

-- Seleção dos registros
SELECT * FROM Pedido;

-- Inserindo registros na tabela Transacao
INSERT INTO Transacao (ID_Pedido, Forma_Pagamento, Status_Pagamento, Data_Pagamento, Valor_Pago) VALUES
(1, 'cartao', 'pago', NOW(), 5.99),
(2, 'pix', 'pago', NOW(), 15.50),
(3, 'boleto', 'cancelado', NULL, 0.00),
(4, 'cartao', 'pendente', NULL, 45.00),
(5, 'pix', 'pago', NOW(), 10.50),
(6, 'cartao', 'pendente', NULL, 3.50),
(7, 'pix', 'pago', NOW(), 12.00),
(8, 'boleto', 'cancelado', NULL, 0.00),
(9, 'cartao', 'pendente', NULL, 25.00),
(10, 'pix', 'pago', NOW(), 150.00),
(11, 'cartao', 'pendente', NULL, 6.00),
(12, 'pix', 'pago', NOW(), 20.00),
(13, 'cartao', 'pendente', NULL, 35.00),
(14, 'pix', 'pago', NOW(), 35.90),
(15, 'boleto', 'pendente', NULL, 13.50);

-- Seleção dos registros
SELECT * FROM Transacao;

-- Inserindo registros na tabela Rastreador
INSERT INTO Rastreador (ID_Pedido, Status_Entrega, Data_Envio, Data_Entrega) VALUES
(1, 'enviado', NOW(), NULL),
(2, 'entregue', NOW(), NOW()),
(3, 'pendente', NULL, NULL),
(4, 'enviado', NOW(), NULL),
(5, 'entregue', NOW(), NOW()),
(6, 'pendente', NULL, NULL),
(7, 'entregue', NOW(), NOW()),
(8, 'pendente', NULL, NULL),
(9, 'enviado', NOW(), NULL),
(10, 'entregue', NOW(), NOW()),
(11, 'pendente', NULL, NULL),
(12, 'entregue', NOW(), NOW()),
(13, 'enviado', NOW(), NULL),
(14, 'entregue', NOW(), NOW()),
(15, 'pendente', NULL, NULL);

-- Seleção dos registros
SELECT * FROM Rastreador;

-- Inserindo registros na tabela Itens_Produtos
INSERT INTO Itens_Produtos (ID_Pedido, ID_Produto, Quantidade) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 1),
(4, 4, 2),
(5, 5, 4),
(6, 6, 1),
(7, 7, 2),
(8, 8, 3),
(9, 9, 1),
(10, 10, 2),
(11, 11, 3),
(12, 12, 1),
(13, 13, 2),
(14, 14, 1),
(15, 15, 4);

-- Seleção dos registros
SELECT * FROM Itens_Produtos;

-- Stored Procedure para Consultar Estoque
DELIMITER //
CREATE PROCEDURE ConsultarEstoque(IN p_ID_Produto INT, OUT p_Estoque INT)
BEGIN
    SELECT Estoque INTO p_Estoque FROM Produto WHERE ID_Produto = p_ID_Produto;

    IF p_Estoque < 20 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Estoque baixo! Reabastecimento recomendado.';
    END IF;
END //
DELIMITER ;

-- Trigger de Auditoria para Operações em Produtos
-- Tabela de Auditoria
CREATE TABLE Auditoria_Produto (
    ID_Auditoria INT AUTO_INCREMENT PRIMARY KEY,
    Operacao VARCHAR(10),
    Data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ID_Produto INT,
    Nome VARCHAR(50),
    Descricao TEXT,
    Preco DECIMAL(10,2),
    Estoque INT
);

-- Trigger de Auditoria para INSERT em Produto
DELIMITER //
CREATE TRIGGER AuditarProduto_Insert AFTER INSERT ON Produto
FOR EACH ROW
BEGIN
    INSERT INTO Auditoria_Produto (Operacao, ID_Produto, Nome, Descricao, Preco, Estoque)
    VALUES ('INSERT', NEW.ID_Produto, NEW.Nome, NEW.Descricao, NEW.Preco, NEW.Estoque);
END //
DELIMITER ;

-- Trigger de Auditoria para UPDATE em Produto
DELIMITER //
CREATE TRIGGER AuditarProduto_Update AFTER UPDATE ON Produto
FOR EACH ROW
BEGIN
    INSERT INTO Auditoria_Produto (Operacao, ID_Produto, Nome, Descricao, Preco, Estoque)
    VALUES ('UPDATE', NEW.ID_Produto, NEW.Nome, NEW.Descricao, NEW.Preco, NEW.Estoque);
END //
DELIMITER ;

-- Trigger de Auditoria para DELETE em Produto
DELIMITER //
CREATE TRIGGER AuditarProduto_Delete AFTER DELETE ON Produto
FOR EACH ROW
BEGIN
    INSERT INTO Auditoria_Produto (Operacao, ID_Produto, Nome, Descricao, Preco, Estoque)
    VALUES ('DELETE', OLD.ID_Produto, OLD.Nome, OLD.Descricao, OLD.Preco, OLD.Estoque);
END //
DELIMITER ;

-- Consultas com Agregação

-- Consulta 1: Total de Pedidos por Status
SELECT Status, COUNT(*) AS Total_Pedidos
FROM Pedido
GROUP BY Status;

-- Consulta 2: Total de Vendas e Receita por Forma de Pagamento
SELECT Forma_Pagamento, COUNT(*) AS Total_Vendas, SUM(Valor_Pago) AS Receita_Total
FROM Transacao
WHERE Status_Pagamento = 'pago'
GROUP BY Forma_Pagamento;

-- Consulta 3: Quantidade de Produtos Vendidos por Categoria
SELECT Categoria.Nome_Categoria, SUM(Itens_Produtos.Quantidade) AS Total_Quantidade_Vendida
FROM Itens_Produtos
JOIN Produto ON Itens_Produtos.ID_Produto = Produto.ID_Produto
JOIN Categoria ON Produto.ID_Categoria = Categoria.ID_Categoria
GROUP BY Categoria.Nome_Categoria;

-- Consultas com Relações (JOIN entre 3 tabelas)

-- Consulta 1: Histórico de Pedidos de um Usuário Específico
SELECT Usuario.Nome, Pedido.ID_Pedido, Pedido.Data_Pedido, Pedido.Status
FROM Pedido
JOIN Usuario ON Pedido.ID_Usuario = Usuario.ID_Usuario
WHERE Usuario.ID_Usuario = 1;

-- Consulta 2: Produtos em Pedidos com Status 'Pendente'
SELECT Pedido.ID_Pedido, Produto.Nome AS Nome_Produto, Itens_Produtos.Quantidade
FROM Pedido
JOIN Itens_Produtos ON Pedido.ID_Pedido = Itens_Produtos.ID_Pedido
JOIN Produto ON Itens_Produtos.ID_Produto = Produto.ID_Produto
WHERE Pedido.Status = 'pendente';

-- Consulta 3: Receita por Categoria de Produto
SELECT Categoria.Nome_Categoria, SUM(Transacao.Valor_Pago) AS Receita_Categoria
FROM Transacao
JOIN Pedido ON Transacao.ID_Pedido = Pedido.ID_Pedido
JOIN Itens_Produtos ON Pedido.ID_Pedido = Itens_Produtos.ID_Pedido
JOIN Produto ON Itens_Produtos.ID_Produto = Produto.ID_Produto
JOIN Categoria ON Produto.ID_Categoria = Categoria.ID_Categoria
WHERE Transacao.Status_Pagamento = 'pago'
GROUP BY Categoria.Nome_Categoria;

-- Chama a Stored Procedure ConsultarEstoque para um produto específico
CALL ConsultarEstoque(1, @estoque);

-- Exibe o valor de estoque retornado
SELECT @estoque AS Estoque_Atual;

-- Exemplo de operação de inserção que ativa a Trigger
INSERT INTO Produto (Nome, Descricao, Preco, Estoque, Codigo_Barras, ID_Categoria)
VALUES ('Novo Produto', 'Descrição do produto', 19.99, 50, '789123456789', 1);

-- Exemplo de operação de atualização que ativa a Trigger
UPDATE Produto SET Estoque = Estoque - 10 WHERE ID_Produto = 1;

-- Exemplo de operação de exclusão que ativa a Trigger
DELETE FROM Produto WHERE ID_Produto = 2;

-- Consulta a tabela de auditoria para ver o log das operações
SELECT * FROM Auditoria_Produto;