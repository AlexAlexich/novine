-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2022 at 05:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novine`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `idGlasanja` int(11) NOT NULL,
  `idPodkategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`idGlasanja`, `idPodkategorija`) VALUES
(1, 2),
(4, 2),
(6, 2),
(8, 3),
(2, 4),
(3, 7),
(7, 10),
(5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `idKategorija` int(11) NOT NULL,
  `nazivKategorija` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanjaSlike` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`idKategorija`, `nazivKategorija`, `putanjaSlike`) VALUES
(1, 'Sport', 'assets/img/sport.jpg'),
(2, 'Vesti', 'assets/img/download1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idKomentara` int(11) NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `datumKomentara` timestamp NOT NULL DEFAULT current_timestamp(),
  `aktivanKomentar` tinyint(10) NOT NULL DEFAULT 1,
  `idUser` int(11) NOT NULL,
  `idVest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKomentara`, `opis`, `datumKomentara`, `aktivanKomentar`, `idUser`, `idVest`) VALUES
(6, 'Komenatisemo ovde', '2022-03-09 22:59:07', 1, 34, 4),
(7, 'Komentar 2', '2022-03-10 11:22:39', 1, 1, 4),
(8, 'Komentarisem ja', '2022-03-10 11:22:39', 1, 33, 4),
(10, 'Unosim komentar test', '2022-03-12 11:35:43', 0, 1, 11),
(11, 'Wow, ovo je strava!', '2022-03-12 11:37:20', 1, 24, 11),
(12, 'I treba, lopovi!', '2022-03-12 14:32:04', 1, 37, 17),
(13, 'Stvarno je haos u ovom gradu..', '2022-03-12 14:32:24', 1, 37, 16),
(14, 'Neka i oni malo osete pritisak!', '2022-03-12 14:32:41', 1, 37, 12),
(15, 'Slazem se sa mikracem!', '2022-03-12 14:33:51', 1, 31, 17),
(16, 'Bice veselo !', '2022-03-12 14:34:01', 1, 31, 14);

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `idKontakt` int(11) NOT NULL,
  `imeKontakt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emailKontakt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `porukaKontakt` text COLLATE utf8_unicode_ci NOT NULL,
  `idRazlog` int(11) NOT NULL,
  `datumKontakt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`idKontakt`, `imeKontakt`, `emailKontakt`, `porukaKontakt`, `idRazlog`, `datumKontakt`) VALUES
(1, 'Aleksandar', 'alexichalex17@gmail.com', 'Konjina', 1, '2022-03-09 16:39:32'),
(2, 'Pisko', 'pisko@gmail.com', 'Mogu li da dobijem unban?', 4, '2022-03-09 22:53:09'),
(3, 'Aleksandar', 'alexichalex17@gmail.com', 'Zelim da budem novinar', 2, '2022-03-12 15:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `podkategorija`
--

CREATE TABLE `podkategorija` (
  `idPodkategorija` int(11) NOT NULL,
  `nazivPodkategorija` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idKategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `podkategorija`
--

INSERT INTO `podkategorija` (`idPodkategorija`, `nazivPodkategorija`, `idKategorija`) VALUES
(1, 'Ko??arka', 1),
(2, 'Fudbal', 1),
(3, 'Odbojka', 1),
(4, 'Tenis', 1),
(5, 'Ostali sportovi', 1),
(7, 'Svet', 2),
(10, 'Region', 2),
(12, 'Srbija', 2),
(13, 'Rukomet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `razlog`
--

CREATE TABLE `razlog` (
  `idRazlog` int(11) NOT NULL,
  `imeRazlog` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `razlog`
--

INSERT INTO `razlog` (`idRazlog`, `imeRazlog`) VALUES
(1, 'Bug report'),
(2, 'Zahtev za novinara'),
(3, 'Poslovna ponuda'),
(4, 'Unban zahtev');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloga` int(10) NOT NULL,
  `nazivUloga` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `putanjaSlikaUloga` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloga`, `nazivUloga`, `putanjaSlikaUloga`) VALUES
(1, 'korisnik', 'assets/img/default.png'),
(2, 'novinar', 'assets/img/novinar.png'),
(3, 'admin', 'assets/img/admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `imeUser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezimeUser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emailUser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `passwordUser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aktivanUser` tinyint(1) NOT NULL DEFAULT 1,
  `datumRegistracije` datetime NOT NULL DEFAULT current_timestamp(),
  `idUloga` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `imeUser`, `prezimeUser`, `username`, `emailUser`, `passwordUser`, `aktivanUser`, `datumRegistracije`, `idUloga`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 1, '2022-03-07 13:42:39', 3),
(10, 'Alek', 'Aleksic', 'Alex22', 'alex@gmail.com', 'dcd51febc4faeb7926f1e5f5ace0c1c6', 0, '2022-03-08 16:27:58', 1),
(24, 'Alek', 'Pisic', 'Pisko22', 'pisko@gmail.com', 'dcd51febc4faeb7926f1e5f5ace0c1c6', 1, '2022-03-08 17:41:43', 2),
(25, 'Alek', 'Aleksic', 'Alex222', 'aex17@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 17:45:52', 2),
(26, 'Alek', 'Aleksic', 'alek322', 'alek322@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 18:31:08', 2),
(27, 'Alek', 'Sasda', 'Alex2223', 'pisko2@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 19:00:21', 1),
(28, 'Alek', 'Sasda', 'Alex22234', 'pisko23@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 19:01:18', 1),
(29, 'Alek', 'Sasda', 'Alex222345', 'pisko235@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 19:01:37', 1),
(30, 'Alek', 'Aleksic', 'Aleks', 'alexich@gmail.com', 'dcd51febc4faeb7926f1e5f5ace0c1c6', 1, '2022-03-08 19:10:42', 1),
(31, 'Petar', 'Peric', 'Perica', 'Pero222@gmail.com', 'dcd51febc4faeb7926f1e5f5ace0c1c6', 1, '2022-03-08 19:12:58', 1),
(32, 'Marko', 'Markovic', 'markic322', 'markov@gmail.com', 'da875ed6338b36093d4f991bd444b3d7', 1, '2022-03-08 19:14:25', 1),
(33, 'Petar', 'Peric', 'Perica22', 'peric@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 19:14:58', 1),
(34, 'Alek', 'Aleksic', 'Aleksandar23', 'alexichalex17@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-08 19:19:33', 1),
(35, 'Mirko', 'Markovic', 'Mirkic', 'mirkic@gmail.com', 'dcd51febc4faeb7926f1e5f5ace0c1c6', 1, '2022-03-08 19:20:35', 1),
(36, 'Alek', 'Aleksic', 'Alex2233', 'alexi@gmail.com', '729dfac0176cbe2d5752d084ed63f464', 1, '2022-03-09 12:19:46', 1),
(37, 'Mirko', 'Mitrovic', 'mikrac99', 'mirko99@gmail.com', 'dcd51febc4faeb7926f1e5f5ace0c1c6', 1, '2022-03-12 15:31:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vest`
--

CREATE TABLE `vest` (
  `idVest` int(11) NOT NULL,
  `naslov` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` text COLLATE utf8_unicode_ci NOT NULL,
  `putanjaSlikeVest` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `idPodkategorije` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `vestAktivna` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vest`
--

INSERT INTO `vest` (`idVest`, `naslov`, `sadrzaj`, `putanjaSlikeVest`, `datum`, `idPodkategorije`, `idUser`, `vestAktivna`) VALUES
(4, 'Test vest 1', 'Testriam ja sad ovo ovde', 'assets/img/vest3.jfif', '2022-03-09 11:22:14', 7, 10, 0),
(7, 'Vest sveta kosarake', 'Kosaraka je novi najpopularniji sport', 'uploads/1647082718_vest.jpg', '2022-03-11 22:20:08', 1, 10, 0),
(8, 'Napadamo sve redom', 'Srbija napada sve redom', 'uploads/1647082790_vest3.jfif', '2022-03-11 22:39:54', 7, 1, 0),
(9, 'Hasbula boksuje protiv Abdu Rozika', 'Hasbula je zakazao mec protiva Abdu Rozika za 25. maj. Sve o mecu pratite na Ekspres Vestima!', 'uploads/1647035693_Hasbulla_Magomedovjpg-JS660729602.jpg', '2022-03-11 22:54:53', 5, 10, 0),
(10, 'Novi Naslov', 'Novi Opis brate moj', 'uploads/1647035759_jackpot-banner.png', '2022-03-11 22:55:59', 5, 10, 0),
(11, 'Final test vesti', 'Finalno tesstiram unos konacno', 'uploads/1647079709_vest.jpg', '2022-03-12 11:08:29', 1, 1, 0),
(12, 'RUSIJA ZAPRETILA AMERICI \"Konvoji kojima ??aljete oru??je Ukrajini za nas su od sada LEGITIMNE METE\"', 'Visoki ruski diplomata upozorio je da ??e Moskva od sada smatrati po??iljke oru??ja Ukrajini \"legitimnim metama\".Komentari zamenika ministra spoljnih poslova Sergeja Rjabkova, koje su preneli Skaj njuz i Bazfid, verovatno ??e izazvati strah od potencijalne eskalacije sukoba u Ukrajini.Rjabkov je rekao da je Rusija jasno iznela svoj stav SAD, prenosi \"Gardijan\".\r\n\r\nOn je rekao da je Rusija \"upozorila SAD da isporuka oru??ja iz brojnih zemalja koje orkestrira nije samo opasan potez, to je akcija koja te konvoje ??ini legitimnim metama\".\r\nOsvrc??uc??i se na ameri??ke sankcije Moskvi, on je rekao da su one \"poku??aj bez presedana da se zada ozbiljan udarac razli??itim sektorima ruske ekonomije\".\r\nAli on je insistirao da Rusija nema nameru da protera zapadne medije i kompanije, dodajuc??i: \"Nec??emo eskalirati situaciju.\"', 'uploads/1647093881_the-flagpole-2877540_1920-750x499.jpg', '2022-03-12 15:04:41', 7, 1, 1),
(13, 'Tragedija: Umro biv??i fudbaler Partizana u 43. godini', 'Biv??i fudbaler Partizana Dragoljub Jeremi?? preminuo je u 43. godini.\r\nVest je prvi objavio biv??i kapiten crno-belih Sa??a Ili?? na svom instagram nalogu.\r\nUzrok smrti nije poznat, zna se samo da je Jeremi?? nekoliko poslednjih dana proveo u bolnici.\r\nDragoljub Jeremi?? ro??en je 9. avgusta 1978. godine u Beogradu. Fudbalsku karijeru je zapo??eo u beogradskom Partizanu. Igrao je na poziciji odbrambenog igra??a. Sa crno belima je osvojio tri titule u prvenstvu i dva trofeja u kupu. U nekoliko klubova je igrao kao igra?? na pozajmici, prvo za Radni??ki Kragujevac, potom za Panseraikos i Rabotni??ki. Igra??ku karijeru je zavr??io u redovima Be??anije.\r\nIgrao je za kombinovanu reprezentaciju SR Jugoslavije 2001. godine na turniru ???Milenijum Kup??? u Indiji.\r\nVreme i mesto sahrane bi??e naknadno objavljeni.\r\n\r\n', 'uploads/1647094036_dragoljub-jeremic.jpg', '2022-03-12 15:07:16', 2, 10, 1),
(14, '??PANCI KA??U - GOTOVO JE! Real zadao novi udarac PS??-u i \"ukrao\" im Mbapea, evo kada se o??ekuje transfer bomba', 'Prema pisanju ??panski medija, Kilijan Mbape ??e uskoro parafirati ugovor sa Real Madridom.\r\nDva gola Mbapea u dvome??u protiv ???kraljevskog kluba??? bila su nedovoljna Pari Sen ??ermenu za plasman u ??etvrtfinale Lige ??ampiona. Na drugoj straini jo?? je raspolo??eniji bio drugi Francuz, Karim Benzema koji je het-trikom eliminisao ???svece??? koji su na ???Santijago Bernabeu??? do??li sa predno????u od 1:0.\r\nIpak, fudbal je timska igra i na kraju je tu bio uspe??niji Real koji ??e, nakon ??to ih je eliminisao iz Evrope, Pari??anima po svemu sude??i oteti i najboljeg fudbalera.\r\n\r\nPrema pisanju ugledne \"Marke\", najtrofejniji tim ???starog kontinenta??? ??e ve?? tokom slede??e nedelje zavr??iti posao oko francuskog napada??a!\r\n\r\nMbape ??e se u Madrid preseliti kao slobodan igra??, po??to mu na kraju sezone isti??e ugovor sa PS??-om, koji je poslednjih nedelja ulo??io mnogo truda ne bi li naterao supertalentovanog francuza da promeni mi??ljenje i potpi??e novi ugovor. ??ak se pominjalo da su ???sveci??? u ovu misiju oklju??ili I sam dr??avni vrh Francuske, a fudbaleru za novi dvogodi??nji ugovor ponudili atronoskih 200.000.000 evra.\r\nIpak, ??ini se da je sve bilo uzalud. Madri??ani su u poslednjih nekoliko dana intenzivirali pregovore sa Kilijanom, koji im ve?? nekoliko meseci figurira primarna meta za letnji prelazni rok.\r\n\r\nPredsednik ???kraljevskog kluba??? Florentino Perez dobro zna kako se zavr??avaju megalomanski transferi, a on vidi upravo Mbapea kao centar novog fudbalskog projetka u Madridu i predvodnika jedne nove generacije ???galaktikosa??? koja bi trebala da uspostavi novu dominaciju evropskim fudbalom.\r\n\r\nNakon ??to je Real eliminisao PS?? ??ini se da je mladi Francuz shvatio da mu je potrebna promena i tim u kojem ??e njegovi kapaciteti biti ispra??eni na adekvatan na??in, ??to ??e mu omogu??iti ??ansu da se bori za onaj najzna??ajniji trofej ??? Lige ??ampiona ali dati mu prednost u trci za ???zlatnu loptu???.\r\n\r\nNaravno, zna??ajan ??e biti i finansijski aspekt ove pri??e. ??panski mediji pretpostavljaju da ??e plata mladog napada??a biti oko 25.000.000 evra, a da ??e \"na ruke\" dobiti izme??u 60.000.000 i 80.000.000 evra ??im potpi??e ugovor.', 'uploads/1647094508_download.jpg', '2022-03-12 15:15:08', 2, 10, 1),
(15, 'Lejkersi pucaju po ??avovima: Lebron ne mo??e da podnese Vestbruka?', 'Reakcija Lebrona D??ejmsa na proma??aj Rasela Vestbruka nikome nije promakla.D??ejms je Va??ington Vizardsima ubacio 50 poena u pobedi 122:109 i tako pokazao da jedini ove sezone igra dobro u Lejkersima.Od samog po??etka na udaru je Rasel Vestbruk, koji bi trebalo da je drugi igra?? ekipe kada nema Entonija Dejvisa, koji je povre??en skoro cele sezone.\r\nVestbruk igra mo??da i najlo??iju sezonu u karijeri, a protiv Vizardsa je ??utirao 2/11 i postigao samo pet poena.\r\n\r\nPosle jedne akcije, delovalo je kao da se D??ejmsu smu??io Vestbruk.\r\n\r\nPlejmejker proma??io je otvoreno polaganje u kontri, kada su Lejkersi bili u zaostatku 52:57.\r\n\r\nD??ejms je Va??ington Vizardsima ubacio 50 poena u pobedi 122:109 i tako pokazao da jedini ove sezone igra dobro u Lejkersima.\r\n\r\nOd samog po??etka na udaru je Rasel Vestbruk, koji bi trebalo da je drugi igra?? ekipe kada nema Entonija Dejvisa, koji je povre??en skoro cele sezone.\r\n\r\n\r\nVestbruk igra mo??da i najlo??iju sezonu u karijeri, a protiv Vizardsa je ??utirao 2/11 i postigao samo pet poena.\r\n\r\nPosle jedne akcije, delovalo je kao da se D??ejmsu smu??io Vestbruk.\r\n\r\nPlejmejker proma??io je otvoreno polaganje u kontri, kada su Lejkersi bili u zaostatku 52:57.\r\n\r\nLebron nije mogao da veruje ??ta je video i razo??arano se okrenuo, a Vizardsi su poentirali za +7 u kontri.\r\n\r\nD??ejms je bio ??okiran i u narednom napadu.\r\n\r\n\r\n\r\n\r\n', 'uploads/1647094600_965833d9-2f76-4e79-bd87-f2bc61282c90_1339931_TABLET_LANDSCAPE_LARGE_16_9.jpg', '2022-03-12 15:16:40', 1, 10, 1),
(16, '\"MLADI?? JE VIKAO, DOZIVAO POMO??, HODNIK JE CEO BIO KRVAV\" Jeziv prizor u zgradi u kojoj je sino?? MLADI?? IZBODEN ??RAFCIGEROM, kom??ije: \"Niko nije smeo da iza??e\"', 'U beogradskom naselju Bra??e Jerkovi?? sino?? se odigrala prava drama prilikom koje je jedan mladi?? zadobio te??ke telesne povrede.\r\nNaime, beogradska policija je sino?? uhapsila Stefana S. (23) zbog sumnje da je da je ??rafcigerom u vrat ubo Milo??a P. (27) u jednom stanu u ovom naselju.\r\nKrvavom obra??unu je prethodila sva??a izme??u dva mladi??a kada je Stefan do??ao u stan u kom su se osim Milo??a nalazile i S. M. (27) i M. S. (30).\r\nKom??ije su rekle da su poslednjih mesec i po dana u zgradi problemi postali preveliki, u tom stanu su se svakodnevno okupljali problemati??ni ljudi.\r\n\r\n- Mladi?? je vikao, dozivao pomo??, hodnik je ceo bio krvav. Niko nije smeo da iza??e iz zgrade kada smo videli mladi??a skroz krvavog. Zvali smo policiju, odmah je do??la, sa njima i Hitna pomo?? - rekla je kom??inica za Kurir.\r\nOna dodaje da se pre napada iz stana ??ula buka.\r\nPodsetimo, Milo?? je sa te??kim povredama prevezen kolima Hitne pomo??i u Urgentni Centar, dok je policija prona??la i uhapsila Stefana.\r\nIna??e, kako saznajemo, re?? je o mladi??u koji iza sebe ima 100 krivi??nih dela.', 'uploads/1647094827_Beta-weknw3w188-750x500.jpg', '2022-03-12 15:20:27', 12, 10, 1),
(17, 'GUVERNERKA OGRANI??ILA MENJA??NICE Nova odluka stupila na snagu: NBS je menja??ima sada smanjila provizije', 'Narodna banka Srbije izmenila je Odluku o uslovima i na??inu obavljanja menja??kih poslova, pa je menja??nice ograni??ila da pri prodaji i otkupu od fizi??kih lica mogu naplatiti proviziju od najvi??e jedan posto.\r\nRa??unica sada, posle objave izmenjene odluke, izgleda ovako: u menja??nicama se devizni kurs evra formira tako ??to su dozvoljena odstupanja od srednjeg kursa najvi??e 1,25% navi??e i nani??e, i na to mo??e da se, i kod prodajnog i kod otkupnog kursa, doda provizija od 1%.Zvani??an srednji kurs NBS za 11. mart, iznosi 117,6470 dinara, a kada se na to doda 1,25%, koliko mo??e da iznosi maksimalni prodajni kurs, pa na zbir jo?? 1% provizije, gra??ane u menja??nicama evro mo??e da ko??ta maksimalno 120,31 dinar.U suprotnom smeru - kada se od srednjeg kursa oduzme 1,25%, koliko mo??e da iznosi minimalni otkupni kurs u menja??nicama, pa se dobijeni rezultat umanji za jo?? 1% provizije, dobije se minimalnih 115,01 dinar za koliko gra??ani mogu da prodaju evro u menja??nicama.\r\n\r\nU Odluci NBS, objavljenoj u Slu??benom glasniku, navodi se i da na po??etku radnog vremena menja?? mora da na vidnom mestu istakne, na na??in na koji je istaknuta i kursna lista, da proviziju napla??uje do maksimalno jedan posto.\r\n\r\nDo sada su, podsetimo, menja??nice mogle da zara??unavaju proviziju od jedan odsto pri otkupu deviza od gra??ana, dok provizija pri prodaji evra i drugog stranog novca nije bila ograni??ena.Do ovakve odluke do??lo je po??to je NBS obavila kontrolu vi??e menja??nica zbog navoda da su prodavale evro po ve??em kursu.', 'uploads/1647095183_36691754_RC4E6co7nLqTZnRHwWFUvDGcfyK9VhRURXJ5qk7b-K0.jpg', '2022-03-12 15:26:23', 12, 24, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`idGlasanja`),
  ADD KEY `idPodkategorija` (`idPodkategorija`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`idKategorija`),
  ADD UNIQUE KEY `nazivKategorija` (`nazivKategorija`),
  ADD UNIQUE KEY `putanjaSlike` (`putanjaSlike`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idKomentara`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idVest` (`idVest`);

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`idKontakt`),
  ADD KEY `idRazlog` (`idRazlog`);

--
-- Indexes for table `podkategorija`
--
ALTER TABLE `podkategorija`
  ADD PRIMARY KEY (`idPodkategorija`),
  ADD UNIQUE KEY `nazivPodkategorija` (`nazivPodkategorija`),
  ADD KEY `idKategorija` (`idKategorija`);

--
-- Indexes for table `razlog`
--
ALTER TABLE `razlog`
  ADD PRIMARY KEY (`idRazlog`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloga`),
  ADD KEY `idSlika` (`putanjaSlikaUloga`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `emailUser` (`emailUser`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idUloga` (`idUloga`);

--
-- Indexes for table `vest`
--
ALTER TABLE `vest`
  ADD PRIMARY KEY (`idVest`),
  ADD UNIQUE KEY `naslov` (`naslov`),
  ADD UNIQUE KEY `putanjaSlike` (`putanjaSlikeVest`),
  ADD UNIQUE KEY `sadrzaj` (`sadrzaj`) USING HASH,
  ADD KEY `idPodkategorije` (`idPodkategorije`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `idGlasanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `idKategorija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idKomentara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `idKontakt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `podkategorija`
--
ALTER TABLE `podkategorija`
  MODIFY `idPodkategorija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `razlog`
--
ALTER TABLE `razlog`
  MODIFY `idRazlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `vest`
--
ALTER TABLE `vest`
  MODIFY `idVest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa`
--
ALTER TABLE `anketa`
  ADD CONSTRAINT `anketa_ibfk_1` FOREIGN KEY (`idPodkategorija`) REFERENCES `podkategorija` (`idPodkategorija`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`idVest`) REFERENCES `vest` (`idVest`);

--
-- Constraints for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD CONSTRAINT `kontakt_ibfk_1` FOREIGN KEY (`idRazlog`) REFERENCES `razlog` (`idRazlog`);

--
-- Constraints for table `podkategorija`
--
ALTER TABLE `podkategorija`
  ADD CONSTRAINT `podkategorija_ibfk_1` FOREIGN KEY (`idKategorija`) REFERENCES `kategorija` (`idKategorija`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idUloga`) REFERENCES `uloga` (`idUloga`);

--
-- Constraints for table `vest`
--
ALTER TABLE `vest`
  ADD CONSTRAINT `vest_ibfk_1` FOREIGN KEY (`idPodkategorije`) REFERENCES `podkategorija` (`idPodkategorija`),
  ADD CONSTRAINT `vest_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
