-- public.tbl_claim_data definition

-- Drop table

-- DROP TABLE public.tbl_claim_data;

CREATE TABLE public.tbl_claim_data (
	id bigserial NOT NULL,
	cedant_clm_nbr varchar(255) NULL,
	policy_no varchar(255) NULL,
	certificate_no varchar(25) NULL,
	insured_name varchar(255) NULL,
	effective_date date NULL,
	sum_assured float8 NULL,
	benefit varchar(255) NULL,
	event_date date NULL,
	submit_date date NULL,
	complate_date date NULL,
	approval_date date NULL,
	payment_date date NULL,
	investigation varchar(255) NULL,
	curr_idr varchar(255) NULL,
	submission_amt float8 NULL,
	approved_amt float8 NULL,
	paid_amt float8 NULL,
	diagnosis_desc varchar(255) NULL,
	tre_share_amt float8 NULL,
	sent_to_reinsr_date date NULL,
	sla varchar(255) NULL,
	upload_date timestamp(0) NULL DEFAULT now(),
	upload_number varchar(255) NULL,
	users_upload varchar(255) NULL,
	ceding_name varchar NULL,
	treaty_name varchar NULL,
	tre_si float8 NULL,
	birth_date date NULL,
	cedant_rate float8 NULL,
	stnc date NULL,
	CONSTRAINT tbl_claim_data_pkey PRIMARY KEY (id)
);