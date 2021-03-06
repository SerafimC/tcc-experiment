<?php

/**
 * Initializes the database.
 */

require_once(dirname(__FILE__) . '/config.php');

$aDb = new PDO('sqlite:' . DB_FILE);
$aDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$aDb->query('CREATE TABLE audio_timestamp (user_id INTEGER, phrase_id INTEGER, init_timestamp DATETIME, end_timestamp DATETIME, PRIMARY KEY(user_id, phrase_id))');
$aDb->query('CREATE TABLE questionnaires (user_id INTEGER, timestamp INTEGER, data TEXT)');
$aDb->query('CREATE TABLE phrases (id PRIMARY KEY, phrase VARCHAR(100))');
$aDb->query('CREATE INDEX idx_audiotimestamp_user_id ON audio_timestamp (user_id)');

$aDb->query('INSERT INTO phrases (id, phrase) VALUES (1, \'Esse tema foi falado no congresso.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (2, \'Leila tem um lindo casaco.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (3, \'O analfabetismo é um problema chato.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (4, \'O casarão foi vendido sem pressa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (5, \'Agindo com união ainda rende mais.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (6, \'Recebi meu pai pra almoçar.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (7, \'O trabalho é a vida do povo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (8, \'Isso se resolverá de maneira tranquila.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (9, \'Os pesquisadores não acreditam nessa história.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (10, \'Sei que amanhã atingiremos a meta proposta.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (11, \'Nosso telefone está mudo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (12, \'Desculpe se te chamo de velho.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (13, \'Queremos discutir o orçamento.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (14, \'Ela não tem fome quando sai de casa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (15, \'Uma índia andava na floresta.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (16, \'Zeca, corra bem rápido pra casa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (17, \'Neste caso, dormirei tranquilo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (18, \'João deu dinheiro pro seu pai comprar um jogo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (19, \'Ainda faltam seis minutos.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (20, \'Ela seguia discretamente.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (21, \'Eu vi logo a índia Joana e o Léo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (22, \'João caminhou na praia calma.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (23, \'Vi Zé fazer essas viagens seis vezes.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (24, \'O atabaque do Tito é coberto com pele de gato.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (25, \'Ele dorme num leito de palha.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (26, \'Paira um ar de arara amarela no Rio.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (27, \'Foi muito difícil entender a canção de natal.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (28, \'Depois do almoço te encontro pro chá.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (29, \'Esses são nossos timezinhos.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (30, \'Procurei Maria em casa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (31, \'A pesca é proibida nesse canto.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (32, \'Quero te ver bem quando ele voltar de lá.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (33, \'Tenho muito orgulho de nossa gente.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (34, \'O inspetor faz a vistoria completa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (35, \'Ainda não se sabe o dia da prova.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (36, \'Será muito dificil conseguir que eu coma.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (37, \'A paixão dele é a natureza.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (38, \'Você quer me dizer a data?\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (39, \'Desculpe, mas me atrasei no casamento.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (40, \'Faz um desvio em direção ao mar.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (41, \'O velho tigre ainda aceita combate.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (42, \'É hora do homem se humanizar mais.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (43, \'Ela ficou na fazenda por uma hora.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (44, \'Seu crime foi encoberto pelo capataz.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (45, \'A escuridão do quarto assustou a criança.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (46, \'Hoje, eu não pude fazer minha ginástica.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (47, \'Comer quindim é sempre uma boa pedida.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (48, \'Hoje irei precisar de você.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (49, \'Sem ele o tempo flui num ritmo suave.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (50, \'A sujeira lançada no rio contamina os peixes.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (51, \'O jogo será transmitido à tarde.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (52, \'É possível que ele já esteja fora de perigo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (53, \'A explicação pode ser encontrada na tese.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (54, \'Meu vôo tinha sido marcado para as cinco horas\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (55, \'Daqui a pouco a gente vai ao baile.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (56, \'Estou certo que mereço a atenção dela.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (57, \'Era um belo enfeite todo de palha.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (58, \'O comércio daqui é bem tranquilo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (59, \'É a minha chance de esclarecer a notícia.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (60, \'A visita transformou-se numa reunião.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (61, \'O cenário da história é um subúrbio da cidade.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (62, \'Eu tenho uma ótima razão pra festejar.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (63, \'A pequena nave medirá o campo magnético.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (64, \'O prêmio será entregue na sessão solene.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (65, \'A ação se passa numa cidade calma.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (66, \'Ela e seu namorado chato saem do carro.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (67, \'O adiantamento surpreendeu a mim e a todos.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (68, \'A gente sempre colhe o que plantou.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (69, \'Aqui é onde existe a flor mais interessante.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (70, \'A corrida de inverno foi uma alegria.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (71, \'Esse empreendimento terá grande sucesso.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (72, \'A feira livre não funcionará amanhã.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (73, \'Fumar é prejudicial à saúde e é feio.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (74, \'Entre com seu velho código e o número da conta\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (75, \'Reflita antes e discuta depois.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (76, \'A aula dele é bastante charmosa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (77, \'Usar mais aditivo pode ser desastroso.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (78, \'O clima não é mau em Calcutá.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (79, \'A locomotiva vem com mais carga.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (80, \'Ainda é uma boa temporada pro cinema.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (81, \'Os maiores picos da Terra ficam debaixo da água.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (82, \'A inauguração da vila é quarta ou quinta-feira.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (83, \'Vote se você tiver o título de eleitor.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (84, \'Hoje é fundamental encontrar a razão da existência humana.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (85, \'A temperatura é mais amena à noite.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (86, \'Em muitas cidades a população está diminuindo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (87, \'Nunca se deve ficar em cima do morro.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (88, \'Para as pessoas estranhas o panorama é desolador.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (89, \'É bom te ver colhendo flores, menino!\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (90, \'Eu finjo me banhar num lago ao amanhecer.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (91, \'É de fundamental importância encontrar uma solução comum\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (92, \'A previsão é de muito nevoeiro no Rio.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (93, \'Os móveis virão as cinco da tarde.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (94, \'O barraco pode desabar em algumas horas.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (95, \'O candidato falou como se já estivesse eleito.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (96, \'A idéia é falha, mas interessante.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (97, \'O dia está bom pra passear de navio.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (98, \'Minha correspondência me espera em casa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (99, \'A saída pra crise dele é o diálogo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (100, \'Finalmente São Pedro chamou o mau tempo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (101, \'Um casal de gatos come no telhado.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (102, \'A cantora foi apresentar um grande sucesso.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (103, \'Lá é um lugar ótimo pra tomar uns chopinhos.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (104, \'O musical consumiu quatro meses da vida da gente\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (105, \'O baile começa após às nove horas.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (106, \'Apesar desse resultado tomarei uma decisão.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (107, \'A verdade não poupa nem as celebridades.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (108, \'O frio deve diminuir ainda este ano.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (109, \'O vão da plataforma é estreito.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (110, \'Infelizmente não fui a ginástica.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (111, \'Os meninos prenderam um filhote de tigre.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (112, \'A bolsa de valores está em alta.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (113, \'O congresso volta atrás em sua palavra.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (114, \'A médica receitou que eles mudassem de clima.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (115, \'Não é permitido fumar no interior do ônibus.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (116, \'A garota foi presa naquela noite.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (117, \'O prato do dia é couve no tempero.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (118, \'Eu viajarei a Belém amanhã.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (119, \'A balsa é o meio de transporte daqui.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (120, \'A apresentação foi cancelada por causa da chuva.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (121, \'O grêmio ganhou uma quadra de esportes.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (122, \'Hoje irei à vila sem meu filho.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (123, \'Essa chuva não ocorre mais todo ano.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (124, \'Será bom que ele estude o assunto.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (125, \'O menu inclui um prato muito saboroso.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (126, \'Podia dizer as horas por gentileza?\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (127, \'A casa é enfeitada com rosas.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (128, \'A Terra é farta mas não infinita.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (129, \'O sinal emitido é captado pelos receptores.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (130, \'A mensalidade aumentou mais que a inflação.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (131, \'O tele-jornal começa às dez da noite.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (132, \'A cabine do telefone fica na próxima rua.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (133, \'Defender a ecologia é manter a vida.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (134, \'Nesse verão o calor é insuportável.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (135, \'O jardim exige muito trabalho.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (136, \'O pão que eu comprei era ótimo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (137, \'Meu pai se entenderá com o padre chato amanhã\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (138, \'Durante o dia apague a luz.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (139, \'A sociedade uruguaia tem que se mobilizar.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (140, \'Nossas atitudes são calmas.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (141, \'Dezenas de cabos eleitorais buscavam apoio.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (142, \'Nunca uma vitória foi paga com tanto suor.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (143, \'Nosso filho ama os animais.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (144, \'Esse peixe é mais letal que algumas cobras.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (145, \'O time continua lutando pelo sucesso.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (146, \'Essa medida foi devidamente alterada.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (147, \'O estilete é uma arma perigosa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (148, \'Me aguarde, quinta-feira eu venho jantar em casa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (149, \'A mudança é lenta porém duradoura.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (150, \'O clima não é mais seco no interior.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (151, \'Sua sensibilidade mostrará o caminho.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (152, \'A Amazônia é a reserva ecológica do globo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (153, \'O ministério mudou demais com a eleição.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (154, \'Novas metas surgem na informática.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (155, \'O capital de uma empresa depende de produção.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (156, \'Se não fosse ela, tudo teria sido melhor.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (157, \'A principal personagem no filme é uma gueixa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (158, \'Espere seu amigo em casa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (159, \'A juventude tinha que revolucionar a escola.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (160, \'A cantora terá quatro meses pra ensaiar seu canto\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (161, \'Prazer em conhecê-los.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (162, \'Elas traziam o equipamento.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (163, \'O sol ilumina o planeta.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (164, \'A correção do exame foi coerente.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (165, \'O vidro é antigo mas o armário, não.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (166, \'O natal deve ser um dia alegre.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (167, \'Trabalhei mais do que podia.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (168, \'Hoje eu acordei calmo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (169, \'Esse canal parece bastante chato.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (170, \'Nem parece que nós nascemos aqui.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (171, \'Receba minha prima na festa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (172, \'Ela planejou um grande banquete cheio de gente.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (173, \'No lado de cá do rio há uma boa sombra.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (174, \'A maioria dos visitantes gosta deste momento.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (175, \'Minha filha é especialista em música sacra.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (176, \'A casa só tem um quarto.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (177, \'A duração do simpósio é de cinco dias.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (178, \'Ao contrário de nossa expectativa, tudo foi tranquilo\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (179, \'A intenção é ter o apoio do governante.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (180, \'A fila aumentou ao longo do dia.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (181, \'À noite, a temperatura deve ir a zero.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (182, \'A proposta foi inspecionada pela gerência.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (183, \'Os quadros azuis mostram o codidiano.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (184, \'Já era tarde, quando ele me abordou.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (185, \'O canário canta ao amanhecer.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (186, \'A lojinha não fica na esquina.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (187, \'Meu bom time se consagrou como o melhor.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (188, \'O instituto deve servir a sua meta.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (189, \'Ele não entende, nem quando se fala pausadamente.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (190, \'Seu limite do cheque azul foi aumentado\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (191, \'O termômetro indicava o calor.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (192, \'O discurso de abertura tem que ser longo.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (193, \'Eu precisei de tempo na conferência.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (194, \'Zeca marcou a temporada de jogos.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (195, \'Nada como um almoço ao ar livre.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (196, \'Nossa filha é a primeira da classe.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (197, \'Gostaria de chamar meu pai.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (198, \'Não tive uma prova cansativa.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (199, \'Ainda tenho cinco telefonemas pra dar.\')');
$aDb->query('INSERT INTO phrases (id, phrase) VALUES (200, \'Os hotéis do sudoeste são fantásticos.\')');

echo 'Ok, database initialized';

?>
