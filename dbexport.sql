--
-- PostgreSQL database dump
--

-- Dumped from database version 14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)

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
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: listing; Type: TABLE; Schema: public; Owner: ffk9uu
--

CREATE TABLE public.listing (
    id integer NOT NULL,
    title text NOT NULL,
    addr text NOT NULL,
    "desc" text NOT NULL,
    rent integer NOT NULL,
    num_bath integer NOT NULL,
    num_bed integer NOT NULL,
    image boolean NOT NULL,
    rating integer NOT NULL,
    amenities text,
    author_id integer NOT NULL
);


ALTER TABLE public.listing OWNER TO ffk9uu;

--
-- Name: person; Type: TABLE; Schema: public; Owner: ffk9uu
--

CREATE TABLE public.person (
    id integer NOT NULL,
    name text NOT NULL,
    email text,
    password text NOT NULL
);


ALTER TABLE public.person OWNER TO ffk9uu;

--
-- Data for Name: listing; Type: TABLE DATA; Schema: public; Owner: ffk9uu
--



--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: ffk9uu
--



--
-- Name: listing listing_pkey; Type: CONSTRAINT; Schema: public; Owner: ffk9uu
--

ALTER TABLE ONLY public.listing
    ADD CONSTRAINT listing_pkey PRIMARY KEY (id);


--
-- Name: person person_pkey; Type: CONSTRAINT; Schema: public; Owner: ffk9uu
--

ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--
