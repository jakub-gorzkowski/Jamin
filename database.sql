--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1 (Debian 16.1-1.pgdg120+1)
-- Dumped by pg_dump version 16.1

-- Started on 2024-01-29 04:02:27 UTC

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
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 3420 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 218 (class 1259 OID 16614)
-- Name: categories; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.categories (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.categories OWNER TO docker;

--
-- TOC entry 217 (class 1259 OID 16613)
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO docker;

--
-- TOC entry 3421 (class 0 OID 0)
-- Dependencies: 217
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- TOC entry 222 (class 1259 OID 16630)
-- Name: events; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.events (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    image character varying(255),
    min_price numeric(10,2) NOT NULL,
    max_price numeric(10,2) NOT NULL,
    location_id integer,
    category_id integer,
    is_promoted boolean NOT NULL,
    date date
);


ALTER TABLE public.events OWNER TO docker;

--
-- TOC entry 221 (class 1259 OID 16629)
-- Name: events_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.events_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.events_id_seq OWNER TO docker;

--
-- TOC entry 3422 (class 0 OID 0)
-- Dependencies: 221
-- Name: events_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.events_id_seq OWNED BY public.events.id;


--
-- TOC entry 223 (class 1259 OID 16648)
-- Name: followed; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.followed (
    user_id integer NOT NULL,
    event_id integer NOT NULL
);


ALTER TABLE public.followed OWNER TO docker;

--
-- TOC entry 216 (class 1259 OID 16607)
-- Name: locations; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.locations (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.locations OWNER TO docker;

--
-- TOC entry 224 (class 1259 OID 16665)
-- Name: observed_categories; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.observed_categories (
    user_id integer NOT NULL,
    category_id integer NOT NULL
);


ALTER TABLE public.observed_categories OWNER TO docker;

--
-- TOC entry 225 (class 1259 OID 16680)
-- Name: observed_locations; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.observed_locations (
    user_id integer NOT NULL,
    location_id integer NOT NULL
);


ALTER TABLE public.observed_locations OWNER TO docker;

--
-- TOC entry 220 (class 1259 OID 16621)
-- Name: users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role character varying(50) DEFAULT 'user'::character varying NOT NULL
);


ALTER TABLE public.users OWNER TO docker;

--
-- TOC entry 226 (class 1259 OID 16695)
-- Name: get_events; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public.get_events AS
 SELECT e.id,
    e.name,
    e.description,
    e.date,
    e.image,
    e.min_price,
    e.max_price,
    l.name AS location,
    c.name AS category,
    e.is_promoted,
    u.id AS user_id
   FROM (((((public.events e
     JOIN public.locations l ON ((e.location_id = l.id)))
     JOIN public.categories c ON ((e.category_id = c.id)))
     JOIN public.observed_categories oc ON ((c.id = oc.category_id)))
     JOIN public.observed_locations ol ON ((l.id = ol.location_id)))
     JOIN public.users u ON (((oc.user_id = u.id) AND (ol.user_id = u.id))));


ALTER VIEW public.get_events OWNER TO docker;

--
-- TOC entry 227 (class 1259 OID 16701)
-- Name: get_followed_events; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public.get_followed_events AS
 SELECT e.id,
    e.name,
    e.description,
    e.image,
    e.date AS event_date,
    e.min_price,
    e.max_price,
    e.is_promoted,
    l.name AS location,
    c.name AS category,
    u.id AS user_id
   FROM ((((public.events e
     JOIN public.followed f ON ((e.id = f.event_id)))
     JOIN public.users u ON ((f.user_id = u.id)))
     LEFT JOIN public.locations l ON ((e.location_id = l.id)))
     LEFT JOIN public.categories c ON ((e.category_id = c.id)));


ALTER VIEW public.get_followed_events OWNER TO docker;

--
-- TOC entry 215 (class 1259 OID 16606)
-- Name: locations_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.locations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.locations_id_seq OWNER TO docker;

--
-- TOC entry 3423 (class 0 OID 0)
-- Dependencies: 215
-- Name: locations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.locations_id_seq OWNED BY public.locations.id;


--
-- TOC entry 228 (class 1259 OID 16711)
-- Name: search_event; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public.search_event AS
 SELECT e.id,
    e.name,
    e.description,
    e.image,
    e.min_price,
    e.max_price,
    e.location_id,
    e.category_id,
    e.is_promoted,
    e.date,
    e.name AS event_name,
    e.description AS event_description,
    l.name AS location_name,
    c.name AS category_name
   FROM ((public.events e
     JOIN public.locations l ON ((e.location_id = l.id)))
     JOIN public.categories c ON ((e.category_id = c.id)));


ALTER VIEW public.search_event OWNER TO docker;

--
-- TOC entry 219 (class 1259 OID 16620)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO docker;

--
-- TOC entry 3424 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 3243 (class 2604 OID 16617)
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- TOC entry 3246 (class 2604 OID 16633)
-- Name: events id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.events ALTER COLUMN id SET DEFAULT nextval('public.events_id_seq'::regclass);


--
-- TOC entry 3242 (class 2604 OID 16610)
-- Name: locations id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.locations ALTER COLUMN id SET DEFAULT nextval('public.locations_id_seq'::regclass);


--
-- TOC entry 3244 (class 2604 OID 16624)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3250 (class 2606 OID 16619)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- TOC entry 3254 (class 2606 OID 16637)
-- Name: events events_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.events
    ADD CONSTRAINT events_pkey PRIMARY KEY (id);


--
-- TOC entry 3256 (class 2606 OID 16652)
-- Name: followed followed_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.followed
    ADD CONSTRAINT followed_pkey PRIMARY KEY (user_id, event_id);


--
-- TOC entry 3248 (class 2606 OID 16612)
-- Name: locations locations_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.locations
    ADD CONSTRAINT locations_pkey PRIMARY KEY (id);


--
-- TOC entry 3258 (class 2606 OID 16669)
-- Name: observed_categories observed_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.observed_categories
    ADD CONSTRAINT observed_categories_pkey PRIMARY KEY (user_id, category_id);


--
-- TOC entry 3260 (class 2606 OID 16684)
-- Name: observed_locations observed_locations_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.observed_locations
    ADD CONSTRAINT observed_locations_pkey PRIMARY KEY (user_id, location_id);


--
-- TOC entry 3252 (class 2606 OID 16628)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3261 (class 2606 OID 16643)
-- Name: events events_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.events
    ADD CONSTRAINT events_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- TOC entry 3262 (class 2606 OID 16638)
-- Name: events events_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.events
    ADD CONSTRAINT events_location_id_fkey FOREIGN KEY (location_id) REFERENCES public.locations(id) ON DELETE CASCADE;


--
-- TOC entry 3263 (class 2606 OID 16658)
-- Name: followed followed_event_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.followed
    ADD CONSTRAINT followed_event_id_fkey FOREIGN KEY (event_id) REFERENCES public.events(id) ON DELETE CASCADE;


--
-- TOC entry 3264 (class 2606 OID 16653)
-- Name: followed followed_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.followed
    ADD CONSTRAINT followed_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3265 (class 2606 OID 16675)
-- Name: observed_categories observed_categories_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.observed_categories
    ADD CONSTRAINT observed_categories_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- TOC entry 3266 (class 2606 OID 16670)
-- Name: observed_categories observed_categories_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.observed_categories
    ADD CONSTRAINT observed_categories_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3267 (class 2606 OID 16690)
-- Name: observed_locations observed_locations_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.observed_locations
    ADD CONSTRAINT observed_locations_location_id_fkey FOREIGN KEY (location_id) REFERENCES public.locations(id) ON DELETE CASCADE;


--
-- TOC entry 3268 (class 2606 OID 16685)
-- Name: observed_locations observed_locations_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.observed_locations
    ADD CONSTRAINT observed_locations_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


-- Completed on 2024-01-29 04:02:27 UTC

--
-- PostgreSQL database dump complete
--

