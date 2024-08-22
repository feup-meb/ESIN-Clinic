-- Cria tabela unidades
CREATE table unidades(
    id SERIAL PRIMARY KEY,
    nome VARCHAR NOT NULL,
    sala VARCHAR
);
-- Cria tabela tipo_utilizador
CREATE TABLE tipo_utilizador (
    id SERIAL PRIMARY KEY,
    tipo VARCHAR NOT NULL
);
-- Cria tabela empregados
CREATE table empregados (
    id SERIAL PRIMARY KEY,
    nome VARCHAR NOT NULL,
    data_nascimento DATE,
    morada VARCHAR,
    id_unidade INTEGER REFERENCES unidades (id),
    matricula VARCHAR NOT NULL,
    palavra_passe VARCHAR NOT NULL,
    tipo_utilizador INTEGER REFERENCES tipo_utilizador (id)
);
-- Cria tabela fabricantes
CREATE table fabricantes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    telefone VARCHAR NOT NULL,
    telemovel VARCHAR NOT NULL,
    morada VARCHAR NOT NULL
);
-- Cria tabela cat_equipamentos
CREATE table cat_equipamentos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR NOT NULL,
    descricao VARCHAR
);
-- Cria tabela equipamentos
CREATE table equipamentos (
    id SERIAL PRIMARY KEY,
    nr_serie VARCHAR UNIQUE NOT NULL,
    nome VARCHAR NOT NULL,
    modelo VARCHAR NOT NULL,
    descricao VARCHAR,
    id_fabricante INTEGER REFERENCES fabricantes (id),
    id_categoria INTEGER REFERENCES cat_equipamentos(id),
    data_aquisicao DATE NOT NULL,
    data_garantia DATE NOT NULL,
    valor_compra NUMERIC (12, 2),
    ativo BOOLEAN,
    id_unidade INTEGER REFERENCES unidades (id)
);
-- Cria tabela intervencoes
CREATE table intervencoes (
    id SERIAL PRIMARY KEY,
    data_detetado DATE NOT NULL,
    observacoes VARCHAR,
    data_avaliacao DATE,
    orcamento NUMERIC(7, 2),
    tipo VARCHAR NOT NULL,
    data_inicio DATE,
    data_fim DATE,
    id_empregado INTEGER REFERENCES empregados (id),
    id_equipamento INTEGER REFERENCES equipamentos (id)
);
-- Cria tabela acessos
CREATE table acessos_equip (
    id SERIAL PRIMARY KEY,
    id_empregado INTEGER REFERENCES empregados (id),
    id_equipamento INTEGER REFERENCES equipamentos (id)
);
-- Insere dados iniciais nas tabelas
INSERT INTO unidades (id, nome, sala)
VALUES (1, 'Urgência', NULL),
    (2, 'Unidade de Cuidados Intensivos', NULL),
    (3, 'Centro Cirúrgico', NULL),
    (4, 'Radiologia', 'Sala 1');
-- 
INSERT INTO tipo_utilizador (id, tipo)
VALUES (1, 'Gestor'),
    (2, 'Utilizador');
--
INSERT INTO empregados (
        id,
        nome,
        data_nascimento,
        morada,
        id_unidade,
        matricula,
        palavra_passe,
        tipo_utilizador
    )
VALUES (
        1,
        'Leandro',
        NULL,
        NULL,
        1,
        'up201802127',
        '735d7507b5410ee9b3dd1ea93bb60d31df0d2b1a',
        1
    ),
    (
        2,
        'Helena',
        NULL,
        NULL,
        1,
        'up201405139',
        '1c7ab2a24cdbcff89da653d7abf1ac856a8e530f',
        1
    ),
    (
        3,
        'John Doe',
        NULL,
        'Baker Street',
        2,
        'up201812345',
        '5156ef0b70aa95a7290689040e046e4415841155',
        2
    );
--
INSERT INTO fabricantes (id, nome, email, telefone, telemovel, morada)
VALUES (
        1,
        'GE Medical',
        'contacto@gemedical.com',
        '225 522 100',
        '910 690 782',
        'Rua dos Aflitos, 245'
    ),
    (
        2,
        'Shimadzu',
        'contacto@shimadzu.com',
        '225 522 101',
        '910 690 785',
        'Rua das Palmeiras, 1250'
    ),
    (
        3,
        'Philips Medical',
        'contacto@philipsmedical.com',
        '225 522 102',
        '910 690 784',
        'Avenida Dom Manuel, s/ número'
    ),
    (
        4,
        'Nihon Kohden',
        'contacto@nihonkohden.com',
        '225 522 103',
        '910 690 783',
        'Avenida dos Caires, 13'
    ),
    (
        5,
        'AlfaMed',
        'contacto@alfamed.com',
        '225 522 104',
        '910 690 781',
        'Avenida França, 578'
    ),
    (
        6,
        'Intermed',
        'contacto@intermed.com',
        '225 522 105',
        '910 690 780',
        'Avenida dos Descobrimentos, 264'
    );
--
INSERT INTO cat_equipamentos (id, nome, descricao)
VALUES (
        1,
        'Cirúrgico',
        'Equipamentos utilizados em procedimentos invasivos.'
    ),
    (
        2,
        'Diagnóstico',
        'Equipamentos utilizados para auxiliar no diagnóstico médico.'
    ),
    (
        3,
        'Monitorização',
        'Equipamentos utilizados para monitorar sinais vitais.'
    ),
    (
        4,
        'Suporte',
        'Equipamentos utilizados no suporte à vida.'
    );
--
INSERT INTO equipamentos (
        id,
        nome,
        modelo,
        nr_serie,
        descricao,
        id_fabricante,
        id_categoria,
        data_aquisicao,
        data_garantia,
        valor_compra,
        ativo,
        id_unidade
    )
VALUES (
        1,
        'Aparelho de anestesia',
        'Aespire 7900',
        'ANCU00189',
        'Aparelho com utilização de drogas para anestesia e ventilação pulmonar.',
        1,
        1,
        '2014-05-26',
        '2015-05-26',
        100500,
        TRUE,
        3
    ),
    (
        2,
        'Aparelho de Raios-X móvel',
        'Mux-200 MobileArt EVO',
        '0362Z16809',
        'Aparelho móvel para aquisição de imagem.',
        2,
        2,
        '2008-06-20',
        '2009-06-20',
        78000,
        TRUE,
        4
    ),
    (
        3,
        'Monitor multiparâmetro',
        'Cardiocap/5',
        '6169749',
        'Monitor de sinais vitais para anestesia GE.',
        1,
        3,
        '2007-02-12',
        '2008-02-12',
        20000,
        TRUE,
        3
    ),
    (
        4,
        'Monitor multiparâmetro',
        'Intellivue MP 20',
        'DE 6222577',
        'Monitor de sinais vitais com eletro cardiógrafo.',
        3,
        3,
        '2007-02-01',
        '2008-02-01',
        10000,
        FALSE,
        2
    ),
    (
        5,
        'Monitor multiparâmetro',
        'BSM-3763',
        '2826',
        'Monitor de sinais vitais para leitos de UCI.',
        4,
        3,
        '2015-12-18',
        '2016-12-18',
        25000,
        TRUE,
        2
    ),
    (
        6,
        'Monitor multiparâmetro',
        'Vita 600',
        'V600600020',
        'Monitor de saturação e frequência cardíaca.',
        5,
        3,
        '2016-01-21',
        '2017-01-21',
        8000,
        TRUE,
        1
    ),
    (
        7,
        'Ventilador pulmonar',
        'iX5',
        'IX5-2012-09-00165',
        'Aparelho que realiza as funções respiratórias pelo utente incapacitado.',
        6,
        4,
        '2013-12-01',
        '2014-12-01',
        56000,
        TRUE,
        2
    );
-- 
INSERT INTO intervencoes (
        data_detetado,
        observacoes,
        data_avaliacao,
        orcamento,
        tipo,
        data_inicio,
        data_fim,
        id_empregado,
        id_equipamento
    )
VALUES (
        '2017-12-20',
        'Monitor apresenta falha na mediçaõ de ECG.',
        '2017-12-27',
        5000,
        'corretiva',
        '2018-01-10',
        '2018-01-23',
        3,
        4
    );
--
INSERT INTO acessos_equip (id, id_empregado, id_equipamento)
VALUES (1, 1, 1),
    (2, 1, 2),
    (3, 2, 3),
    (4, 2, 4),
    (5, 3, 1),
    (6, 3, 3);
--
INSERT INTO usos_equip ()
VALUES (5, '', ''),
    (5, '', ''),
    (6, '', ''),
    (1, '', ''),
    (2, '', '');