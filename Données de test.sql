--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.19
-- Dumped by pg_dump version 11.7 (Debian 11.7-0+deb10u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: projet; Type: SCHEMA; Schema: -;
--

CREATE SCHEMA projet;




SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: animaux; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.animaux (
    numanimal integer NOT NULL,
    nom character varying(30),
    race character varying(20),
    taille smallint,
    genre smallint,
    vaccinations character varying(50),
    poids numeric,
    numprop integer NOT NULL,
    espece character varying(20),
    castration smallint
);




--
-- Name: anim_numanimal_seq; Type: SEQUENCE; Schema: projet;
--

CREATE SEQUENCE projet.anim_numanimal_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




--
-- Name: anim_numanimal_seq; Type: SEQUENCE OWNED BY; Schema: projet;
--

ALTER SEQUENCE projet.anim_numanimal_seq OWNED BY projet.animaux.numanimal;


--
-- Name: anim_numprop_seq; Type: SEQUENCE; Schema: projet;
--

CREATE SEQUENCE projet.anim_numprop_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




--
-- Name: anim_numprop_seq; Type: SEQUENCE OWNED BY; Schema: projet
--

ALTER SEQUENCE projet.anim_numprop_seq OWNED BY projet.animaux.numprop;


--
-- Name: seq_consultation; Type: SEQUENCE; Schema: projet; Owner
--

CREATE SEQUENCE projet.seq_consultation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- Name: consultation; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.consultation (
    numcons integer DEFAULT nextval('projet.seq_consultation'::regclass) NOT NULL,
    dateheure timestamp(0) without time zone NOT NULL,
    duree smallint,
    lieu character varying(50) DEFAULT NULL::character varying,
    anamnese character varying(50) DEFAULT NULL::character varying,
    resume character varying(255) DEFAULT NULL::character varying,
    diagnostique character varying(50) DEFAULT NULL::character varying,
    numtarif character(10) NOT NULL,
    conspre integer
);



--
-- Name: consulter; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.consulter (
    numanimal integer NOT NULL,
    numcons integer NOT NULL
);



--
-- Name: coutmanip; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.coutmanip (
    numcons integer NOT NULL,
    codemanip character(10) NOT NULL
);



--
-- Name: manipulation; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.manipulation (
    codemanip character(8) NOT NULL,
    cout numeric,
    duree smallint,
    libellemanip character varying(50) NOT NULL
);




--
-- Name: prescription; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.prescription (
    numcons integer NOT NULL,
    numtrait character(10) NOT NULL,
    frequence character varying(50) DEFAULT NULL::character varying,
    duree character varying(10) DEFAULT NULL::character varying
);




--
-- Name: proprietair; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.proprietair (
    numprop integer NOT NULL,
    nom character varying(10),
    prenom character varying(10),
    adresse character varying(40),
    telephone character(10),
    iban character(27),
    siteweb character varying(50),
    mdp character varying(50)
);




--
-- Name: prop_numprop_seq; Type: SEQUENCE; Schema: projet;
--

CREATE SEQUENCE projet.prop_numprop_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




--
-- Name: prop_numprop_seq; Type: SEQUENCE OWNED BY; Schema: projet;
--

ALTER SEQUENCE projet.prop_numprop_seq OWNED BY projet.proprietair.numprop;


--
-- Name: tarifconsultation; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.tarifconsultation (
    numtarif character(10) NOT NULL,
    typeconsultation character varying(50) DEFAULT NULL::character varying,
    distance numeric,
    prixactuel numeric NOT NULL
);




--
-- Name: tarifdate; Type: TABLE; Schema: projet
--

CREATE TABLE projet.tarifdate (
    numtarif character(10) NOT NULL,
    datetarif date NOT NULL,
    prix numeric
);




--
-- Name: traitements; Type: TABLE; Schema: projet;
--

CREATE TABLE projet.traitements (
    numtrait character(10) NOT NULL,
    produit character varying(20) DEFAULT NULL::character varying,
    dillution character varying(20) DEFAULT NULL::character varying
);




--
-- Name: animaux numanimal; Type: DEFAULT; Schema: projet;
--

ALTER TABLE ONLY projet.animaux ALTER COLUMN numanimal SET DEFAULT nextval('projet.anim_numanimal_seq'::regclass);


--
-- Name: animaux numprop; Type: DEFAULT; Schema: projet;
--

ALTER TABLE ONLY projet.animaux ALTER COLUMN numprop SET DEFAULT nextval('projet.anim_numprop_seq'::regclass);


--
-- Name: proprietair numprop; Type: DEFAULT; Schema: projet;
--

ALTER TABLE ONLY projet.proprietair ALTER COLUMN numprop SET DEFAULT nextval('projet.prop_numprop_seq'::regclass);


--
-- Data for Name: animaux; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.animaux VALUES (3, 'Thierry', 'Couleuvre', 250, 0, 'Aucun', 2.30, 1, 'Serpent', 0);
INSERT INTO projet.animaux VALUES (4, 'Pascal', 'Python', 10, 0, 'Aucun', 2.50, 1, 'Serpent', 0);
INSERT INTO projet.animaux VALUES (5, 'Tonnerre', 'Arabe', 120, 0, 'Choléra du cheval', 220.00, 2, 'Poney', 0);
INSERT INTO projet.animaux VALUES (6, 'Carapuce', 'Tortue de mer', 100, 1, 'Grippe de tortue', 105.00, 2, 'Tortue', 1);
INSERT INTO projet.animaux VALUES (7, 'Titi', 'Reithrodontomys', 10, 1, 'Peste', 105.00, 2, 'Souris', 0);
INSERT INTO projet.animaux VALUES (8, 'Géraldine', 'Loutre Blanche', 50, 1, 'Aucun', 1.60, 3, 'Loutre', 1);
INSERT INTO projet.animaux VALUES (9, 'tortipouss', 'tortue plante', 10, 0, 'pokerus', 40, 3, 'tortipouss', 0);
INSERT INTO projet.animaux VALUES (10, 'salameche', 'pokemon', 10, 0, 'pokerus', 40, 3, 'salamandre', 0);
INSERT INTO projet.animaux VALUES (12, 'popo', 'tortue plante', 12, 0, 'Ancun', 30, 3, 'tortue', 0);
INSERT INTO projet.animaux VALUES (13, 'pepper', 'cocker', 40, 1, 'Ancun', 30, 3, 'chien', 0);
INSERT INTO projet.animaux VALUES (15, 'hubert', 'blanche', 10, 0, 'Ancun', 20, 3, 'marmotte', 0);
INSERT INTO projet.animaux VALUES (19, 'Lucas', 'informaticien', 180, 0, 'Ancun', 60, 3, 'chien', 0);


--
-- Data for Name: consultation; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.consultation VALUES (1, '2021-08-11 09:10:37', 30, 'Cabinet', 'Douleur à la machoire', 'Après une observation et un nettoyage des dents le problème semble avoir disparu', 'Dentition abimée', '0000000001', NULL);
INSERT INTO projet.consultation VALUES (2, '2021-12-06 09:19:30', 20, 'Cabinet', 'Un client amène sont animal pour castration', 'Opération effectuée sans complication', 'Aucun problème', '0000000001', NULL);
INSERT INTO projet.consultation VALUES (3, '2021-05-12 09:35:27', 10, 'Cabinet', 'L animal se déplace avec difficulté.', 'Après observation il a fallu remboiter la cheville de l animal.', 'Cheville déboitée', '0000000001', NULL);
INSERT INTO projet.consultation VALUES (5, '2019-09-11 08:32:28', 40, 'Chez le propriétaire', 'L animal ne mange plus', 'Une palpation de l estomac montre une nécessité d un changement de régime alimentaire.', 'Ventre gonflé dû à la consommation de viandes.', '0000000004', NULL);
INSERT INTO projet.consultation VALUES (4, '2020-03-25 14:28:37', 50, 'Chez le prpriétaire', 'Animal dérangé', 'Pas de blessure physiques apparentes mais des douleurs à la tête. Prescription de médicaments.', 'Fort maux de tête', '0000000002', 1);
INSERT INTO projet.consultation VALUES (8, '2022-05-08 00:00:00', NULL, ' en cabinet', 'il a mal au ventre', NULL, NULL, '0000000001', NULL);
INSERT INTO projet.consultation VALUES (9, '2022-05-22 00:00:00', NULL, ' hors cabinet', 'A perdu toutes ses pattes', NULL, NULL, '0000000004', NULL);
INSERT INTO projet.consultation VALUES (10, '2022-05-15 00:00:00', NULL, ' en cabinet', 'il pue', NULL, NULL, '0000000001', NULL);


--
-- Data for Name: consulter; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.consulter VALUES (6, 1);
INSERT INTO projet.consulter VALUES (4, 2);
INSERT INTO projet.consulter VALUES (5, 3);
INSERT INTO projet.consulter VALUES (6, 4);
INSERT INTO projet.consulter VALUES (3, 5);


--
-- Data for Name: coutmanip; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.coutmanip VALUES (3, '00000002  ');
INSERT INTO projet.coutmanip VALUES (1, '00000003  ');
INSERT INTO projet.coutmanip VALUES (2, '00000004  ');
INSERT INTO projet.coutmanip VALUES (2, '00000005  ');
INSERT INTO projet.coutmanip VALUES (5, '00000005  ');


--
-- Data for Name: manipulation; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.manipulation VALUES ('00000001', 15.00, 20, 'Massage de l épaule');
INSERT INTO projet.manipulation VALUES ('00000002', 35.00, 2, 'Remboitage de la cheville');
INSERT INTO projet.manipulation VALUES ('00000003', 30.00, 15, 'Détartrage de dents');
INSERT INTO projet.manipulation VALUES ('00000004', 130.00, 60, 'Castration');
INSERT INTO projet.manipulation VALUES ('00000005', 50.00, 5, 'Palpation de l estomac');


--
-- Data for Name: prescription; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.prescription VALUES (4, '0000000001', '2 doses par jour', '1 mois');
INSERT INTO projet.prescription VALUES (5, '0000000004', '3 doses par jour', '3 jours');


--
-- Data for Name: proprietair; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.proprietair VALUES (1, 'Pascal', 'Thierry', '4 rue des choux-fleurs', '0625943518', NULL, NULL, 'ca693a8ccfa2cd3464d532afdfab31c5');
INSERT INTO projet.proprietair VALUES (3, 'Idrissi', 'Nidal', '28 avenue de la victoire', '1234567890', NULL, NULL, '518d67c03dfeca4085ee34656c5662f9');
INSERT INTO projet.proprietair VALUES (2, 'Zalesgon', 'Mathias', '26 Boulevard Copernic', '0689431527', 'FR1234567890123456789012345', 'www.rigolo.org', '38a3bbbe726810d4dfcb0afdbfff6962');
INSERT INTO projet.proprietair VALUES (4, 'Armstrong', 'Chad', 'America', '1234567890', '                           ', '', 'a6033f92de642c02bc33a5067157aee8');


--
-- Data for Name: tarifconsultation; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.tarifconsultation VALUES ('0000000001', 'Basique en cabinet', NULL, 40.22);
INSERT INTO projet.tarifconsultation VALUES ('0000000002', 'Basique hors cabinet', NULL, 25.00);
INSERT INTO projet.tarifconsultation VALUES ('0000000003', 'Ostéopathique en cabinet', NULL, 39.99);
INSERT INTO projet.tarifconsultation VALUES ('0000000004', 'Ostéopathique hors cabinet', NULL, 69.99);


--
-- Data for Name: tarifdate; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.tarifdate VALUES ('0000000001', '1995-01-01', 15.00);
INSERT INTO projet.tarifdate VALUES ('0000000001', '2021-12-07', 40.22);
INSERT INTO projet.tarifdate VALUES ('0000000002', '1995-01-01', 25.00);
INSERT INTO projet.tarifdate VALUES ('0000000003', '2012-12-21', 40.00);
INSERT INTO projet.tarifdate VALUES ('0000000003', '2021-12-07', 39.99);
INSERT INTO projet.tarifdate VALUES ('0000000004', '2012-12-21', 70.00);
INSERT INTO projet.tarifdate VALUES ('0000000004', '2021-12-07', 69.99);


--
-- Data for Name: traitements; Type: TABLE DATA; Schema: projet;
--

INSERT INTO projet.traitements VALUES ('0000000001', 'Aspirine', '500mg / L');
INSERT INTO projet.traitements VALUES ('0000000002', 'Cataplasme d argile', NULL);
INSERT INTO projet.traitements VALUES ('0000000003', 'Insuline', NULL);
INSERT INTO projet.traitements VALUES ('0000000004', 'Smecta', '10g/L');


--
-- Name: anim_numanimal_seq; Type: SEQUENCE SET; Schema: projet;
--

SELECT pg_catalog.setval('projet.anim_numanimal_seq', 21, true);


--
-- Name: anim_numprop_seq; Type: SEQUENCE SET; Schema: projet;
--

SELECT pg_catalog.setval('projet.anim_numprop_seq', 1, false);


--
-- Name: prop_numprop_seq; Type: SEQUENCE SET; Schema: projet;
--

SELECT pg_catalog.setval('projet.prop_numprop_seq', 6, true);


--
-- Name: seq_consultation; Type: SEQUENCE SET; Schema: projet;
--

SELECT pg_catalog.setval('projet.seq_consultation', 10, true);


--
-- Name: consultation consultation_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.consultation
    ADD CONSTRAINT consultation_pkey PRIMARY KEY (numcons);


--
-- Name: consulter consulter_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.consulter
    ADD CONSTRAINT consulter_pkey PRIMARY KEY (numanimal, numcons);


--
-- Name: coutmanip coutmanip_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.coutmanip
    ADD CONSTRAINT coutmanip_pkey PRIMARY KEY (numcons, codemanip);


--
-- Name: manipulation manipulation_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.manipulation
    ADD CONSTRAINT manipulation_pkey PRIMARY KEY (codemanip);


--
-- Name: animaux pk_anim; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.animaux
    ADD CONSTRAINT pk_anim PRIMARY KEY (numanimal);


--
-- Name: proprietair pk_prop; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.proprietair
    ADD CONSTRAINT pk_prop PRIMARY KEY (numprop);


--
-- Name: prescription prescription_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.prescription
    ADD CONSTRAINT prescription_pkey PRIMARY KEY (numcons, numtrait);


--
-- Name: tarifconsultation tarifconsultation_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.tarifconsultation
    ADD CONSTRAINT tarifconsultation_pkey PRIMARY KEY (numtarif);


--
-- Name: tarifdate tarifdate_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.tarifdate
    ADD CONSTRAINT tarifdate_pkey PRIMARY KEY (numtarif, datetarif);


--
-- Name: traitements traitements_pkey; Type: CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.traitements
    ADD CONSTRAINT traitements_pkey PRIMARY KEY (numtrait);


--
-- Name: consultation consultation_ibfk_1; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.consultation
    ADD CONSTRAINT consultation_ibfk_1 FOREIGN KEY (numtarif) REFERENCES projet.tarifconsultation(numtarif);


--
-- Name: coutmanip coutmanip_ibfk_1; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.coutmanip
    ADD CONSTRAINT coutmanip_ibfk_1 FOREIGN KEY (codemanip) REFERENCES projet.manipulation(codemanip);


--
-- Name: animaux fk_anim; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.animaux
    ADD CONSTRAINT fk_anim FOREIGN KEY (numprop) REFERENCES projet.proprietair(numprop);


--
-- Name: consultation fk_conspre; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.consultation
    ADD CONSTRAINT fk_conspre FOREIGN KEY (conspre) REFERENCES projet.consultation(numcons);


--
-- Name: consulter fk_numanimal; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.consulter
    ADD CONSTRAINT fk_numanimal FOREIGN KEY (numanimal) REFERENCES projet.animaux(numanimal);


--
-- Name: coutmanip fk_numcons; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.coutmanip
    ADD CONSTRAINT fk_numcons FOREIGN KEY (numcons) REFERENCES projet.consultation(numcons);


--
-- Name: prescription fk_numcons; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.prescription
    ADD CONSTRAINT fk_numcons FOREIGN KEY (numcons) REFERENCES projet.consultation(numcons);


--
-- Name: consulter fk_numcons; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.consulter
    ADD CONSTRAINT fk_numcons FOREIGN KEY (numcons) REFERENCES projet.consultation(numcons);


--
-- Name: prescription prescription_ibfk_2; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.prescription
    ADD CONSTRAINT prescription_ibfk_2 FOREIGN KEY (numtrait) REFERENCES projet.traitements(numtrait);


--
-- Name: tarifdate tarifdate_ibfk_1; Type: FK CONSTRAINT; Schema: projet;
--

ALTER TABLE ONLY projet.tarifdate
    ADD CONSTRAINT tarifdate_ibfk_1 FOREIGN KEY (numtarif) REFERENCES projet.tarifconsultation(numtarif);


--
-- Name: SCHEMA projet; Type: ACL; Schema: -;
--

REVOKE ALL ON SCHEMA projet FROM PUBLIC;
REVOKE ALL ON SCHEMA projet FROM "joshua.lemoine";
GRANT ALL ON SCHEMA projet TO "joshua.lemoine";
GRANT ALL ON SCHEMA projet TO "nidal.idrissi";


--
-- Name: TABLE animaux; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.animaux FROM PUBLIC;
REVOKE ALL ON TABLE projet.animaux FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.animaux TO "joshua.lemoine";


--
-- Name: TABLE consultation; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.consultation FROM PUBLIC;
REVOKE ALL ON TABLE projet.consultation FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.consultation TO "joshua.lemoine";
GRANT ALL ON TABLE projet.consultation TO "nidal.idrissi";


--
-- Name: TABLE consulter; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.consulter FROM PUBLIC;
REVOKE ALL ON TABLE projet.consulter FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.consulter TO "joshua.lemoine";
GRANT ALL ON TABLE projet.consulter TO "nidal.idrissi";


--
-- Name: TABLE coutmanip; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.coutmanip FROM PUBLIC;
REVOKE ALL ON TABLE projet.coutmanip FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.coutmanip TO "joshua.lemoine";
GRANT ALL ON TABLE projet.coutmanip TO "nidal.idrissi";


--
-- Name: TABLE manipulation; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.manipulation FROM PUBLIC;
REVOKE ALL ON TABLE projet.manipulation FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.manipulation TO "joshua.lemoine";
GRANT ALL ON TABLE projet.manipulation TO "nidal.idrissi";


--
-- Name: TABLE prescription; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.prescription FROM PUBLIC;
REVOKE ALL ON TABLE projet.prescription FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.prescription TO "joshua.lemoine";
GRANT ALL ON TABLE projet.prescription TO "nidal.idrissi";


--
-- Name: TABLE proprietair; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.proprietair FROM PUBLIC;
REVOKE ALL ON TABLE projet.proprietair FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.proprietair TO "joshua.lemoine";


--
-- Name: TABLE tarifconsultation; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.tarifconsultation FROM PUBLIC;
REVOKE ALL ON TABLE projet.tarifconsultation FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.tarifconsultation TO "joshua.lemoine";
GRANT ALL ON TABLE projet.tarifconsultation TO "nidal.idrissi";


--
-- Name: TABLE tarifdate; Type: ACL; Schema: projet;
--

REVOKE ALL ON TABLE projet.tarifdate FROM PUBLIC;
REVOKE ALL ON TABLE projet.tarifdate FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.tarifdate TO "joshua.lemoine";
GRANT ALL ON TABLE projet.tarifdate TO "nidal.idrissi";


--
-- Name: TABLE traitements; Type: ACL; Schema: projet; 
--

REVOKE ALL ON TABLE projet.traitements FROM PUBLIC;
REVOKE ALL ON TABLE projet.traitements FROM "joshua.lemoine";
GRANT ALL ON TABLE projet.traitements TO "joshua.lemoine";
GRANT ALL ON TABLE projet.traitements TO "nidal.idrissi";


--
-- PostgreSQL database dump complete
--

