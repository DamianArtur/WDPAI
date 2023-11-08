--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1 (Debian 15.1-1.pgdg110+1)
-- Dumped by pg_dump version 15.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: deleteoldreports(); Type: FUNCTION; Schema: public; Owner: dbuser
--

CREATE FUNCTION public.deleteoldreports() RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    now timestamp := current_timestamp;
    result integer := (select count(*) from reports where extract(days from (now - reports.created_at)) > 14);
BEGIN
    delete from reports where extract(days from (now - reports.created_at)) > 14;
    RETURN result;
END;
$$;


ALTER FUNCTION public.deleteoldreports() OWNER TO dbuser;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: reports; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.reports (
    id integer NOT NULL,
    title character varying,
    description character varying,
    id_assigned_by integer,
    image character varying,
    created_at timestamp without time zone,
    longitude double precision,
    latitude double precision,
    type character varying,
    date character varying,
    contact character varying
);


ALTER TABLE public.reports OWNER TO dbuser;

--
-- Name: reports_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.reports_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reports_id_seq OWNER TO dbuser;

--
-- Name: reports_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.reports_id_seq OWNED BY public.reports.id;


--
-- Name: sesssions; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.sesssions (
    id integer NOT NULL,
    login character varying NOT NULL
);


ALTER TABLE public.sesssions OWNER TO dbuser;

--
-- Name: users_details; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users_details (
    id integer NOT NULL,
    name character varying,
    surname character varying,
    phone character varying
);


ALTER TABLE public.users_details OWNER TO dbuser;

--
-- Name: user_details_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.user_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_details_id_seq OWNER TO dbuser;

--
-- Name: user_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.user_details_id_seq OWNED BY public.users_details.id;


--
-- Name: user_reports; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.user_reports (
    id_user integer NOT NULL,
    id_report integer NOT NULL
);


ALTER TABLE public.user_reports OWNER TO dbuser;

--
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
    id integer NOT NULL,
    id_user_details integer NOT NULL,
    email character varying NOT NULL,
    password character varying NOT NULL,
    created_at character varying,
    role character varying DEFAULT 'user'::character varying NOT NULL
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO dbuser;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: reports id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.reports ALTER COLUMN id SET DEFAULT nextval('public.reports_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: users_details id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_details ALTER COLUMN id SET DEFAULT nextval('public.user_details_id_seq'::regclass);


--
-- Data for Name: reports; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.reports (id, title, description, id_assigned_by, image, created_at, longitude, latitude, type, date, contact) VALUES (38, 'Wycieczka na Babią', 'Piękna pogoda, przesyłam zdjęcia', 3, 'mountains.jpg', '2023-02-10 00:00:00', 19.472752579391283, 49.595256524836344, 'photo', NULL, NULL);
INSERT INTO public.reports (id, title, description, id_assigned_by, image, created_at, longitude, latitude, type, date, contact) VALUES (39, 'Wycieczka na Kopę Kondracką', 'Z Doliny Małej Łąki na Kopę i do Kuźnic, ok 8h', 3, NULL, '2023-02-10 00:00:00', 19.932306043359546, 49.23645228954169, 'calendar', '15/07/2023', 'Jan Kowalski, 123456789');
INSERT INTO public.reports (id, title, description, id_assigned_by, image, created_at, longitude, latitude, type, date, contact) VALUES (40, 'Pogoda na Baraniej', 'zachmurzenie częściowe, 15 °C, widoczność dobra', 3, 'peak.jpg', '2023-02-10 00:00:00', 19.01111657430286, 49.61289376731702, 'weather', NULL, NULL);
INSERT INTO public.reports (id, title, description, id_assigned_by, image, created_at, longitude, latitude, type, date, contact) VALUES (41, 'Wycinka drzew', 'Zniszczone oznaczenie na czarnym szlaku na skutek wycinki drzew. GPS konieczny', 3, 'indeks.jpg', '2023-02-10 00:00:00', 19.328356535032412, 49.77963221639763, 'signpost', NULL, NULL);
INSERT INTO public.reports (id, title, description, id_assigned_by, image, created_at, longitude, latitude, type, date, contact) VALUES (42, 'Uwaga - błoto!', 'Duże błoto na podejściu z Obidowca, lepiej wybrać inne trasę na Turbacz', 3, 'forest.jpg', '2023-02-10 00:00:00', 20.090161902948836, 49.55554533357099, 'path', NULL, NULL);


--
-- Data for Name: sesssions; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.sesssions (id, login) VALUES (5, 'anna.nowak@com');


--
-- Data for Name: user_reports; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.user_reports (id_user, id_report) VALUES (3, 38);
INSERT INTO public.user_reports (id_user, id_report) VALUES (3, 39);
INSERT INTO public.user_reports (id_user, id_report) VALUES (3, 40);
INSERT INTO public.user_reports (id_user, id_report) VALUES (3, 41);
INSERT INTO public.user_reports (id_user, id_report) VALUES (3, 42);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.users (id, id_user_details, email, password, created_at, role) VALUES (3, 4, 'jan.kowalski@email.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'user');
INSERT INTO public.users (id, id_user_details, email, password, created_at, role) VALUES (5, 5, 'anna.nowak@com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'user');
INSERT INTO public.users (id, id_user_details, email, password, created_at, role) VALUES (1, 1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'moderator');


--
-- Data for Name: users_details; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.users_details (id, name, surname, phone) VALUES (4, 'Jan', 'Kowalski', '123456789');
INSERT INTO public.users_details (id, name, surname, phone) VALUES (5, 'Anna', 'Nowak', '123456789');
INSERT INTO public.users_details (id, name, surname, phone) VALUES (6, 'Anna', 'Nowak', '123456789');
INSERT INTO public.users_details (id, name, surname, phone) VALUES (1, 'Admin', 'Admin', '000000000');
INSERT INTO public.users_details (id, name, surname, phone) VALUES (7, '', '', '');
INSERT INTO public.users_details (id, name, surname, phone) VALUES (8, '', '', '');


--
-- Name: reports_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.reports_id_seq', 42, true);


--
-- Name: user_details_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.user_details_id_seq', 8, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_id_seq', 7, true);


--
-- Name: reports reports_id_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_id_key UNIQUE (id);


--
-- Name: reports reports_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_pkey PRIMARY KEY (id);


--
-- Name: sesssions sesssions_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.sesssions
    ADD CONSTRAINT sesssions_pkey PRIMARY KEY (id);


--
-- Name: users_details user_details_id_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_details
    ADD CONSTRAINT user_details_id_key UNIQUE (id);


--
-- Name: users_details user_details_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_details
    ADD CONSTRAINT user_details_pkey PRIMARY KEY (id);


--
-- Name: users users_id_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_id_key UNIQUE (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: reports reports_users_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_users_id_fk FOREIGN KEY (id_assigned_by) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: user_reports user_reports_reports_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.user_reports
    ADD CONSTRAINT user_reports_reports_id_fk FOREIGN KEY (id_report) REFERENCES public.reports(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: user_reports user_reports_users_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.user_reports
    ADD CONSTRAINT user_reports_users_id_fk FOREIGN KEY (id_user) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users users_user_details_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_user_details_id_fk FOREIGN KEY (id_user_details) REFERENCES public.users_details(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

