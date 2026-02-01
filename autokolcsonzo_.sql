-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Feb 01. 13:40
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `autokolcsonzo`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `activation`
--

CREATE TABLE `activation` (
  `id` int(11) NOT NULL,
  `fingerprint` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `activation`
--

INSERT INTO `activation` (`id`, `fingerprint`, `code`, `datetime`) VALUES
(1, 'B])¥gpR*•Tq*Kg*T±?9~;SL\"t5`I*®±<\"KUZX={%•1.uvu•c1,uRKz%9\"°)})¿*#]F€*¿MZ`®zvg`•<o£)}M8×C•×∞D±F]dTgz#*zZMz', 'YWN0aXZhdGUtLUg8I8Kwwq5IcW15WmlrYVNtIuKInnZTwqFEK2s7Q1BmRTVtPDtOUzDCsG3Dl07CrsK2QWxbIjc3b0NRcMKpUW12MHZQMGlbYTJTOOKImuKImsKwwrBLwrbCp8KuV05aaXhs4oKs4oSiQVPCp244RmxpIlHCpSNZwq5i4oSiOCMpbHZB', '0000-00-00 00:00:00'),
(2, '&S,fAtwFP##f¥f&=Q>aqV,®#$£K•XJ$×™¥Hf\">={rm?yP£73§hj)wN=3[)3n¥)Uw$™3nyf$;÷|;r)¿;¶§{&Nh×3L#{CK$×yom®€,¶F?®', 'YWN0aXZhdGUt4oCid2XCsV53ZMKxdzBuwrB9JXVzbiR1P19kWGTCpXVWMChFblNPKF1oNGNFwqd84oCiVsKjXnUyRXomTT9ZWVtRKEihKI5KF5Bw5coJCjCpy0iMChBXsKxbnt9RV7CqVZZU0tF4oKsfECpTwxd15de8KeFhkwqNodT4=', '0000-00-00 00:00:00'),
(3, 'W#?+√)∞+IS)CnUfl§X§-√•.l®F.In√y¶d_oG*S_®`0b#5on√√WK.lj-√l;TX®¥-#¢jnVY.¶6-O.{f#aOjf;+)¶d:,∞Q_WW`0`y7nGV√5', 'YWN0aXZhdGUtZSFAby4cHfCo3coMFRk4oKsMUXCoXczYDXCpWMjwrZ3VWNqwq5x4oCifi0wQ8KhY1vCo2NY4oKsa8KwJcKwNVQoO198cDtVUSlNY3wpRU00wrZQXn5kQ2DihKJrQiUxwqVb4oKsO1h2SEJec29UTnBjNVF2NXZAwqHihKI1MMKh', '0000-00-00 00:00:00'),
(4, '5<qog¿JJg|#iV+¥u_f^DhBB8b}zBp¥p£!d7&q0¶uI2÷wouBf<Mirqf\"-¶(YPfqhuV^-N+ii,rXf®X<XZM{J+∞0<^z_uR8!5X_D®Z^8rq', 'YWN0aXZhdGUt4oCi4oCiTiviiJpjXy5oRzZjwrA1wqMmUC5yNWRDwrFpwr9dwqNgQztkcGw2wr9LWDdCNSTDl0vCsCjColnigKI5fS59acKiTTZVJMKjJibCscKwJndpRWJFbSZYwrFNTGBfJkNLR23igKJOQuKImsKxacOXVjY2wrAqbWRCNGDCoX5tfSY=', '0000-00-00 00:00:00'),
(5, 'U™xPV∞q€™€s9]2™]®£×Xb°h,×k&]e~D@P@JpF®°£$q}MVVe©p5U8p°m_o%H™tH™t××¶sheD®2St×V°O£M6ltm%$2J$5~OX:%p$©±×%%:', 'YWN0aXZhdGUtPi4hPzsiZW1PP8KpKH5YdCglSTloVighaeKEonXCoyhPSTtPwrBlfCHColhlPyh14oSiNGNPbFrCoWEobsKiNMKhSyg7Pjg7fuKInk8NHrDl0p1Qi4oP8KhZW9vQm3CsCLCsU8sdXQSmnCojZe4oSiwrFsLlY0JcKhIWw0', '0000-00-00 00:00:00'),
(6, '€eK[€€kz¶l¡6€G¶<¶2O!Fe:x€n\"&1jc>€x#¡]gv\"W#\"&e×EqO}j5G7∞%>k12P]i%{{}∞[7€Y€eG¶Q¶••:2:¶GxH}•_Hrr0vK\"%>QHO}Y', 'YWN0aXZhdGUtPSQzRTBWTSh2c3pTdnzCojNqWMO34oSiR1JNWXjiiJ55YHxSZSJFNWEmLURwq7Cp3o6fOKInkMuwr93wqc6VVZw4oSiWXx6wqF34oiefHoww7fCo30sJE19ajNhQ0V3w7fDt0VNTcKubX58ZU07wqPCo1rihKJlTUctYsKjQ346Q3w=', '0000-00-00 00:00:00'),
(7, '*÷}×:×©2x™£jWB%gNt|•f[¶)®*4fW•Df£<Edxe>DFs4=¡g|)×mTKT*A<-)oYn¥2T>¶mv}7x%c×2U}¡%¶£<×W}•¥+pnnZ3¥:[£[zB<ECP', 'YWN0aXZhdGUtJU3CoTJPTypfTktARypL4oiaejRbXeKCrGgqdWZrwqNxcjh5LHV7THbCtktF4oKsdTQhMkw4dcK2KXvCsUvigqwo4oiaa2k0N8KpN8Kj4oSidl7igqwycVpWaFAqS0vCocKpO1HCsSzigqxDQnRWOEDCokA7fHVLOFZCeCzCrk50Q8Kiaw==', '0000-00-00 00:00:00'),
(8, '};is5}÷iR|DevX±bsVb±V<FF!∞R€4AM±]3JDPPe45bvki}5n~|LPhzJ5bA5sP#€i6¡?s×€5Av=5MiDA3V;TrMhb°s!JVc]JF;]?~Xiv!', 'YWN0aXZhdGUtJkQ24oCiRFpxLWtpS2t4XmYkUSpaYjTCsX0ccKxwrHiiJo6WCpbZuKImloel5iWzo6JHJnYXHiiJpLcuKAomZES0dU4oCifsKxZ3FaeXdqQWt8WnlKRXBpNVRHRyFaJHF3wrZYZ1tWwrZr4oCiazHCo8O3QmVPwrYmQXBrZw==', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autok`
--

CREATE TABLE `autok` (
  `auto_id` int(11) NOT NULL,
  `marka` varchar(128) NOT NULL,
  `modell` varchar(128) NOT NULL,
  `evjarat` int(4) NOT NULL,
  `alvazszam` varchar(128) NOT NULL,
  `rendszam` varchar(128) NOT NULL,
  `allapot` enum('Elérhető','Nem elérhető','','') NOT NULL DEFAULT 'Elérhető',
  `napi_dij` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `autok`
--

INSERT INTO `autok` (`auto_id`, `marka`, `modell`, `evjarat`, `alvazszam`, `rendszam`, `allapot`, `napi_dij`) VALUES
(10, 'Mitsubishi', 'Lancer Evolution VIII', 2006, 'MLE658482D', 'AAHJ-562', 'Elérhető', 39990.00),
(11, 'BMW', '316i', 2006, 'WDA5748FF48', 'RED-273', 'Elérhető', 27990.00);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `loginname` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `regisztracioideje` datetime NOT NULL,
  `password` varchar(128) NOT NULL,
  `fingerprint` varchar(256) NOT NULL,
  `state` smallint(6) NOT NULL DEFAULT 0,
  `admin` smallint(6) NOT NULL DEFAULT 0,
  `reminder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `name`, `loginname`, `email`, `regisztracioideje`, `password`, `fingerprint`, `state`, `admin`, `reminder`) VALUES
(1, 'admin123', 'admin123', 'admin@gmail.com', '2026-02-01 09:32:42', '0192023a7bbd73250516f069df18b500', '', 1, 1, NULL),
(10, 'valaki', 'valaki123', '  valaki@gmail.com', '2026-02-01 11:49:07', '7815696ecbf1c96e6894b779456d330e', '};is5}÷iR|DevX±bsVb±V<FF!∞R€4AM±]3JDPPe45bvki}5n~|LPhzJ5bA5sP#€i6¡?s×€5Av=5MiDA3V;TrMhb°s!JVc]JF;]?~Xiv!', 1, 0, 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `autok`
--
ALTER TABLE `autok`
  ADD PRIMARY KEY (`auto_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `activation`
--
ALTER TABLE `activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `autok`
--
ALTER TABLE `autok`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
