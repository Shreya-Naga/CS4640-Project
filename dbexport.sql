create sequence person_seq;

CREATE TABLE public.person (
	id int4 NOT NULL DEFAULT nextval('person_seq'::regclass),
	email text NOT NULL,
	"password" text NOT NULL,
	CONSTRAINT person_pkey PRIMARY KEY (id)
);

create sequence list_seq;

CREATE TABLE public.listing (
	id int4 NOT NULL DEFAULT nextval('list_seq'::regclass),
	title text NOT NULL,
	addr text NOT NULL,
	"desc" text NOT NULL,
	rent int4 NOT NULL,
	num_bath int4 NOT NULL,
	num_bed int4 NOT NULL,
	image bool NOT NULL,
	rating int4 NOT NULL,
	amenities text NULL,
	author_id int4 NOT NULL,
	CONSTRAINT listing_pkey PRIMARY KEY (id),
	CONSTRAINT listing_fk FOREIGN KEY (id) REFERENCES public.person(id)
);