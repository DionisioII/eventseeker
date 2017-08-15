-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Ago 11, 2013 alle 17:48
-- Versione del server: 5.6.11
-- Versione PHP: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eventseeker`
--
CREATE DATABASE IF NOT EXISTS `eventseeker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eventseeker`;

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `catId` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`catId`, `name`, `desc`) VALUES
(4, 'Cinema', 'L''appassionato di cinema è sempre avido di novità e tenere d''occhio i prossimi film in uscita è un''attività irrinunciabile. Su Movieplayer.it potete essere sempre informati sui film che approderanno prossimamente in sala navigando il nostro archivio mese per mese.\r\nIn attesa di Kick-Ass 2, Turbo e Monsters University, siete già curiosi di sapere quali altre release ci aspettano dopo l''estate o quando saranno in sala I Puffi 2, Percy Jackson e gli dei dell''olimpo: Il mare dei mostri o Turbo? Questa è la pagina che fa per voi.'),
(1, 'Concerti', 'Pronti con carta e penna per segnarvi i migliori concerti del 2013, di quel che ne resta ovviamente, con ben 15 appuntamenti da luglio a dicembre da non perdere per nessun motivo al mondo. 15 concerti eccezionali, pop e rock, all’aperto o al chiuso, in mega-spazi come lo stadio di San Siro o in luoghi più intimi come il Teatro degli Arcimboldi: ce n’è davvero per tutti i gusti e anche per tutte le tasche, ammesso che per questi spettacoli si riesca ancora a trovare un biglietto!\r\nSi comincia subito con lo show dei leggendari Depeche Mode a San Siro (18 luglio, già sold out ma torneranno anche nel 2014), per proseguire poi con altri nomi mitologici come Deep Purple e Patti Smith, fino a popstar più nostrane come Marco Mengoni, Emma e Max Pezzali.\r\nMa adesso mettetevi comodi e scoprite le date dei concerti a Milano nel 2013.'),
(2, 'Mostre', 'E’ appurato da un recente studio del ricercatore della Bocconi Guido Guerzoni, che in Italia si organizzano ben 11mila mostre l’anno, dunque oltre 30 al giorno (Natale e Pasqua compresi), non pensiamo perciò con questa breve guida di esaurire l’argomento, piuttosto di fornire qualche dritta sugli eventi più significativi del 2013.'),
(3, 'Opera', 'In questa pagina viene riportato l''elenco di tutti i teatri lirici in Italia, Enti Lirici e Cinema con la rispettiva stagione lirica, stagione sinfonica, i balletti e i musical nel 2013-2014.');

-- --------------------------------------------------------

--
-- Struttura della tabella `concert`
--

CREATE TABLE IF NOT EXISTS `concert` (
  `concert_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `price` varchar(8) NOT NULL DEFAULT '20',
  `max_num` int(11) NOT NULL DEFAULT '100',
  `description` mediumtext NOT NULL,
  `concert_image` text NOT NULL,
  PRIMARY KEY (`max_num`),
  UNIQUE KEY `id_concert` (`concert_id`),
  KEY `id_concert_2` (`concert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `concert`
--

INSERT INTO `concert` (`concert_id`, `name`, `location`, `date`, `start_time`, `price`, `max_num`, `description`, `concert_image`) VALUES
(1, 'Vasco Rossi', 'Arena di Verona', '2013-09-10', '00:20:30', '20', 100, ' Si concluderà questa sera il “mini” tour di Vasco Rossi, ritornato fieramente sul palco dopo un lungo periodo di assenza e di convalescenza che ha preoccupato i fan.\r\n\r\nMa il cantante ha voluto festeggiare il proprio comeback con una serie di concerti a Torino e Bologna che hanno visto immediatamente il sold out. E questa sera, 26 giugno 2013, il palco Dall’Ara vedrà congedarsi per un po’ la rockstar, pronto a conquistare ancora una volta il suo pubblico fedele, accorso numerosissimo ai suoi live.', 'vasco-rossi.jpg'),
(2, 'Laura Pausini', 'Teatro delle muse,Ancona', '2013-10-02', '00:21:30', '20', 250, 'In occasione dell’ Anniversary Party 2013 (Faenza, 20.10.2013), l’incontro annuale che Laura farà con gli iscritti del suo fan club ufficiale (per iscriversi www.laura4u.com ), Laura canterà live le 8 canzoni del suo primo album.\nMa non canterà da sola sul palco !\nInsieme a lei, potranno salire e cantare 8 fortunatissimi iscritti accompagnati da una delle “Laura Pausini Cover Band” .\nGli iscritti che avranno la grande fortuna di cantare insieme a Laura, saranno scelti tramite sorteggio il pomeriggio stesso.', 'laura-pausini.jpeg');

-- --------------------------------------------------------

--
-- Struttura della tabella `exposition`
--

CREATE TABLE IF NOT EXISTS `exposition` (
  `exposition_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `location` varchar(65) NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `time` time NOT NULL,
  `price` varchar(8) NOT NULL DEFAULT '20£',
  `max_num` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `exposition_image` text NOT NULL,
  PRIMARY KEY (`exposition_id`),
  UNIQUE KEY `exposition_id` (`exposition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `exposition`
--

INSERT INTO `exposition` (`exposition_id`, `name`, `location`, `start_time`, `end_time`, `time`, `price`, `max_num`, `description`, `exposition_image`) VALUES
(1, 'Le Domus Romane di Palazzo Valentini', 'Roma | Palazzo Valentini', '2013-10-16', '2013-12-31', '00:23:00', '20£', 0, ' Dal 16 ottobre 2010 gli scavi archeologici nel sottosuolo di Palazzo Valentini sono diventati un’esposizione permanente, che va ad arricchire il patrimonio storico artistico di Roma con la nuova area archeologica delle Domus Romane.', ''),
(2, 'I Signori di Ocre: dai Vestini ai Normanni', 'Ocre | Monastero Fortezza di Santo Spirito', '2013-12-17', '2013-12-31', '00:21:30', '20£', 0, ' Sabato 17 dicembre alle ore 17 presso il Monastero-Fortezza di Santo Spirito del Comune di Ocre in provincia dell''Aquila si inugura la mostra archeologica "I Signori di Ocre: dai Vestini ai Normanni", organizzata dall''Amministrazione Comunale in collaborazione con la Soprintendenza per i beni archeologici dell''Abruzzo e il Dipartimento di Storia e Metodologie Comparate dell''Università degli Studi dell''Aquila.', ''),
(3, 'Il ‘900 nelle raccolte civiche fiorentine', 'Viareggio | GAMC Lorenzo Viani', '2013-10-14', '2013-11-20', '00:20:00', '20£', 0, ' Il Comune di Viareggio, d’intesa con il Comune di Firenze, da sabato 26 maggio, alla GAMC “Lorenzo Viani” di Viareggio, presentauna mostra dedicata ai capolavori de Il ‘900 nelle raccolte civiche fiorentine, a cura di Alessandra Belluomini Pucci, direttore della Galleria d’Arte Moderna e Contemporanea, organizzata da Percorsi d’Arte.', ''),
(4, 'Vetro Murrino da Altino a Murano', 'Venezia | Museo Archeologico Nazionale di Altino - Museo', '2013-09-10', '2013-09-25', '00:18:00', '20£', 0, ' Una grande mostra che si articola in due sedi espositive – il Museo Archeologico Nazionale di Altino ed il Museo del Vetro di Murano – mette a confronto la tecnica di produzione vetraria della murrina, contraddistinta da esiti realizzativi straordinari, sviluppata in epoca romana (in area veneta) e poi ripresa a Murano, a fine Ottocento, dopo secoli di oblio e giunta fino ai nostri giorni.', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` int(11) NOT NULL,
  `question` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `answer`) VALUES
(1, 'Come si effettua una prenotazione per un evento?', 'Eseguendo la procedura di registrazione sul sito o Telefonando al numero 333-1234567- '),
(2, 'Come si effettua una prenotazione CUP? ', 'Recandosi direttamente ad un centro CUP.'),
(3, 'Come si possono conoscere gli eventi previsti?', 'Le informazioni relative agli eventi sono contenute nell''apposita sezione &quot;Our Events&quot;.'),
(4, 'Come &egrave; possibile sapere quali artisti saranno presenti ad una determinata manifestazione?', 'Le informazioni sono contenute nelle descrizioni di ogni evento.'),
(5, 'Come &egrave; possibile richiedere informazioni?', 'Telefonando al nostro centro medico al numero 333-1234567- Scrivendo una email all''indirizzo progetto.grp15@gmail.com : sar&agrave; dato riscontro nell''arco delle 24 ore lavorative.');

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `film_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `location` varchar(65) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `price` varchar(8) NOT NULL DEFAULT '20£',
  `max_num` int(11) NOT NULL DEFAULT '100',
  `description` mediumtext NOT NULL,
  `film_image` text NOT NULL,
  PRIMARY KEY (`film_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`film_id`, `name`, `location`, `date`, `start_time`, `price`, `max_num`, `description`, `film_image`) VALUES
(1, 'After Earth', 'Cinema Goldoni,Ancona', '2013-09-11', '00:20:30', '20', 100, 'In un futuro lontanissimo, un evento catastrofico ha costretto l''intera umanità ad abbandonare la Terra e a trovare un un nuovo pianeta abitabile in un''altra galassia. Mille anni dopo, sul pianeta Nova Prime, il giovane Kitai Raige affronta senza successo la sua prima prova per entrare nello United Ranger Corps e seguire le orme di suo padre Cypher, Primo Comandante degli stessi Ranger. Il rapporto tra padre e figlio è molto conflittuale e il ragazzo vorrebbe in ogni modo guadagnarsi il rispetto e l''approvazione del genitore; per questo, su suggerimento della madre, al ritorno di Cypher dopo l''ennesima lunga missione, l''uomo decide di portarlo in viaggio per trascorrere del tempo insieme e ristabilire un legame.', 'after-earth.jpg'),
(2, 'Appartamento ad Atene', 'Cinema Goldoni,Ancona', '2013-09-24', '00:20:30', '20', 100, '\r\n \r\nTRAMA\r\n\r\nAtene, 1942. I coniugi Helianos sono una coppia di mezza età che vive insieme ai loro due figli, Alex e Leda. La vita di questa tranquilla famiglia cambia radicalmente quando il loro appartamento viene requisito dal Capitano Kalter, un ufficiale nazista. Gli Helianos diventano improvvisamente schiavi a casa loro. Kalter impone ordine, disciplina ferra e la volontà del soldato diventa l''unica cosa che conta dentro le mura domestiche. Gli Helianos sono ormai rassegnati al ruolo di servi. All''improvviso, Kalter sparisce. Dovrebbe essere il ritorno alla libertà della famiglia Helianos, invece la tortura continua. Il ritorno dell''ufficiale dalla Germania rappresenta un sollievo. Il suo atteggiamento è cambiato: più gentile, più indulgente.', 'appartamento-atene.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `opera`
--

CREATE TABLE IF NOT EXISTS `opera` (
  `opera_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `location` varchar(45) NOT NULL,
  `start_time` time NOT NULL,
  `date` date NOT NULL,
  `price` varchar(8) NOT NULL DEFAULT '75',
  `max_num` int(11) NOT NULL DEFAULT '150',
  `description` mediumtext NOT NULL,
  `opera_image` text NOT NULL,
  PRIMARY KEY (`opera_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `opera`
--

INSERT INTO `opera` (`opera_id`, `name`, `location`, `start_time`, `date`, `price`, `max_num`, `description`, `opera_image`) VALUES
(1, 'Aida di Giuseppe Verdi', 'Sferisterium, Macerata', '00:21:30', '2013-10-01', '75', 150, 'E'' la storia di un Condottiero Egiziano (Radames) innamorato di una schiava Etiope (Aida) che parte per la guerra contro il re dell''Etiopia (Amonasro), padre di Aida.\r\nIl dramma nasce dal fatto che Radames dovrebbe sposare la figlia del Faraone (Amneris), ma in seguito all''accusa di tradimento, sarà condannato ad essere sepolto vivo.\r\n\r\nAida, volontariamente, dividerà con lui la triste sorte.', ''),
(2, 'Carmen di Georges Bizet', 'Arena di Verona', '00:21:30', '2013-10-16', '75', 150, 'La Carmen, il capolavoro di Georges Bizet, considerata opera nazionale francese, simile all’Aida in Italia, è una storia d’amore e morte, che tocca i vertici più alti della drammaticità.\r\n\r\nL’opera, in quattro atti, su libretto di Henri Meilhac e Ludovic Halévyè tratta da una novella di Prosper Mérimée (1845), ed il compositore collaborò alla stesura del libretto, rielaborando e modificando la trama.\r\n\r\nDella Carmen esistono diverse edizioni, che variano soprattutto nelle parti di recitativo e del duello fra José ed Escamillo.\r\n\r\nAnche se oggi la Carmen è considerata una delle più belle Opere Liriche, alla su prima non piacque agli spettatori ed alla critica: Il lavoro era troppo carico di intensità drammatica per piacere al pubblico dell''epoca; l’intreccio della storia venne giudicato immorale, per la presenza di zingari, contrabbandieri e fuorilegge e con un finale sanguinoso da cronaca nera.\r\nAnche la musica non fu gradita agli amanti della tradizione, perché giudicata dai critici, troppo “wagneriana"', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `usrId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  PRIMARY KEY (`usrId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`usrId`, `username`, `passwd`, `role`, `name`, `surname`) VALUES
(1, 'admin', 'pass', 'admin', 'Mario', 'Rossi'),
(2, 'user', 'pass', 'user', 'Utente', 'di Prova'),
(3, 'staff', 'pass', 'staff', 'Gianni', 'Celeste');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
