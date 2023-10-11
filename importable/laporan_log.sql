--
-- PostgreSQL database dump
--

-- Dumped from database version 10.23
-- Dumped by pg_dump version 10.23

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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: news_log; Type: TABLE; Schema: public; Owner: sipareli
--

CREATE TABLE public.news_log (
    id integer DEFAULT nextval('public.news_log_id_seq'::regclass) NOT NULL,
    user_id integer NOT NULL,
    news_id integer NOT NULL,
    upload_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.news_log OWNER TO sipareli;

--
-- Data for Name: news_log; Type: TABLE DATA; Schema: public; Owner: sipareli
--

INSERT INTO public.news_log VALUES (10, 3, 13, '2023-08-23 14:53:56.236346');
INSERT INTO public.news_log VALUES (11, 3, 15, '2023-08-23 16:36:27.779263');
INSERT INTO public.news_log VALUES (12, 3, 16, '2023-08-29 09:21:08.418306');
INSERT INTO public.news_log VALUES (13, 3, 24, '2023-08-29 09:21:58.701898');
INSERT INTO public.news_log VALUES (14, 3, 25, '2023-08-29 10:40:41.159486');
INSERT INTO public.news_log VALUES (20, 4, 44, '2023-08-31 14:08:09.261439');
INSERT INTO public.news_log VALUES (21, 22, 57, '2023-09-06 13:39:48.677255');
INSERT INTO public.news_log VALUES (22, 22, 58, '2023-09-06 13:46:56.410376');
INSERT INTO public.news_log VALUES (23, 22, 59, '2023-09-06 13:49:47.685859');
INSERT INTO public.news_log VALUES (24, 4, 60, '2023-09-06 14:45:38.92087');
INSERT INTO public.news_log VALUES (25, 23, 64, '2023-09-07 16:34:22.20165');


--
-- Name: news_log news_log_pkey; Type: CONSTRAINT; Schema: public; Owner: sipareli
--

ALTER TABLE ONLY public.news_log
    ADD CONSTRAINT news_log_pkey PRIMARY KEY (id);


--
-- Name: TABLE news_log; Type: ACL; Schema: public; Owner: sipareli
--

GRANT ALL ON TABLE public.news_log TO PUBLIC;
GRANT ALL ON TABLE public.news_log TO postgres;


--
-- PostgreSQL database dump complete
--

