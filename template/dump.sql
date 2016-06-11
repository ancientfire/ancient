--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: polish_ispell; Type: TEXT SEARCH DICTIONARY; Schema: public; Owner: postgres
--

CREATE TEXT SEARCH DICTIONARY polish_ispell (
    TEMPLATE = pg_catalog.ispell,
    dictfile = 'polish', afffile = 'polish', stopwords = 'polish' );


ALTER TEXT SEARCH DICTIONARY polish_ispell OWNER TO postgres;

--
-- Name: polish; Type: TEXT SEARCH CONFIGURATION; Schema: public; Owner: postgres
--

CREATE TEXT SEARCH CONFIGURATION polish (
    PARSER = pg_catalog."default" );

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR asciiword WITH polish_ispell, simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR word WITH polish_ispell, simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR numword WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR email WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR url WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR host WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR sfloat WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR version WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR hword_numpart WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR hword_part WITH polish_ispell, simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR hword_asciipart WITH polish_ispell, simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR numhword WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR asciihword WITH polish_ispell, simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR hword WITH polish_ispell, simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR url_path WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR file WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR "float" WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR "int" WITH simple;

ALTER TEXT SEARCH CONFIGURATION polish
    ADD MAPPING FOR uint WITH simple;


ALTER TEXT SEARCH CONFIGURATION polish OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: grafik; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE grafik (
    id_zmiany integer NOT NULL,
    id_pracownika integer NOT NULL,
    data date NOT NULL,
    "godzina_rozpoczęcia" time without time zone NOT NULL,
    "godzina_zakończenia" time without time zone NOT NULL,
    id_grafiku integer NOT NULL
);


ALTER TABLE grafik OWNER TO szwedek_aga;

--
-- Name: grafik_id_grafiku_seq; Type: SEQUENCE; Schema: public; Owner: szwedek_aga
--

CREATE SEQUENCE grafik_id_grafiku_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grafik_id_grafiku_seq OWNER TO szwedek_aga;

--
-- Name: grafik_id_grafiku_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: szwedek_aga
--

ALTER SEQUENCE grafik_id_grafiku_seq OWNED BY grafik.id_grafiku;


--
-- Name: hotel; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE hotel (
    nazwa_hotelu character varying,
    adres character varying,
    nr_tel character varying,
    email character varying,
    nr_konta character varying,
    strona_www text
);


ALTER TABLE hotel OWNER TO szwedek_aga;

--
-- Name: klient; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE klient (
    id_klienta integer NOT NULL,
    nazwa character varying(50),
    nazwisko character varying(50),
    imie character varying(20),
    adres character varying(50),
    pesel character varying(11),
    nip character varying(20),
    nr_telefonu character varying(20)
);


ALTER TABLE klient OWNER TO szwedek_aga;

--
-- Name: klient_id_klienta_seq; Type: SEQUENCE; Schema: public; Owner: szwedek_aga
--

CREATE SEQUENCE klient_id_klienta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE klient_id_klienta_seq OWNER TO szwedek_aga;

--
-- Name: klient_id_klienta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: szwedek_aga
--

ALTER SEQUENCE klient_id_klienta_seq OWNED BY klient.id_klienta;


--
-- Name: logowanie; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE logowanie (
    id_pracownika integer,
    id_klienta integer,
    email character varying(50) NOT NULL,
    haslo character varying(20) NOT NULL
);


ALTER TABLE logowanie OWNER TO szwedek_aga;

--
-- Name: meldunek; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE meldunek (
    imie character varying(20) NOT NULL,
    nazwisko character varying(50) NOT NULL,
    pesel character varying(11) NOT NULL,
    adres character varying(50) NOT NULL,
    id_rez_pok character varying NOT NULL
);


ALTER TABLE meldunek OWNER TO szwedek_aga;

--
-- Name: pokoj_id_pokoju_seq; Type: SEQUENCE; Schema: public; Owner: szwedek_aga
--

CREATE SEQUENCE pokoj_id_pokoju_seq
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pokoj_id_pokoju_seq OWNER TO szwedek_aga;

--
-- Name: pokoj; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE pokoj (
    id_pokoju integer DEFAULT nextval('pokoj_id_pokoju_seq'::regclass) NOT NULL,
    typ integer NOT NULL
);


ALTER TABLE pokoj OWNER TO szwedek_aga;

--
-- Name: pracownik; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE pracownik (
    id_pracownika integer NOT NULL,
    imie character varying(20) NOT NULL,
    nazwisko character varying(50) NOT NULL,
    adres character varying(50) NOT NULL,
    nr_tele character varying(20) NOT NULL,
    id_stanowiska integer NOT NULL
);


ALTER TABLE pracownik OWNER TO szwedek_aga;

--
-- Name: pracownik_id_pracownika_seq; Type: SEQUENCE; Schema: public; Owner: szwedek_aga
--

CREATE SEQUENCE pracownik_id_pracownika_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pracownik_id_pracownika_seq OWNER TO szwedek_aga;

--
-- Name: pracownik_id_pracownika_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: szwedek_aga
--

ALTER SEQUENCE pracownik_id_pracownika_seq OWNED BY pracownik.id_pracownika;


--
-- Name: rachunek; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE rachunek (
    id_rezerwacji integer NOT NULL,
    cena money NOT NULL,
    id_rodz_rach integer,
    id_rodz_plat integer
);


ALTER TABLE rachunek OWNER TO szwedek_aga;

--
-- Name: rezerwacja; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE rezerwacja (
    id_rez_pok character varying NOT NULL,
    data_rezerwacji date NOT NULL,
    suma_ogolem numeric,
    suma_pozostala numeric,
    data_przyjazdu date NOT NULL,
    data_wyjazdu date NOT NULL,
    id_klienta integer NOT NULL,
    id_rezerwacji integer NOT NULL
);


ALTER TABLE rezerwacja OWNER TO szwedek_aga;

--
-- Name: rezerwacja_id_rezerwacji_seq; Type: SEQUENCE; Schema: public; Owner: szwedek_aga
--

CREATE SEQUENCE rezerwacja_id_rezerwacji_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rezerwacja_id_rezerwacji_seq OWNER TO szwedek_aga;

--
-- Name: rezerwacja_id_rezerwacji_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: szwedek_aga
--

ALTER SEQUENCE rezerwacja_id_rezerwacji_seq OWNED BY rezerwacja.id_rezerwacji;


--
-- Name: rezerwacja_pokoju; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE rezerwacja_pokoju (
    id_pokoju integer NOT NULL,
    id_rez_pok character varying NOT NULL
);


ALTER TABLE rezerwacja_pokoju OWNER TO szwedek_aga;

--
-- Name: rezerwacja_pokoju_id_rez_pok_seq; Type: SEQUENCE; Schema: public; Owner: szwedek_aga
--

CREATE SEQUENCE rezerwacja_pokoju_id_rez_pok_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rezerwacja_pokoju_id_rez_pok_seq OWNER TO szwedek_aga;

--
-- Name: rezerwacja_pokoju_id_rez_pok_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: szwedek_aga
--

ALTER SEQUENCE rezerwacja_pokoju_id_rez_pok_seq OWNED BY rezerwacja_pokoju.id_rez_pok;


--
-- Name: rodzaj_platnosci; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE rodzaj_platnosci (
    id_rodz_plat integer NOT NULL,
    nazwa_rodz_plat character varying(20) NOT NULL
);


ALTER TABLE rodzaj_platnosci OWNER TO szwedek_aga;

--
-- Name: rodzaj_rachunku; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE rodzaj_rachunku (
    id_rodz_rach integer NOT NULL,
    nazwa_rodz_rach character varying(20) NOT NULL
);


ALTER TABLE rodzaj_rachunku OWNER TO szwedek_aga;

--
-- Name: stanowisko; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE stanowisko (
    id_stanowiska integer NOT NULL,
    nazwa_stanowiska character varying(20) NOT NULL
);


ALTER TABLE stanowisko OWNER TO szwedek_aga;

--
-- Name: typ_pokoju; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE typ_pokoju (
    typ integer NOT NULL,
    cena numeric NOT NULL
);


ALTER TABLE typ_pokoju OWNER TO szwedek_aga;

--
-- Name: typ_uslugi; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE typ_uslugi (
    id_uslugi integer NOT NULL,
    nazwa_uslugi character varying(50) NOT NULL,
    cena_uslugi numeric NOT NULL
);


ALTER TABLE typ_uslugi OWNER TO szwedek_aga;

--
-- Name: typ_zlec_prac; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE typ_zlec_prac (
    id_pracy integer NOT NULL,
    nazwa character varying(50) NOT NULL
);


ALTER TABLE typ_zlec_prac OWNER TO szwedek_aga;

--
-- Name: typ_znizki; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE typ_znizki (
    id_typu_znizki integer NOT NULL,
    nazwa_znizki character varying(30) NOT NULL,
    procent integer NOT NULL
);


ALTER TABLE typ_znizki OWNER TO szwedek_aga;

--
-- Name: usluga; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE usluga (
    id_uslugi integer NOT NULL,
    id_rez_pok character varying NOT NULL
);


ALTER TABLE usluga OWNER TO szwedek_aga;

--
-- Name: zatrudnienie; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE zatrudnienie (
    id_pracownika integer NOT NULL,
    data_zatrudnienia date DEFAULT ('now'::text)::date NOT NULL,
    data_zwolnienia date
);


ALTER TABLE zatrudnienie OWNER TO szwedek_aga;

--
-- Name: zlecona_praca; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE zlecona_praca (
    id_pokoju integer NOT NULL,
    id_pracy integer NOT NULL,
    data_zlecenia date NOT NULL,
    data_zakonczenia date,
    id_pracownika integer NOT NULL
);


ALTER TABLE zlecona_praca OWNER TO szwedek_aga;

--
-- Name: zmiana; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE zmiana (
    id_zmiany integer NOT NULL,
    nazwa_zmiany character varying(50),
    stawka integer NOT NULL,
    godziny integer
);


ALTER TABLE zmiana OWNER TO szwedek_aga;

--
-- Name: znizka; Type: TABLE; Schema: public; Owner: szwedek_aga; Tablespace: 
--

CREATE TABLE znizka (
    id_rezerwacji integer NOT NULL,
    id_typu_znizki integer NOT NULL
);


ALTER TABLE znizka OWNER TO szwedek_aga;

--
-- Name: id_grafiku; Type: DEFAULT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY grafik ALTER COLUMN id_grafiku SET DEFAULT nextval('grafik_id_grafiku_seq'::regclass);


--
-- Name: id_klienta; Type: DEFAULT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY klient ALTER COLUMN id_klienta SET DEFAULT nextval('klient_id_klienta_seq'::regclass);


--
-- Name: id_pracownika; Type: DEFAULT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY pracownik ALTER COLUMN id_pracownika SET DEFAULT nextval('pracownik_id_pracownika_seq'::regclass);


--
-- Name: id_rezerwacji; Type: DEFAULT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rezerwacja ALTER COLUMN id_rezerwacji SET DEFAULT nextval('rezerwacja_id_rezerwacji_seq'::regclass);


--
-- Name: id_rez_pok; Type: DEFAULT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rezerwacja_pokoju ALTER COLUMN id_rez_pok SET DEFAULT nextval('rezerwacja_pokoju_id_rez_pok_seq'::regclass);


--
-- Data for Name: grafik; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY grafik (id_zmiany, id_pracownika, data, "godzina_rozpoczęcia", "godzina_zakończenia", id_grafiku) FROM stdin;
2	10	2016-06-10	15:00:00	23:00:00	7
2	4	2016-06-12	15:00:00	23:00:00	8
5	4	2016-06-08	18:00:00	06:00:00	9
7	4	2016-06-15	10:00:00	21:00:00	10
1	12	2016-06-07	06:00:00	06:00:00	11
1	4	2016-06-29	07:00:00	15:00:00	13
1	4	2016-06-22	06:00:00	15:00:00	16
1	10	2016-06-30	06:00:00	15:00:00	17
2	10	2016-07-01	15:00:00	23:00:00	18
3	12	2016-06-10	23:00:00	07:00:00	19
4	18	2016-06-22	06:00:00	18:00:00	20
5	10	2016-06-11	00:00:00	12:00:00	21
\.


--
-- Name: grafik_id_grafiku_seq; Type: SEQUENCE SET; Schema: public; Owner: szwedek_aga
--

SELECT pg_catalog.setval('grafik_id_grafiku_seq', 21, true);


--
-- Data for Name: hotel; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY hotel (nazwa_hotelu, adres, nr_tel, email, nr_konta, strona_www) FROM stdin;
Hotel Project	Nigdzie*Niewidzialna*666*6*6	666777888	hotel.project@project	998877665544332211	http://hotel.project.li
\.


--
-- Data for Name: klient; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY klient (id_klienta, nazwa, nazwisko, imie, adres, pesel, nip, nr_telefonu) FROM stdin;
39		Latocha	Dominika	23-098*Jarosław*Ciekawa*23*323	777777777		777888555
40		Glowiak	Krystian	36-062*Pogwizdów Nowy*-*3*76	666788866		737377282
41		K	Anita	23-444*Rzeszów*Piłsudskiego*2*3	55555555555		345678901
42		swe	dd	ds*f*sd*d*s	34		32
38		Torres	Fernando	Madryt*San Miguel*33*3*3	7584930123		666777555
43		Adamowicz	Ada	26-600*Lodz*Lodzka*52*20	56892645024		509804650
44		Cebula	Janusz	11-116*Cebulaki*Żurowa*-*1	987675849		638014666
\.


--
-- Name: klient_id_klienta_seq; Type: SEQUENCE SET; Schema: public; Owner: szwedek_aga
--

SELECT pg_catalog.setval('klient_id_klienta_seq', 44, true);


--
-- Data for Name: logowanie; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY logowanie (id_pracownika, id_klienta, email, haslo) FROM stdin;
10	\N	justynaczuba@o2.pl	tysia
1	\N	admin	administrator
\N	38	at.ciesielska@gmail.com	agata
15	\N	aga.skijumping@gmail.com	agatka
\N	39	domkalato@og.pl	dominika
16	\N	hardytommy@pd.pl	tom
\N	40	krystiang93@gmail.com	krystian
\N	41	anita102410@o2.pl	kajko1024
\N	42	kla@g.com	kla
18	\N	julekste@fl.fl	julian
19	\N	ave@satan.hell	artur
20	\N	krolstef@ste.hg	stefania
29	\N	fg@fg.fg	fg
\N	43	ada@ada.com	ada
\N	44	polaczek69@buziaczunia.df	janusz
\.


--
-- Data for Name: meldunek; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY meldunek (imie, nazwisko, pesel, adres, id_rez_pok) FROM stdin;
Agata	Ciesielska	9900887766	35-232*Rzeszów*Cynamonowa*1*1	119
Tomasz	Korab	6666666666	35-210*Rzeszów*Gałczyńskiego*-*2A	121
\.


--
-- Data for Name: pokoj; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY pokoj (id_pokoju, typ) FROM stdin;
1	2
2	3
3	4
4	6
5	1
6	2
7	3
8	4
9	6
10	1
11	2
12	3
13	4
14	6
\.


--
-- Name: pokoj_id_pokoju_seq; Type: SEQUENCE SET; Schema: public; Owner: szwedek_aga
--

SELECT pg_catalog.setval('pokoj_id_pokoju_seq', 19, true);


--
-- Data for Name: pracownik; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY pracownik (id_pracownika, imie, nazwisko, adres, nr_tele, id_stanowiska) FROM stdin;
4	Jan	Kowalski	66-666	999999000	1
10	Justyna	Czuba	22-222	777777777	1
11	Marian	Kowalski		1212231312	3
12	sdfosahf	lwejfiwoi		8492537892	2
13	Tomasz	Korab		823759832	2
14	Dominik	Filip		0984309345	3
15	Agata	Ciesielska	35-232	691475780	2
16	Tom	Hardy	44-444	222223333	3
18	Julian	Stępień	09-273	123456789	2
19	Artur	Szwed	66-666	700000000	3
1	Ktoś	Ważny	22-222*lele*lolo*9*6	777777777	0
20	Stefania	Król	76-987	123123123	2
22	Andrzej	Fejklowicz	23-232	4455667788	2
24	Paweł	Kuraś	11-111	456456456	2
29	df	df	df	df	2
\.


--
-- Name: pracownik_id_pracownika_seq; Type: SEQUENCE SET; Schema: public; Owner: szwedek_aga
--

SELECT pg_catalog.setval('pracownik_id_pracownika_seq', 29, true);


--
-- Data for Name: rachunek; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY rachunek (id_rezerwacji, cena, id_rodz_rach, id_rodz_plat) FROM stdin;
124	2.100,00 zł	1	2
125	280,00 zł	1	1
127	210,00 zł	1	1
126	5.240,00 zł	1	1
128	190,00 zł	1	2
\.


--
-- Data for Name: rezerwacja; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY rezerwacja (id_rez_pok, data_rezerwacji, suma_ogolem, suma_pozostala, data_przyjazdu, data_wyjazdu, id_klienta, id_rezerwacji) FROM stdin;
119	2016-06-09	\N	\N	2016-06-09	2016-06-23	38	124
120	2016-06-09	\N	\N	2016-06-09	2016-06-16	38	125
121	2016-06-11	\N	\N	2016-06-09	2016-10-18	10	126
122	2016-06-11	\N	\N	2016-06-22	2016-06-24	43	127
123	2016-06-11	\N	\N	2016-06-11	2016-06-13	44	128
\.


--
-- Name: rezerwacja_id_rezerwacji_seq; Type: SEQUENCE SET; Schema: public; Owner: szwedek_aga
--

SELECT pg_catalog.setval('rezerwacja_id_rezerwacji_seq', 128, true);


--
-- Data for Name: rezerwacja_pokoju; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY rezerwacja_pokoju (id_pokoju, id_rez_pok) FROM stdin;
13	119
10	120
5	121
2	122
11	123
\.


--
-- Name: rezerwacja_pokoju_id_rez_pok_seq; Type: SEQUENCE SET; Schema: public; Owner: szwedek_aga
--

SELECT pg_catalog.setval('rezerwacja_pokoju_id_rez_pok_seq', 123, true);


--
-- Data for Name: rodzaj_platnosci; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY rodzaj_platnosci (id_rodz_plat, nazwa_rodz_plat) FROM stdin;
1	Karta
2	Gotówka
\.


--
-- Data for Name: rodzaj_rachunku; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY rodzaj_rachunku (id_rodz_rach, nazwa_rodz_rach) FROM stdin;
1	Paragon
2	Faktura
\.


--
-- Data for Name: stanowisko; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY stanowisko (id_stanowiska, nazwa_stanowiska) FROM stdin;
0	Administrator
1	Recepcjonista
2	Kucharz
3	Serwis sprzątający
\.


--
-- Data for Name: typ_pokoju; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY typ_pokoju (typ, cena) FROM stdin;
1	40
2	75
3	105
4	130
6	190
5	160
\.


--
-- Data for Name: typ_uslugi; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY typ_uslugi (id_uslugi, nazwa_uslugi, cena_uslugi) FROM stdin;
1	sprzątanie	10
2	śniadanie	15
3	parking	10
\.


--
-- Data for Name: typ_zlec_prac; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY typ_zlec_prac (id_pracy, nazwa) FROM stdin;
\.


--
-- Data for Name: typ_znizki; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY typ_znizki (id_typu_znizki, nazwa_znizki, procent) FROM stdin;
\.


--
-- Data for Name: usluga; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY usluga (id_uslugi, id_rez_pok) FROM stdin;
3	119
1	119
2	120
1	121
2	121
\.


--
-- Data for Name: zatrudnienie; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY zatrudnienie (id_pracownika, data_zatrudnienia, data_zwolnienia) FROM stdin;
1	2016-06-06	\N
4	2016-06-06	\N
10	2016-06-06	\N
11	2016-06-06	\N
12	2016-06-06	\N
13	2016-06-06	\N
14	2016-06-06	\N
15	2016-06-08	\N
16	2016-06-08	\N
18	2016-06-08	\N
19	2016-06-08	\N
20	2016-06-08	\N
29	2016-06-08	\N
\.


--
-- Data for Name: zlecona_praca; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY zlecona_praca (id_pokoju, id_pracy, data_zlecenia, data_zakonczenia, id_pracownika) FROM stdin;
\.


--
-- Data for Name: zmiana; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY zmiana (id_zmiany, nazwa_zmiany, stawka, godziny) FROM stdin;
1	Zmiana dzienna 8 godzinna	10	8
7	Nadgodziny 8	12	8
6	Zmiana świąteczna 6 godzinna	12	6
5	Zmiana nocna 12 godzinna	17	12
4	Zmiana dzienna 12 godzinna	13	12
3	Zmiana nocna 8 godzinna	14	8
2	Zmiana popołudniowa 8 godzinna	10	8
8	Nadgodziny 6	11	6
9	Nadgodziny 12	17	12
\.


--
-- Data for Name: znizka; Type: TABLE DATA; Schema: public; Owner: szwedek_aga
--

COPY znizka (id_rezerwacji, id_typu_znizki) FROM stdin;
\.


--
-- Name: id_zmiany; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY zmiana
    ADD CONSTRAINT id_zmiany PRIMARY KEY (id_zmiany);


--
-- Name: klient_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY klient
    ADD CONSTRAINT klient_pk PRIMARY KEY (id_klienta);


--
-- Name: logowanie_pkey; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY logowanie
    ADD CONSTRAINT logowanie_pkey PRIMARY KEY (email);


--
-- Name: pokoj_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY pokoj
    ADD CONSTRAINT pokoj_pk PRIMARY KEY (id_pokoju);


--
-- Name: pracownik_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY pracownik
    ADD CONSTRAINT pracownik_pk PRIMARY KEY (id_pracownika);


--
-- Name: rezerwacja_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY rezerwacja
    ADD CONSTRAINT rezerwacja_pk PRIMARY KEY (id_rezerwacji);


--
-- Name: rezerwacja_pokoju_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY rezerwacja_pokoju
    ADD CONSTRAINT rezerwacja_pokoju_pk PRIMARY KEY (id_rez_pok);


--
-- Name: rodzaj_platnosci_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY rodzaj_platnosci
    ADD CONSTRAINT rodzaj_platnosci_pk PRIMARY KEY (id_rodz_plat);


--
-- Name: rodzaj_rachunku_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY rodzaj_rachunku
    ADD CONSTRAINT rodzaj_rachunku_pk PRIMARY KEY (id_rodz_rach);


--
-- Name: stanowisko_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY stanowisko
    ADD CONSTRAINT stanowisko_pk PRIMARY KEY (id_stanowiska);


--
-- Name: typ_pokoju_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY typ_pokoju
    ADD CONSTRAINT typ_pokoju_pk PRIMARY KEY (typ);


--
-- Name: typ_uslugi_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY typ_uslugi
    ADD CONSTRAINT typ_uslugi_pk PRIMARY KEY (id_uslugi);


--
-- Name: typ_zlec_prac_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY typ_zlec_prac
    ADD CONSTRAINT typ_zlec_prac_pk PRIMARY KEY (id_pracy);


--
-- Name: typ_znizki_pk; Type: CONSTRAINT; Schema: public; Owner: szwedek_aga; Tablespace: 
--

ALTER TABLE ONLY typ_znizki
    ADD CONSTRAINT typ_znizki_pk PRIMARY KEY (id_typu_znizki);


--
-- Name: grafik_id_pracownika_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY grafik
    ADD CONSTRAINT grafik_id_pracownika_fkey FOREIGN KEY (id_pracownika) REFERENCES pracownik(id_pracownika);


--
-- Name: grafik_id_zmiany_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY grafik
    ADD CONSTRAINT grafik_id_zmiany_fkey FOREIGN KEY (id_zmiany) REFERENCES zmiana(id_zmiany);


--
-- Name: logowanie_id_klienta_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY logowanie
    ADD CONSTRAINT logowanie_id_klienta_fkey FOREIGN KEY (id_klienta) REFERENCES klient(id_klienta) ON DELETE CASCADE;


--
-- Name: logowanie_id_pracownika_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY logowanie
    ADD CONSTRAINT logowanie_id_pracownika_fkey FOREIGN KEY (id_pracownika) REFERENCES pracownik(id_pracownika) ON DELETE CASCADE;


--
-- Name: meldunek_id_rez_pok_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY meldunek
    ADD CONSTRAINT meldunek_id_rez_pok_fkey FOREIGN KEY (id_rez_pok) REFERENCES rezerwacja_pokoju(id_rez_pok);


--
-- Name: pracownik_id_stanowiska_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY pracownik
    ADD CONSTRAINT pracownik_id_stanowiska_fkey FOREIGN KEY (id_stanowiska) REFERENCES stanowisko(id_stanowiska);


--
-- Name: rachunek_id_rezerwacji_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rachunek
    ADD CONSTRAINT rachunek_id_rezerwacji_fkey FOREIGN KEY (id_rezerwacji) REFERENCES rezerwacja(id_rezerwacji) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rachunek_id_rodz_plat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rachunek
    ADD CONSTRAINT rachunek_id_rodz_plat_fkey FOREIGN KEY (id_rodz_plat) REFERENCES rodzaj_platnosci(id_rodz_plat) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rachunek_id_rodz_rach_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rachunek
    ADD CONSTRAINT rachunek_id_rodz_rach_fkey FOREIGN KEY (id_rodz_rach) REFERENCES rodzaj_rachunku(id_rodz_rach) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rezerwacja_id_rez_pok_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rezerwacja
    ADD CONSTRAINT rezerwacja_id_rez_pok_fkey FOREIGN KEY (id_rez_pok) REFERENCES rezerwacja_pokoju(id_rez_pok);


--
-- Name: rezerwacja_pokoju_id_pokoju_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY rezerwacja_pokoju
    ADD CONSTRAINT rezerwacja_pokoju_id_pokoju_fkey FOREIGN KEY (id_pokoju) REFERENCES pokoj(id_pokoju);


--
-- Name: usluga_id_rez_pok_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY usluga
    ADD CONSTRAINT usluga_id_rez_pok_fkey FOREIGN KEY (id_rez_pok) REFERENCES rezerwacja_pokoju(id_rez_pok);


--
-- Name: zatrudnienie_id_pracownika_fkey; Type: FK CONSTRAINT; Schema: public; Owner: szwedek_aga
--

ALTER TABLE ONLY zatrudnienie
    ADD CONSTRAINT zatrudnienie_id_pracownika_fkey FOREIGN KEY (id_pracownika) REFERENCES pracownik(id_pracownika);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

