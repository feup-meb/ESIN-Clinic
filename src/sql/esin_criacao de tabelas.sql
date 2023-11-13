-- Cria tabela unidades
CREATE table unidades(
    id              SERIAL PRIMARY KEY,
    nome            VARCHAR NOT NULL,
    sala            VARCHAR NOT NULL
);

-- Cria tabela tipo_utilizador
CREATE TABLE tipo_utilizador (
    id   SERIAL PRIMARY KEY,
    tipo VARCHAR NOT NULL
);

-- Cria tabela empregados
CREATE table empregados (
    id              SERIAL PRIMARY KEY,
    nome            VARCHAR NOT NULL,
    data_nascimento DATE,
    morada          VARCHAR,
    id_unidade      INTEGER REFERENCES unidades (id),
    matricula       VARCHAR NOT NULL,
    palavra_passe   VARCHAR NOT NULL,    
    tipo_utilizador INTEGER REFERENCES tipo_utilizador (id)
);

-- Cria tabela fabricantes
CREATE table fabricantes (
    id              SERIAL PRIMARY KEY,
    nome            VARCHAR NOT NULL,
    email           VARCHAR NOT NULL,
    telefone        VARCHAR NOT NULL,
    telemovel       VARCHAR NOT NULL,
    morada          VARCHAR NOT NULL
);

-- Cria tabela cat_equipamentos
CREATE table cat_equipamentos (
    id              SERIAL PRIMARY KEY,
    nome            VARCHAR NOT NULL,
    descricao       VARCHAR
);

-- Cria tabela equipamentos
CREATE table equipamentos (
    id              SERIAL PRIMARY KEY,
    nr_serie        VARCHAR UNIQUE NOT NULL,
    nome            VARCHAR NOT NULL,
    modelo          VARCHAR NOT NULL,
    descricao       VARCHAR,
    id_fabricante   INTEGER REFERENCES fabricantes (id),
    id_categoria    INTEGER REFERENCES cat_equipamentos(id),
    data_aquisicao  DATE NOT NULL,
    data_garantia   DATE NOT NULL,
    valor_compra    NUMERIC (7,2),
    ativo           BOOLEAN,
    id_unidade      INTEGER REFERENCES unidades (id)
);

-- Cria tabela intervencoes
CREATE table intervencoes (
    id              SERIAL PRIMARY KEY,
    data_detetado   DATE NOT NULL,
    observacoes     VARCHAR,
    data_avaliacao  DATE,
    orcamento       NUMERIC(7,2),
    tipo            VARCHAR NOT NULL,
    data_inicio     DATE,
    data_fim        DATE,
    id_empregado    INTEGER REFERENCES empregados (id),
    id_equipamento  INTEGER REFERENCES equipamentos (id)
);

-- Cria tabela acessos
CREATE table acessos_equip (
    id              SERIAL PRIMARY KEY,
    id_empregado    INTEGER REFERENCES empregados (id),
    id_equipamento  INTEGER REFERENCES equipamentos (id)
);