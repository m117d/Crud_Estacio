-- Criação da tabela 'tipo_midia'
CREATE TABLE tipo_midia (
    id SERIAL PRIMARY KEY,
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('Filme', 'Serie', 'Desenho'))
);

-- Criação da tabela 'midia'
CREATE TABLE midia (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo_id INT NOT NULL,
    status VARCHAR(20) NOT NULL CHECK (status IN ('Assistida', 'Não Assistida', 'Em Andamento', 'Terminada')),
    FOREIGN KEY (tipo_id) REFERENCES tipo_midia(id)
);

-- Inserindo valores na tabela 'tipo_midia'
INSERT INTO tipo_midia (tipo) VALUES
('Filme'),
('Serie'),
('Desenho');
