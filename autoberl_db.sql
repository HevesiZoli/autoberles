-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2026. Ápr 01. 21:36
-- Kiszolgáló verziója: 11.8.6-MariaDB
-- PHP verzió: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `autoberl_db`
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
(8, '};is5}÷iR|DevX±bsVb±V<FF!∞R€4AM±]3JDPPe45bvki}5n~|LPhzJ5bA5sP#€i6¡?s×€5Av=5MiDA3V;TrMhb°s!JVc]JF;]?~Xiv!', 'YWN0aXZhdGUtJkQ24oCiRFpxLWtpS2t4XmYkUSpaYjTCsX0ccKxwrHiiJo6WCpbZuKImloel5iWzo6JHJnYXHiiJpLcuKAomZES0dU4oCifsKxZ3FaeXdqQWt8WnlKRXBpNVRHRyFaJHF3wrZYZ1tWwrZr4oCiazHCo8O3QmVPwrYmQXBrZw==', '0000-00-00 00:00:00'),
(9, '©28£D[,:gH.×T[=E0=i×~i-=,mjEbU8oD[noXmTv[}¡nTSAd6Sox>[°yUc¡∞&5€MyW=eH∞D=\"nXoNVM9yHs~0™@@*c`a&T_FHm[NEbL}', 'YWN0aXZhdGUtc3MoRTPCsFLCsGQwqMrwq7CqXNoPn4mUSgmNnPiiJ7Co2x2fmJdaUl8wqczwr9YReKInjbCqWdiOn5nXVJ8YigoZ35Xwr9FdStYUTNJPj9b1ctR29dU1RFTn51VHNXwrBHbcKfsKwVMKhfnrCp3h8dzAwd1RqYmls', '0000-00-00 00:00:00'),
(10, 'r&:o€[7tD¿tqM[-Uyp£)=.xA÷i2&÷¿}&3M¿qNC[;u}¿kHp[&HJLMpy)¡*i9qkd)¿>oVLmbTC$iHD5q¿&*¿GV}¶*¶x∞±m5D&<m=2¥t£*m', 'YWN0aXZhdGUtOW7Cv0MsISUlaUh2WzZJJXwwI35iwqLCsHVDSW5PcDlQaXwjcFkkYmZhVEzDlyh1ZiF6fH1GISzCtsOXwqIsdjfihKIhSnUwRCPigqx2cERwaW5SZjcpUeKCrCwtUik5U1l0eGVwwqFRN3otKsKieDlOjphaik=', '0000-00-00 00:00:00'),
(11, '¥=€}=U1%)PLtX[yXGkx√)k€GZ:u8q5$$N§!!yGef}%q8;c>°©°cGV5!&T%f$yA.Xdftuee€x=C§b*fr)¿T¶yXII![yT|eN!¶§NG€)?eC', 'YWN0aXZhdGUtwrbCp0dEbSNOUkcyW1YxKVtQw7cjYylDX1LCoTpfdk5bUErCqWI2wrbiiJ5DIzImLlIjaGZuSuKAokZjY3tSQ3xD4oiawrFqw7crX23CoSMpbkM6QDJEUMO3TTzCv03Dt05AQF7CpTFUSislQMKhblt9w7dqOkFqSjrigqxUJg==', '0000-00-00 00:00:00'),
(12, 'rs}dc(¶1M±6¶`rd1©*F[98f¶¶_[b¶yD+°[YP6©©°M8&~WwDc)rVHr}9RR@Y±¶¶c¥eeU6^[Y}¶€J¥_^V1w¥§(d1br^UyM`w4±SV9w€r^[', 'YWN0aXZhdGUtfG8qJFfCp00qW2dHOcKwrZrWWXiiJ7Cv2Vy4oieOXIyWGdo4oiefGvCvzl6Y1lsVlpdPXwqRFt5NjnCsC0kS3PCsFjCvzwhb21MMmtQQGlqS0BraD0ybUXiiJ7Cv14kQFUtQDxsc2s8wqdZb3xlOGw2OVfCv2ArViRU', '0000-00-00 00:00:00'),
(13, '§>s=0Z;F®cEqZqt0¿|i§>}>w×nMGYwGJ>G).B±cV±smeR`$K0™×¡cJMZt;±w¿X£+Y)rM™c¿cEwZf(n±w)$+§Xq>^}EZZG;¿Z¿,a`:^Z£', 'YWN0aXZhdGUtZ1IjwqEjbiJuKUk6S37CpeKAojlGwrFTK2PCpVNKbjHCvyNmM2pB4oCiPuKCrMKwqXCtl4oK8KxQkfCpWnigKJUcU12XsKlXeKAokNRbmnCoT434oCiQTRZW5VLmVzLGY2X15Nc2Jz4oieQi7Cp1CoikrWcK2ZD4jLn5KQDE6fSlJIg==', '0000-00-00 00:00:00'),
(14, 'w©pi¢¥;JS[^¡BE<ri_`d3_mP®!K&£n;£Jnndc©!©b_!Q3_^¡k_£<prc<©0L3_<b~V~©99U0SD)d£c`ErV<¢`Q&©P∞EGbSBcF{££(&-w0', 'YWN0aXZhdGUtaTZNOCI7MTssTnlGwrBbdiFGNTt1wrDDt2p8JFB8UGjCpThIdm07UDFewqdSUsOXUmjCpcKwU8O3wqUhU1NQw7ciwqVSfnp2XSx6ZnTCsHo1ISLDl3VQZFV5O0hBQlJqVWpGUlZ0wrDt0xQJCJ1wrBfRlJ0ZsKlw7dn', '0000-00-00 00:00:00'),
(15, '¡o+¥™∞×¢:o™ld`=¥£©GYz4Rpih¶TMv@\"A√=xPz¿¿p;ig>l¿©BM=\"•+[[zlEPK4E#P¶¥#@P×I=e7©e¢B7o;×#h¶BA€x>•v8zpg71∞∞P~y', 'YWN0aXZhdGUtWmdTLW40acKxaMKxbVpW8KhQW08c3wrNXdsPzQMcKwcj8xNiljKHJyIitDNn40WlF34oKsw7dJwrBhOsKwbsKwSMOXblfCv8KwPHVXbjY6fXXDl3d1c0lHc3dU0MRUl3c0FTNEgVsKpbVZHJUNfP0lFbH0=', '0000-00-00 00:00:00'),
(16, '9a`<•sc€nsc\"?€6§q¢k-KfSr€s€y¶6[wvX%U,¶m&±Ld;W8€+L√S€8€?WL1?8d6©1+d×Fq&Udf86f;W9Kksxd%6ldk•c?|<©Q+\"[^d;¶,', 'YWN0aXZhdGUtPGCrlJxesKiMeKImk42RVpRS0XCsDJSUmEyInlSRWlse0VYZkbCoWE2OsKu4oSiwqfigKIlJiFFwq7CoVJFdMKj4oieKzhiwrDCsEbiiJpMUsKiO0x74oSiTlgyJkvCpTpvaWFeIkVewqVSXnDCoKInsKi4oCi4oiaVktFe8Kw4oiawqJrwqUlwq7ComxBwrA=', '0000-00-00 00:00:00'),
(17, '°X[zX£|8|5°Xy[+}[^∞NVJ0iE0cU€C{{J€,C+cY£:Xw@XXJ.~sQ6,5£ZlV49(•lA;`l%V5N>c.6p,wXAc<zsYMq(>ZJ€(Sf(f,[4+Bcq', 'YWN0aXZhdGUtWT9ewq5gYsKwJnxVKDtbKG9ZfGRAQEh2wrFCPXfDt1tpJnY4fOKEomxEwqFvMnFQYEDigqx7UDlsUGnCpUB7P0MiQEdPIjDiiJpeZGdAW2dOW1TCruKInjBUwqV24oieal1Rw5fCrmp74oKsKT9QKcKjZuKEouKInmFge2BQWWRDwqFs', '0000-00-00 00:00:00'),
(18, '©f@z-n}TA@×r4Zh×y×TAX~€hb-A}r@Myhzy4z%T∞4Yv;Ib#×IfAI}dj-g@J+FSjd%B©vE}0i•j}£f+Z>hW?h@X[By>%miydEu-×X?%jh', 'YWN0aXZhdGUtfW09PV3Crk4jTlVgcGAycFfihKI5dFvihKJN4oSiMm8rScOXYFs2ZTBRZFrCrkk2WcK2dCzCpXJ0wqXCoW01T3zCvz1XeFZWZ8KuIUbCsW8qV3Nhw5drIcKhKsKlZ1VqKipVNFtVTVc8SSLCtsKxwrFYYFpZe3A8PTBVV0Re', '0000-00-00 00:00:00'),
(19, ',&b#®w=|Z6+EZ{T(|®s¿|1!o?6TfLl+T{>2®]÷,f&h]oF,>m%$1<Qm÷1∞qO:EE7OmF√0j®%aL¡]e2<®(H0=CFz)¥ZZ!¢|÷W!,∞h|CZ®Z', 'YWN0aXZhdGUtPMK2TXXiiJpvejwqU8KnwrF1VCNXSiNofGQ0SkHCsSJPYWh8wqXigqxKRmh64oie4oiaIsKxwqU5TzPihKI94oieM3rihKJNenF1Zlk9a0Z3M0CsXzCtnXiiJ5OcDZBbGpha8K2R1NvPOKInlJba0ZYbGBKV1rCsWAzYCU9I04zMSNTKw==', '0000-00-00 00:00:00'),
(20, '2√fOU0`P∞^+¿#×©√P.HHJ√¿,±lRJ#°-w¿hP)¿anP®©W`×iR-f,i.w6I02¿z÷JI©¡©J.¡-n-Rw¡n×fO#√,H#PJ-tzJ^tR.,PBfH]j6y™2', 'YWN0aXZhdGUtdD88LTfCoW5OfcKwfMKwI3wtfHBrZVNy4oCib2wyT0w3dW1PbzQ0dFpabW024oiawqV1ZMKWkl8cnnCtjdFPKAosKpJHJPwr9adTdlN2FybnQ2aCx0PlfCoWRodGDCtmVJwr8tQz8ke1Z8Q2jigKJJO2DCqSPiiJpgwqF9YA==', '0000-00-00 00:00:00'),
(21, '-_¥-7Lg=;q88N∞=?v∞jd)c~±d@7YJ¶@<P~=C∞¿@P€<Jk[÷3<B™@EZl©rr¿h=jtO~gdL])-r3;EC¶™Ti<z•Nc¥,x\"×O×-OO_h;{OOr@7U', 'YWN0aXZhdGUtwrHCsMKl4oCiNUhuJnJPUUAj4oieeCNcmwZ3HCsUxzNHsmwqfCoVDCo25MSNuw5fiiJ53LW1II8Kh4oCiZKInilNRsKlP09Mw7dPai1swrBuQjAowrF5ScKjVMK2NDU0VCF5OFVwqnCqcKwwqk2wrFJIk9PwqFzTFFKXijCo3l5O3nCpSY=', '0000-00-00 00:00:00'),
(22, '¿•n™}]}_Xt;(s}f>(PnsX@g&Wja;]o@aKD;×Ij#ZXY¶fS™(®AgRD2@LXh;IY15°_&YD°Xo,a5&_%Y&Le1}s&;°AY2{(qYTT&AYa;_qYf', 'YWN0aXZhdGUtYiwr4oKsS09rw5d7c3rCo08lQcKlQ3sl4oieOKCrMKjWCxmdsKhYcKjRUtuQUw7LHvCo8KnTFAjwrZYOKCrFBDTmdwUGIrLCI6wqF6b8Kha1HCo25XLiNwbKInloqOzvCpyVRwqFpwqVP4oKsRjrCpSNDJcK2entTKsKj4oKsPcKlwqPDtz1mNw==', '0000-00-00 00:00:00'),
(23, '.§l<7rIQ;¥Hx*EWLls?™8b®£t7;0|™®£j%<>÷÷°=×*IH#WW#®$®EGWY®_^|_÷T0.÷€._d#TL>¥Qda£QT&&|%7$_iI7_9W|>R^OW>*_L_', 'YWN0aXZhdGUtwrDDt3jCp0swJTQlUFRWIWchSy1EPVAzS3A8I0tZw7fCqSY8SyjCsXhg4oSiIWdtw7fCsS5MT8KxYy7CqTriiJ5tbDRiwqIjTywuIm9vWTxvUXLCp1DCvyhUTjwkJXhy4oiadGwiTzpLTjpOME8ieELCojbiiJ4oTiste09t', '0000-00-00 00:00:00'),
(24, '<Lz]qoTLV°ll¢°w™§o<w§!4{S™L47÷:dS°W7iW.∞∞SW7°4QP]3l,°4ipl7sYaecBD^lSVT!°;Ypdl]BYKq!f√<SiAf]V¢BY√Bo3sVl√|', 'YWN0aXZhdGUtOmjCpVJtWW5CLUF2wq5zLGpXwqXihKI9MSstOjptXSJtQcKpfCY9Om5uP3hu4oCi4oSiM1ZowqNYU8KlwqksV8Kx4oCiaOKEolMiPMKubiI7KllyOkJ2Ikt2KVE5WUE6b1NbIlHCrj1JMKEolt2WTo9bS4pVllRWy0iwq5YKg==', '0000-00-00 00:00:00'),
(25, 'bAi-m£°XX^%)ZR^®I{%BI-°°ALEpi¿U~CV]Y2h)piVuL7cZnH^)[xxR][a€^£E£%k3qC2∞8|a°^n£gR^M|]§wb{Riq\"R-A^mPUAC•Ypw', 'YWN0aXZhdGUtdEfCv29YaEJvOeKCrH5RwqdUQsOXUWgaFlCYKImndwRyI1bOKIniV3wrZDR3xwwqc3TWxNOTlNbMKn4oKs4oiacOKCrOKImsK4oiawqN7fsKjwrFafX5ufjZZaTvCv1g5dMKuSS5wdMKfXdewqdCY0LCsGdUPOKImkl9cEfCvzniiJ5pOV53cH0=', '0000-00-00 00:00:00'),
(26, 'a-a{h:Ga\"B|=v¿j|3J|}RA=IO..GbG§zL8sCGCJfK6RC6}\"p$fsaO¢¥y¢:)]x¢a¿HO}~v¢1a\"v..!§√=)A=¢ci6a!¶:RgI~¿OJj6]z3X', 'YWN0aXZhdGUtbnEmZVIqwrYqJm46WFh4ajnCoTRYwqIjacKlbmwsOCZIXkFxQVZ3QTlueENfJMKlaTrCoyphLWlhRWMsblhuwrY4bMK2SWxFO3B7XkXDtKCrFbCp1lqw7fCsFFScV0sblCpT7iiJom4oSiK10tO8KiX0URMK2OmUsLMKl', '0000-00-00 00:00:00'),
(27, 'a^yT5d¢;¢ye2§§bDJh>g+B|JtD.G§8QE√§Hyt°p|c8Q§p×yfRV*1I.\"Q8$s^+%BSfs°y`$±J}gEy!u=®8DAHEIJJ6S\"ce√C|Ac8fe\"e√', 'YWN0aXZhdGUtIyR3aWwzK1c7wqJ5PlczNzNWSGQrw7ctQmNza8KjYKImsKja11Icl1XLE87PkhzQyQ4oiaZcKiTUgkPzste8KpSFNzXSN4Sjx0wqlRZXgwPlbDl8KT0ocjJLK8KjeD5XODUxwqNXwqNkPMKlwqMzMHbCpTtdam9p', '0000-00-00 00:00:00'),
(28, 'YALu£%¶Lu£]F-Bo?!o8B-]<y¡XHlO*_`O¶8|#u°1MQ!]A_F_A-|=b&y©∞c&#o>|yQOu¿QHz#!×Bhay&{x*{668q™¢.u&6O<qyQ-Rqxu#', 'YWN0aXZhdGUtwq44dMKiwq4uwrFjZXg2YyV2InriiJ5JOMOXYjYsTizCqSxnSXp8JVkOFRRfVU0eMOXJcKhfGRIwq7CrsKp4oSiNk1AIcOXfWksPlNZ4oie4oCiendoZ8KpYWdILnzCriYmNkkpY30iY3RKfVR0MjZBQCxKNDLiiJp2cWTiiJpVdA==', '0000-00-00 00:00:00'),
(29, ':D¥-D2^\"€?±×!±py±÷H¿^qqw\"]}\"§R18:}PjHrwDwTe:§i¥rS;w÷^Sw4mUOjp£DLm4::d\"q8P4=]i§9:D¢™kP9°-SHPR×r÷]^D÷%[±U]', 'YWN0aXZhdGUtVzjDl0U8MDl7UVnCscKnamx94oSicMKla8OXYnh9U1vCsTp1MF1raDRoX35bISJoX33ihKLCpXVKwqV9bzga2widW1yw5dPNHZ9dk84MGxfasKnOTk44oSiXUXCscKjJuKCrFIiSzpyW8KnfXJZOsKnX8KnX35aXzB1WsKlwrBb', '0000-00-00 00:00:00'),
(30, '7.÷K|@4°vS=6u@@v.GsAp4)7VW±±∞÷FK4pWp)°%©tVV<=R|&£6Xr√u|wV{yS√UJ{M6tsFJ5t4t<O%4V°%suep±w>!;wA7w4p)ue@&<K%', 'YWN0aXZhdGUtOV9hOnpCw5fihKJyVEkNTFETiJzMcK2KMKlcmJQYTF6MSE7LV45U0XCsDHDtzFiMSXCqWxLPmLCvztIRTjDtztCQF9nckXCqXJTeHNgSS58SU1JYnh4XWskRU49UEAxPn1ycCh8JWlLXmwlOMOXbGl8ZSI=', '0000-00-00 00:00:00'),
(31, '§td##zkt4#Mk%d\"![,Y§cZr^¶g6%dV:2;N~^!(DM©tV^MSVv4JSk[±t8z\"¶vUdg;k\"§tkR7f%[^))[}z©oeD%^):$^R^@(^S§L€§K\"-o', 'YWN0aXZhdGUtdiZhNEbCtmFRTCHCqcO3eHF8V2cwwqUhTMK2VD80dngjJmdMZSNDXWcqIVNwqM0Sl1HOldHMkd1USFKdihlR3hiU0cwZyR1MGPCoKInn54NC1yPVpATy3CsVF4wqVHKm0pwqJWVjrCtmVUNMKifG1DXXVXQA==', '0000-00-00 00:00:00'),
(32, '¢<z√¢~°¶∞•YBI=B@lzmTws?N7Sv×yw!Ka^÷r°3v?V^Q!™°S4N|79fI?€%©.=Zr÷©IT!b3fm<e.%Y[*=°r4r©+?|fM√°wfB=Kvb#¢eYy÷', 'YWN0aXZhdGUtK8KuOEZSZk82fl5WPnfCoT4mTXQ6cX4rRXNlZkRKel7CoXZfJjlSfk9KNsKjdsKjbz5WSMKjd0pzROKImkZgdXpGWzFGwrF6wqFxRnbCoSZGPnXiiJ7CoKImkFvRcKhZXMhccO3UHFXPTlSRHEzOVsOjFSwrBXeltz', '0000-00-00 00:00:00'),
(33, 'SS¡U™9k[r∞#6kUm#UamVSQm×V1#V1,÷pSaikCiK|#%m[zq¥¶G.m;[vU8{mS\"14r&;ZUm÷SV∞M™pVVA&%:m1Aati,aqUASa®11pp<m÷^O', 'YWN0aXZhdGUtw5cjNzNDLUrihKJbwqEtcyTCpVZ5dnEiRmFL4oiaJGVOJFtXwrDCscKnTltGLHpuwrF4bEMk4oCiSVc0IKEoitWYSRafis6KSN2YSNsZUrCoeKImiJFZ1Z5KcKuLSLCqWgtesKwdWl2wqU3VKEolohwq43diMswrFqSWdSIksmYQ==', '0000-00-00 00:00:00'),
(34, 'p¥Qi;v!+NBU55©O¥xs[-w[¶÷PNw`DhY}~C!$pY`PQqb+x×T`\"¢tiB`H\"Tbx{$`QN85?O[`;;u!N+•?7t$¥`N\"Y√qq,r7[UQQ¥py|s®¢|', 'YWN0aXZhdGUtZ3R0wq4OGxIeXRscyk8elrigKImJnbCsXNIJj4p4oieKHriiJ52wqlIKHhFwqNFVFTCqVsrOVMiQClIPMKjN8K2esKxKShYwrHCtkxQdDh8wrbCoT92wq50UnoWjd4wrE8Y05CwqJaN2xPdCUodnNTbUIwwqk8OE8eilQ', '0000-00-00 00:00:00'),
(35, 'H]ZN%H√_×S%W\"pRjgZ<H\"by(bZZ¿L%}W(04¥U_j]oU\"#¡4∞\"ba√A,ch%6¿_:U:¥ig9a}H¡™F√L\"pZbDa,yub:(:]8aZDD¿®[Z,\"Ym]™K', 'YWN0aXZhdGUtTnFOaXEqKmEoJSNaKTPiiJ514oSiWCgqaDJRwqFow5dCaKEonZCOmcmwrZpWGZAKCVWKl1FJio1MMKpaXpp4oieJcK2MjtobCE74oSiQmZTaUcjUCYoPm91IUkwcTR6WMKnUcOXM2thMFZX4oSiMDpSYeKImuKEoiE4ZcKlaeKIng==', '0000-00-00 00:00:00'),
(36, 'F\")4D¡C(mNJ(N(el4z9:H,a=R$N\"RbV4:F9e;×¢:beu∞HC€,j<)t;×(Htez47k§F¢¢OO9az•kjO_HC7&CH×VVj<¥nHm£<4#tFI`;F§R.', 'YWN0aXZhdGUtNTYuKeKImljCrj9qKkVGW3DCsTJIZ0ZAYOKAolNpNj5mwq5eUy50NW9sPiYPXRGPnJkVT9QQCERlhEwqVpQHVTNUxMMn5yOjQ8SVgZ1tdRlNwZMKuby7CtkApwrEqauKCrH4pPk41U0cqITJgwrE4w5dvfkY=', '0000-00-00 00:00:00'),
(37, 'w3C^÷®pWr:^r∞^?K{x=g`3^§^`XTS§£dh^QoU^p¶:±h`r;S?®j§>rBmB?C@@÷U¢`2÷CtVP÷^X£m.l±6..gvhA£±™B?®3^Vf6VWCM>h@=', 'YWN0aXZhdGUtLShaUG4TsKufWhLwrY3eWklbXZQZkdQwr85a00uKWjCrlbigKJlNSsrwr8oUFbDl1pCLXNLwrZyM8KuYcKuZW55KE5CXXd7wqktZkCriMowq5iKVUbkVmwqNjK2NpRygt4oCiVVpraMK2KXPihKJrUFBCWlt9Wk7Cp8OX', '0000-00-00 00:00:00'),
(38, 'F0¥H2§√e|5=k}WL:}rFZ5pe{s©¢k£×£yQw©©$!]Yw{§YvNXw¿=¥1NY[0^}L¢\"ElF-£p8dW3|HsY©8W×l{F¶SF©Xq=w£}LGpwfQq;N$s¥', 'YWN0aXZhdGUtcihP4oiaQ3Z2UzxiU0NI4oKsZlNTajVIRVJmKG1iNlJkZntuRDYiasKwwq5xbGZOdjFKcyVzSDE1WyLCtnYMVNsYCpk4oKsX2xwasKjcFNWRi5gZ05y4oCiTzxzdnZgwqnCtmJKX0bCo0V2TkVm4oKsJl8RkUxfQ==', '0000-00-00 00:00:00'),
(39, 'Hy_|Pz;¿tT@cR¿i#c™l9|H2c|q;c@;Hfa6Ox√iG7©nY∞°fq@yjNKq@lR{;NTt{|y™7;×@Pc¿YT©{™0;§Yi#2~|!§0a•§yF™,O¥n@[yx°', 'YWN0aXZhdGUtwqlKW8KndW48SFCtkZMbjrCtl5MQmU1ekh0djV3Tjp4JMK2SypfQFtmdmXCrmdmKjhxwqJLKkpuKC0lbkgyYsK24oiebkpMTDxMZSjCp3gLTlvQ3h3w5d0wqIyZS1l4oiewq5DIXllNcK2wqIifnk6bk0tLVLCrnFM', '0000-00-00 00:00:00'),
(40, '-rF5?+zG1√WQY{%G2:R[[R√p,v!.NdO.aV®¢YV®WN°>°e!r-°pp6N[pGO?zp√F?Hb¢O),pe?q`Hzh°)Lq+!q.°[GbJVDq-7QE¢@N√v~Q', 'YWN0aXZhdGUtWC5yYWti4oieQKImlBgcy5UdV9AUDEP3U4oiaWl9JOuKImnJhLnNaOeKInnNrwqlhaVU4M3V4oKsVTHiiJooJGlxUMKuc3BaNT8mLlDDl3hfcEnDtKCrH1pe3NlNzpYX31pQ1o7WC4mwqlBa19bQcOXLsOXRGF0W3tacA==', '0000-00-00 00:00:00'),
(41, '<§S(]&±szv#?S0S<yPyC0¶\"N\";oB(i©q6+pM©Cz=]=!¶]¶6<vCr(v\"#T¶Wv6$SB©\"vM#q±#$2sd&0s=TC€∞!SX¶pK=2&3gra-YfaSWr(', 'YWN0aXZhdGUtRGVYdTpocMKiwql9b0Bewq5hRE4jPTnCrkrCsSjigKLigqxtaH5UZcKwwrHigKIoS3JZwrA4cU05MjHiiJ4l4oCieEpeLFtZDPihKLCscKueDh3wqLCsWEhKyFyLFZUY1ZYYVQzIKIniNtQjVtOMKwRCpOwrDigKLCtuKAojtYwqdXa211wqJaSw==', '0000-00-00 00:00:00'),
(42, '>Z&j<ij±¥hb±:=rG¥h4÷<$¡¥¡2RWTu-h©NfZ÷•§§Z&Tbh©^•¥2050•MM66iU%>c~)w*•M;••¡&¥p<KM¶¥K§6Cwd-wy]$Zm0$Nw)j÷ZPb', 'YWN0aXZhdGUtNEhA4oSiX8K2bldNwrZFWCPigqxWLH5rNTJNaeKEomNuVlFXWUVZVMKwRTVZP0UyRipvI3tuKDRjNT4q4oSi4oCibT9rQz9zSCPCsUV6Y1kLGDt0BzTSg2USxeUnsiwrZ4T0MPuKCrEVvRUhoaSpfTktOUVdZYzI=', '0000-00-00 00:00:00'),
(43, '?cc;jdU¡c*oxrcUJ90h¡=^o¡@£r2T±N9HeT4;D?[L:±;qf&¥(uC>=√R_pr°rqD0u£WoAK&Ab¶*ucD@0bH±UK@L?®K*DR&hhD:×£___=©', 'YWN0aXZhdGUteFtAPVREUEY2QCUlXUziiJo4eCNDXk5sJUbiiJp8emfihKJpUEY2RVVnRkXDl0ZATiV4wqc5w5dnRHh6JMKhQF5z4oiaw7dGTjBbwrbCoV44oCiTeKEojlwwqdKZ8OXUHhmPX5lwqLDtzRsekDCojVCw5dteCRbbyxeVCVbOl7Dlw==', '0000-00-00 00:00:00'),
(44, 'YGCT{_{U?Ar_8¥P0{qF®×U1&rWvBhD%t;PF÷y£®×E~79kGNr1roA7G¡g¡MmRBTW?koAX{8-£Pg\"£m°&G~¶G×£√P.G;]®_+wtg?Tn\"√gt', 'YWN0aXZhdGUtfENQfCR9YzVM4oiacW9vaG8o4oieUDc0VVUYyXCsW9r4oCiwqdvImhYR8KiQHkkReKAoktqQCTCrjrDl8KpNz5Lc0h3fWZxOl5YaGNsRkdzJGiiJo3Qiw6NXN5wql9OU1WaGoiaGviiJphTDrCqXdVYijCpWriiJpLbVDlyw=', '0000-00-00 00:00:00'),
(45, 'E5+{¶(G÷k©:r¢™¶,*¢,g,JWY[™H,k£$;r$08∞qEJ∞Z*{$Fe$GucV[;√Y¿ZkHcekpVF053t3∞7[D5[3[qk0(_:$∞J-,qyNt$∞∞Mqk÷_,[', 'YWN0aXZhdGUtVnlPwrBWT29WWSsrPXxsP0VLbWlIP1lQVCFfw5figKJQMiFZduKEomxuP05oWWJm4oSidiEidk1fbjRmKHRhXnw0wqlebOKAouKInnbCqTNvK03DlyJUMCJQMFnihKJiKzxoXm8hwqFFTTBLeHnigqw9ZDN1RzDCqWorQzA=', '0000-00-00 00:00:00'),
(46, '°[ii|4b>?[|>=O5am]d-R?[sN1?s[4¡y*sb4©7(¡rR?;r[1p™n±5nh4™y{FZdN;|:>[√lL™[=©¢;[T|=¥¡1O√!TsF6(o¶Si?|NGAT;oM', 'YWN0aXZhdGUtwq5JeylLW2UoM1jiiJpJwqNgwqkzX1tabHA7e1NhbEihKJXSWp7KHjCsXwqT25bVKAoiNbUVN6KUJVGNkwqNFQ0Nfe1BqY2s2V1BDY1B7MEtRMCFuasKjUyUoY2TCo0twW1dqwrYqbigwJsKxSWpJwqkz4oSiQm0=', '0000-00-00 00:00:00'),
(47, '¡n.a5¶F∞_X:s®(}V(÷>¿awnRRQU}§F;JJ\"d$#™~Ud}2n>+~SAOF:$§F∞¿.VE¡®¥}V>AJE}®~S?3~1;∞4sX¡tJR∞J\"®×Z~T}k3lx}kzw_', 'YWN0aXZhdGUtd01dJC18dX51O3VUEUuRcKuRXooQkokK0l1dSTDt8KlKyhwd8KhWTM3wqF9UkozPmxXJCHCqUXCp01QTXA3JE3CtndlwrbCsGg7fHZOTn1pK1IyOTtsdUpnLlhNWStGwrYyVXBMfmxFfDt3bEbDt003RWg=', '0000-00-00 00:00:00'),
(48, 'NdnmVLFT°|©™w\"O;~yn™?ColV¶N(?;6™©\"+{°°|¥}L°|mkNw=EnF9VVpL|CaTJ=sV§<©\"TVNqh©?Ld$pNN~©|TS+©{{±±™{V(9oNqo£h', 'YWN0aXZhdGUtcuKCrMKjw7fCtkfiiJ5QTn7iiJpgayg4LXlswqNMSDgtLXxwrbCoeKInlV84oieRlVswqM7cHxKTsOX4oiewrE1TuKImsO3PDhOwrBg4oCieXXigKJlVkrCpzVVUMKiNEIuJcKjUFXCpcKj4oieeTRWTzhfwrF4oKswrZWwrBzeW5Mwqd2dko4aC5ldj5OdiU=', '0000-00-00 00:00:00'),
(49, '¡dO5H<•C(S£©WRRGGsv@^62ftc±¡?Vw>b=;P¿¥q5d;y`O)+f7AC<•GWE:L±¢(p?¢SH®\"sQ¢f¿™C¥6∞CqP:~P2)GO~dO:`H©4f√w¿~<Ef', 'YWN0aXZhdGUtwrE5a24kankoVcKxJG8hKkl9MlEuROKInipVLl9VfX3Co8K24oiePm55MDdtLmtUdmpbWyJINCQP31Dw5ciwqNvJEMwOcKjITR9YmFVwr8kbjx4wr83IWtUKmMwQkl9aWxpbElWVVU04oSiIVRHPyohQGlfbFs=', '0000-00-00 00:00:00'),
(50, '$b%qV)bSA+vt5§`R¢¿zdzW!r±<OlLd`SsO{\"dtLT-[•WAX@X(s)N,J¥xO)C`t@€€€•$C{$[%8OJ•8|[J>[S€±`YS©dXA4T√?dtS€~gk¢', 'YWN0aXZhdGUtwqF6MsOXNMKx4oSiwqnCqWckdC5iJDRoUWHigqxaaX1BNU4lesKpM2dYJloyUGRWNOKCrMKnIkjDl8OXej4kemRoWmNJwqVXwrFIYcKwVGlYakphV2IzZEhISGF9Ql8MSvCqVrCp8KlM2kwVHdpwqlAUWFCIjDCsEjiiJoyw5dAcA==', '0000-00-00 00:00:00'),
(51, 'EF}d;o×€FZS3∞;€$€V$3EG°$∞V°,Z€;1{z7°Qdfp€O@¢∞;$!1ZHx®C>sA:Xj|iU∞;x3r#€dj<>j1jy.™;XQE|1f<8yGE@VNf[XVUdHdd', 'YWN0aXZhdGUtQm5WVlXCozludzHCo01mJUtXIXhub0hQNiNRwrAiJnY8S8KxW2FvSzJawr9GScKwWiZZNiw4RSNCdUNhwrDCtkBDSFHigqx2wqfCv0MmIkBwJipbQDFCOypGwrExI27ihKLCoypuKTZGRiM7JjZgO0jigqxIUSkiQlc=', '0000-00-00 00:00:00'),
(52, '\"\"zu}p,6?A]F#WW¶##snF3JJ3#EJ•8®Jm}Q9×FW#n{rJ3oP{(A?¶pp&JAW$¡>{ElsE¿fxpA}{3&°>2[SFdFFs`f%j®E#JstIEJEpEz}s', 'YWN0aXZhdGUtNuKInjvCp8KnVsKV1RCRVRdISVEcypU4oiea0VEaiVCNnE6UCpSwqV6dMKnSlI5QuKInkXiiJomUMKnwr8kREAqezfCo2pFUHRdRUPiiJrCv0QhwqdqU1t4oieJDd0a3Q3RGM9W2JawrZXUFlDazddLWJFfiEoJl1WdDI7Mg==', '0000-00-00 00:00:00'),
(56, '•j#-e+BMvq¡√jSQe√12p&62±¢zD`LJ]Fx)O•):jp\">+¢#:8SS£SZ¢AgJQ]&√F88S•[X)&•Vx)DE8°e8qFp1:e•SpikjF+(√pK™M™j+d®', 'YWN0aXZhdGUtSUnCsD5Wa0s5UcKwb3nigKI5RDxvPjCp2NOJMKnVFtLMUDiiJ53OEbCol3CsHRdQll9LnvCsFPCqXVrKz7Co0XCpXJQMsKpwrBjwqV1XcKlRcKiRDl1VMKiPMKpKyZ5PsKpMTwRTIuMDxsTmXCqSRnwq4iMmbCpURQw7fCsCJmRU4=', '2026-03-01 11:09:33'),
(58, 'P?[!YF@?$a™Tf§J!@U±ls@h$@a03}j?!√}÷:|±F!%p@!ff|J∞joFh™w§+?°T~t!°=:HTW°q?,√psw™*j√t?$|y∞2Ff@°QT|$3c?∞7L§F', 'YWN0aXZhdGUtesKnw5cS8KpMG1LLiJPNsKiwrbihKLCsXrCqUbiiJ46wqlxQW5xbzbDt3hTwqdTWUXCv13igqxSWSxNRWLCsWB7cnlsOm11Ik1yKG1sJijCqSEsWVrCsOKAokd7e2CtnlsRT9nSXJPYMKwdCPCqXFzInNxN8OXMjtwelNEwqkkwqkk', '2026-03-31 18:36:00'),
(59, ',ei_NBsg<÷p3°)÷\"%AD~OluGs[Q°3k[£,\"BVD,,r,L°•Ru~RL,v§qe8>J*∞swwK°zJsKPlf\"Ui°Kf°BA)(5lws,,_YIA>t[J¡i=fH√~P', 'YWN0aXZhdGUtQV0xwqV0fmIrJmQjwqnDt8OXeGcuUHrCpTViK3QsNcO3SCtkJMKiw7crNSJ0R0xTIzwtays1QHhTbcK2amokO8KiQCt0wql0O2Y2NUBrw5cu4oSiO3U9OMK2wqMjR8OXwqlTV0pY08jWsKibEBHNWQ1wqLCpSRKYsKjai7igqw=', '2026-03-31 18:37:22'),
(60, 'j0∞[√axXE))-A07t¿®©vDca©t®U¢(4¢]UmZt.j√j,\"Ae7√j)]W¿÷4EE-WcPG\"axTc∞^A4l√√j`Dj2){0AQGX√a]®∞rpt}Gv®±©¢3e.a]', 'YWN0aXZhdGUtSj89fjtbPmRTSjhkU3hvIV4oLCJwU3Mb0lqR2figKJkKD40w5dKwqFewr9W4oiewq7Dl8KleMKlLjBDNFosUi4sbzCrjg7P3hCd3AuK2dJLkpKwq5alMywq49IcKwKFBwKHDCrnNoSsKwq42wqFCK0spKCjCpWxaTg==', '2026-03-31 18:38:15'),
(61, '9h∞BkUAk\"Zy\"?p_=9P¢jP§Ewc@*:∞m7\"tw∞c®m*°¥§*p7@÷cUy(_h@1*Bt@K#4H÷FF•+A™t¢h0B7d™y:°E÷∞mT¥(*p€6A-m±o√N6d1BA', 'YWN0aXZhdGUtR0fDt3hUKV1VfmdWwqFAwqFGfVPihKLComFoWEBfwqlWR0pnc8KOVhQVnYpZcKjZkRdwqJzQCJ2TkRTVFB2a3lpwqJQw7coeCFKJnIyfUVlXmtoR8O3YinigKJfWMKwOGsoXzHColp8QkdywqJLiljclZlwqMyQVNy', '2026-03-31 18:41:13');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autok`
--

CREATE TABLE `autok` (
  `auto_id` int(11) NOT NULL,
  `marka` varchar(128) NOT NULL,
  `modell` varchar(128) NOT NULL,
  `evjarat` int(4) NOT NULL,
  `szallithato_szemelyek` int(11) NOT NULL,
  `uzemanyag` varchar(64) NOT NULL,
  `teljesitmeny` int(11) NOT NULL,
  `sebessegvalto_tipusa` varchar(64) NOT NULL,
  `hengerurtartalom` int(11) NOT NULL,
  `vegyes_fogyasztastol` decimal(3,1) NOT NULL,
  `vegyes_fogyasztasig` decimal(3,1) NOT NULL,
  `alvazszam` varchar(128) NOT NULL,
  `rendszam` varchar(128) NOT NULL,
  `allapot` enum('Elérhető','Nem elérhető','','') NOT NULL DEFAULT 'Elérhető',
  `state` smallint(6) NOT NULL DEFAULT 0,
  `deleted` smallint(6) NOT NULL DEFAULT 0,
  `napi_dij` decimal(10,2) NOT NULL,
  `fokep` varchar(1025) NOT NULL,
  `kep_hatulrol` varchar(1025) NOT NULL,
  `kep_soforules` varchar(1025) NOT NULL,
  `kep_hatsoules` varchar(1025) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `autok`
--

INSERT INTO `autok` (`auto_id`, `marka`, `modell`, `evjarat`, `szallithato_szemelyek`, `uzemanyag`, `teljesitmeny`, `sebessegvalto_tipusa`, `hengerurtartalom`, `vegyes_fogyasztastol`, `vegyes_fogyasztasig`, `alvazszam`, `rendszam`, `allapot`, `state`, `deleted`, `napi_dij`, `fokep`, `kep_hatulrol`, `kep_soforules`, `kep_hatsoules`) VALUES
(23, 'Honda', 'Civic 1,8 i-VTEC', 2015, 5, 'Benzin', 142, 'Manuális', 1789, 6.0, 6.3, 'HND548B4357', 'NBB-691', 'Elérhető', 0, 0, 31490.00, '69ad4ed77b7ed.jpg', '69ad4ed77bb69.jpg', '69ad4ed77bcca.jpg', '69ad4ed77be54.jpg'),
(24, 'Ford', 'Mondeo Hybrid', 2016, 5, 'Benzin', 190, 'Automata', 1998, 6.1, 6.7, 'ASD34541434', 'NJN-964', 'Nem elérhető', 1, 0, 27990.00, '69ae82782d324.png', '69ae82782d7d6.png', '69ae82782d857.png', '69ae82782da95.png'),
(25, 'Kia', 'Ceed SW PHEV', 2021, 5, 'Benzin', 141, 'Automata', 1580, 5.3, 6.5, 'BCD1344636435', 'SYS-253', 'Elérhető', 0, 0, 33590.00, '69b5d9b2e6660.jpg', '69b5d9b2e685b.jpg', '69b5d9b2e69cd.jpg', '69b5d9b2e6bce.jpg'),
(27, 'BMW', '320d', 2004, 5, 'Dízel', 120, 'Manuális', 1995, 5.7, 5.9, 'BMW457549BD23', 'JNN-672', 'Nem elérhető', 1, 0, 24990.00, '69cbf5fdf11e8.jpg', '69cbf5fdf1384.jpg', '69cbf5fdf14f6.jpg', '69cbf5fdf1643.jpg'),
(28, 'Volkswagen', 'Passat', 2020, 5, 'Dízel', 150, 'Manuális', 1968, 4.0, 4.5, 'VWP53747S342', 'RRX-275', 'Elérhető', 0, 0, 33990.00, '69cbf6b19a0db.jpg', '69cbf6b19a25e.jpg', '69cbf6b19a3c8.jpg', '69cbf6b19a523.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `ertekeles_id` int(11) NOT NULL,
  `csillag` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `velemeny` varchar(200) NOT NULL,
  `letrehozva` date NOT NULL,
  `deleted` smallint(6) NOT NULL DEFAULT 0,
  `nev` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `ertekelesek`
--

INSERT INTO `ertekelesek` (`ertekeles_id`, `csillag`, `email`, `velemeny`, `letrehozva`, `deleted`, `nev`) VALUES
(1, 5, 'nemesd90@gmail.com', 'Ez egy szuper weboldal', '2026-03-06', 0, 'Nemes Dávid'),
(2, 4, 'zoltangevesi81@gmail.com', 'Legkomolyabb', '2026-03-06', 0, 'Hevesi Zoltán'),
(3, 3, 'elevetoth@gmail.com', 'teszt', '2026-03-06', 0, 'Tóth Levente'),
(11, 5, 'lentezalan@gmail.com', 'Elképesztő milyen jó ez 67', '2026-03-31', 0, 'Lente Zalán'),
(12, 2, 'admin@gmail.com', 'nagyon teccik', '2026-03-31', 0, 'admin123');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalas`
--

CREATE TABLE `foglalas` (
  `foglalas_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `nev` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telefonszam` varchar(12) NOT NULL,
  `jogositvanyszam` varchar(8) NOT NULL,
  `jarmu` varchar(120) NOT NULL,
  `kezdet` date NOT NULL DEFAULT current_timestamp(),
  `vege` date NOT NULL DEFAULT current_timestamp(),
  `letrehozva` datetime NOT NULL,
  `deleted` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `foglalas`
--

INSERT INTO `foglalas` (`foglalas_id`, `auto_id`, `nev`, `email`, `telefonszam`, `jogositvanyszam`, `jarmu`, `kezdet`, `vege`, `letrehozva`, `deleted`) VALUES
(117, 27, 'Nemes Dávid', 'nemesd90@gmail.com', '+36706760124', '34675444', 'BMW 320d 2004', '2026-05-07', '2026-06-29', '2026-04-01 21:22:31', 0),
(118, 24, 'Tóth Levente', 'elevetoth@gmail.com', '+36706760125', '54543333', 'Ford Mondeo Hybrid 2016', '2026-04-27', '2026-05-10', '2026-04-01 21:23:49', 0);

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
  `deleted` smallint(6) NOT NULL DEFAULT 0,
  `reminder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `name`, `loginname`, `email`, `regisztracioideje`, `password`, `fingerprint`, `state`, `admin`, `deleted`, `reminder`) VALUES
(59, 'admin123', 'admin123', 'hevesizolibs507@gmail.com', '2026-03-12 21:07:53', '0192023a7bbd73250516f069df18b500', ']G!%&¶rS|Um>~W.ggm5$¿r®mWXQinZ®n)yC~m×*]L])yJ)!¢Lvmgxg2>&P8S~tniTSGf]m¢LvWXAmnU\"?|GgL6|U+¢~|~]3¢CJ5]{rQ5', 1, 1, 0, 0),
(61, 'Nemes Dávid', 'ndavid', 'nemesd90@gmail.com', '2026-03-31 18:37:22', '3cacbed2ff3b5169a175616cf1a59821', ',ei_NBsg<÷p3°)÷\"%AD~OluGs[Q°3k[£,\"BVD,,r,L°•Ru~RL,v§qe8>J*∞swwK°zJsKPlf\"Ui°Kf°BA)(5lws,,_YIA>t[J¡i=fH√~P', 0, 0, 0, 0),
(62, 'Tóth Levente', 'elevente', 'elevetoth@gmail.com', '2026-03-31 18:38:15', 'a3dcb4d229de6fde0db5686dee47145d', 'j0∞[√axXE))-A07t¿®©vDca©t®U¢(4¢]UmZt.j√j,\"Ae7√j)]W¿÷4EE-WcPG\"axTc∞^A4l√√j`Dj2){0AQGX√a]®∞rpt}Gv®±©¢3e.a]', 0, 0, 0, 0);

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
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`ertekeles_id`);

--
-- A tábla indexei `foglalas`
--
ALTER TABLE `foglalas`
  ADD PRIMARY KEY (`foglalas_id`),
  ADD KEY `auto_id` (`auto_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT a táblához `autok`
--
ALTER TABLE `autok`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  MODIFY `ertekeles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `foglalas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
