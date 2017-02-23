-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2017-02-22 14:18:43.617

-- tables
-- Table: shri_active_rides_listings
CREATE TABLE shri_active_rides_listings (
    arl_id bigint NOT NULL AUTO_INCREMENT,
    driver_id bigint NOT NULL,
    source varchar(150) NOT NULL,
    destination varchar(150) NOT NULL,
    total_seats enum('1','2','3','4','5','6') NOT NULL,
    available_seats enum('0','1','2','3','4','5','6') NOT NULL,
    distance varchar(10) NOT NULL,
    date_of_travel int NOT NULL,
    posted_on datetime NOT NULL,
    status enum('available','completed','dispute','full','cancelled') NOT NULL COMMENT 'active/cancelled by driver',
    src_state char(50) NOT NULL,
    src_country char(50) NOT NULL,
    src_city char(50) NOT NULL,
    zipcode int NOT NULL,
    driver_comments varchar(300) NOT NULL,
    dest_city char(50) NOT NULL,
    dest_state char(50) NOT NULL,
    dest_country char(50) NOT NULL,
    landmark varchar(100) NOT NULL,
    lock_count int NOT NULL,
    CONSTRAINT shri_active_rides_listings_pk PRIMARY KEY (arl_id)
) COMMENT 'Store active drivers posts for rides';

-- Table: shri_active_rides_requests
CREATE TABLE shri_active_rides_requests (
    arr_id bigint NOT NULL AUTO_INCREMENT,
    driver_id bigint NOT NULL,
    rider_id bigint NOT NULL,
    arl_id bigint NOT NULL COMMENT 'active_ride_listing',
    seats_requested int NOT NULL,
    rider_status enum('requested','cancelled') NOT NULL DEFAULT 'requested',
    driver_status enum('accepted','pending','cancelled','rejected') NOT NULL DEFAULT 'pending',
    requested_on datetime NOT NULL,
    responded_on datetime NOT NULL,
    source varchar(100) NOT NULL,
    destination varchar(100) NOT NULL,
    cost_of_ride real(10,2) NOT NULL,
    src_state char(50) NOT NULL,
    src_country char(50) NOT NULL,
    src_city char(50) NOT NULL,
    dest_state char(50) NOT NULL,
    dest_city char(50) NOT NULL,
    dest_country char(50) NOT NULL,
    distance varchar(10) NOT NULL,
    landmark varchar(100) NOT NULL,
    request_status enum('finished','pending') NOT NULL,
    CONSTRAINT shri_active_rides_requests_pk PRIMARY KEY (arr_id)
) COMMENT 'Store requests made by riders and display to users and store confirmation of both parties.';

-- Table: shri_administration
CREATE TABLE shri_administration (
    id int NOT NULL,
    email varchar(100) NOT NULL,
    first_name char(30) NOT NULL,
    last_name char(30) NOT NULL,
    mobile bigint NOT NULL,
    password varchar(100) NOT NULL,
    profile_image varchar(100) NOT NULL,
    dob date NOT NULL,
    registered_on datetime NOT NULL,
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    last_login_ip varchar(50) NOT NULL,
    last_login_on datetime NOT NULL,
    CONSTRAINT shri_administration_pk PRIMARY KEY (id)
);

-- Table: shri_driver_cancellation_log
CREATE TABLE shri_driver_cancellation_log (
    dcl_id bigint NOT NULL AUTO_INCREMENT,
    driver_id bigint NOT NULL,
    cancelled_on datetime NOT NULL,
    reason_for_cancellation varchar(50) NOT NULL,
    driver_comments varchar(300) NOT NULL,
    arl_id bigint NOT NULL,
    CONSTRAINT shri_driver_cancellation_log_pk PRIMARY KEY (dcl_id)
) COMMENT 'Rides cancelled by drivers are noted with proper details.';

-- Table: shri_driver_payment_log
CREATE TABLE shri_driver_payment_log (
    dpl_id bigint NOT NULL,
    driver_id bigint NOT NULL,
    transaction_id varchar(50) NOT NULL,
    amount_paid real(10,3) NOT NULL,
    paid_on datetime NOT NULL,
    arr_id bigint NOT NULL,
    CONSTRAINT shri_driver_payment_log_pk PRIMARY KEY (dpl_id)
) COMMENT 'Store details of payments made to the driver.';

-- Table: shri_drivers_profile
CREATE TABLE shri_drivers_profile (
    driver_id bigint NOT NULL,
    user_id bigint NOT NULL,
    vehicle_number varchar(15) NOT NULL,
    vehicle_make_id bigint NOT NULL,
    vehicle_model_id bigint NOT NULL,
    model_year int NOT NULL,
    driver_license_front varchar(200) NOT NULL,
    driver_license_back int NOT NULL,
    is_validated enum('0','1') NOT NULL DEFAULT '0' COMMENT 'is id verified?',
    vehicle_insurance varchar(100) NOT NULL,
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    CONSTRAINT shri_drivers_profile_pk PRIMARY KEY (driver_id)
) COMMENT 'all drivers listed.';

-- Table: shri_drivers_reviews
CREATE TABLE shri_drivers_reviews (
    review_id bigint NOT NULL AUTO_INCREMENT,
    driver_id bigint NOT NULL,
    rider_id bigint NOT NULL,
    rating int NOT NULL,
    comments varchar(300) NOT NULL,
    reviewed_on datetime NOT NULL,
    CONSTRAINT shri_drivers_reviews_pk PRIMARY KEY (review_id)
) COMMENT 'Store driver reviews made by the riders.';

-- Table: shri_drivers_rider_disputes
CREATE TABLE shri_drivers_rider_disputes (
    dispute_id bigint NOT NULL AUTO_INCREMENT,
    driver_id bigint NOT NULL,
    rider_id bigint NOT NULL,
    driver_comments varchar(300) NOT NULL,
    rider_comments varchar(300) NOT NULL,
    arr_id bigint NOT NULL,
    CONSTRAINT shri_drivers_rider_disputes_pk PRIMARY KEY (dispute_id)
);

-- Table: shri_email_templates
CREATE TABLE shri_email_templates (
    template_id bigint NOT NULL,
    email_type varchar(50) NOT NULL,
    contents varchar(10000) NOT NULL,
    `from` varchar(50) NOT NULL,
    reply_to varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    subject varchar(100) NOT NULL,
    CONSTRAINT shri_email_templates_pk PRIMARY KEY (template_id)
);

-- Table: shri_faq
CREATE TABLE shri_faq (
    faq_id int NOT NULL,
    question varchar(200) NOT NULL,
    answer varchar(5000) NOT NULL,
    CONSTRAINT shri_faq_pk PRIMARY KEY (faq_id)
);

-- Table: shri_payment_info
CREATE TABLE shri_payment_info (
    payer_id bigint NOT NULL AUTO_INCREMENT,
    user_id bigint NOT NULL,
    account_id bigint NOT NULL,
    password varchar(100) NOT NULL,
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    is_active enum('0','1') NOT NULL DEFAULT '0',
    registered_on datetime NOT NULL,
    primary_method enum('na','debit','credit','paypal','other') NOT NULL,
    isset_debit_card enum('0','1') NOT NULL DEFAULT '0',
    isset_credit_card enum('0','1') NOT NULL DEFAULT '0',
    isset_paytm enum('0','1') NOT NULL DEFAULT '0',
    CONSTRAINT shri_payment_info_pk PRIMARY KEY (payer_id)
) COMMENT 'Store users payments details.';

CREATE INDEX tbl_payment_info_idx_1 ON shri_payment_info (user_id);

-- Table: shri_pricing
CREATE TABLE shri_pricing (
    pricing_id int NOT NULL AUTO_INCREMENT,
    distance varchar(15) NOT NULL,
    unit enum('kms','miles') NOT NULL DEFAULT 'kms',
    price real(10,3) NOT NULL,
    CONSTRAINT shri_pricing_pk PRIMARY KEY (pricing_id)
) COMMENT 'Store prices for each type.';

-- Table: shri_rider_cancellation_log
CREATE TABLE shri_rider_cancellation_log (
    rcl_id bigint NOT NULL,
    arr_id bigint NOT NULL,
    refund_status enum('na','pending','paid','processing') NOT NULL COMMENT '''''na''''',
    cancelled_on datetime NOT NULL,
    reason varchar(200) NOT NULL,
    rpl_id bigint NOT NULL,
    rrl_id bigint NOT NULL,
    CONSTRAINT shri_rider_cancellation_log_pk PRIMARY KEY (rcl_id)
) COMMENT 'store cancelled requests made by riders from active_ride_requests';

-- Table: shri_riders_payment_log
CREATE TABLE shri_riders_payment_log (
    rpl_id bigint NOT NULL AUTO_INCREMENT,
    rider_id bigint NOT NULL,
    transaction_id varchar(50) NOT NULL,
    amount_paid real(10,3) NOT NULL,
    paid_on datetime NOT NULL,
    arr_id bigint NOT NULL COMMENT 'Refers table active_ride_requests',
    CONSTRAINT shri_riders_payment_log_pk PRIMARY KEY (rpl_id)
) COMMENT 'Store details of payments received from rider.';

-- Table: shri_riders_profile
CREATE TABLE shri_riders_profile (
    rider_id bigint NOT NULL,
    user_id bigint NOT NULL,
    id_proof varchar(200) NOT NULL,
    is_validated enum('0','1') NOT NULL DEFAULT '0',
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    CONSTRAINT shri_riders_profile_pk PRIMARY KEY (rider_id)
) COMMENT 'all riders.';

-- Table: shri_riders_refund_log
CREATE TABLE shri_riders_refund_log (
    rrl_id bigint NOT NULL,
    rider_id bigint NOT NULL,
    amount_refunded real(10,3) NOT NULL,
    transaction_id varchar(50) NOT NULL,
    refunded_on datetime NOT NULL,
    arr_id bigint NOT NULL,
    CONSTRAINT shri_riders_refund_log_pk PRIMARY KEY (rrl_id)
) COMMENT 'Store any refund details';

-- Table: shri_rides_completed_archive
CREATE TABLE shri_rides_completed_archive (
    rca_id bigint NOT NULL,
    arr_id bigint NOT NULL,
    driver_id bigint NOT NULL,
    rider_id bigint NOT NULL,
    completed_on datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    driver_status enum('completed','dispute','resolved') NOT NULL,
    rider_status enum('completed','dispute','resolved') NOT NULL,
    seats_requested int NOT NULL,
    CONSTRAINT shri_rides_completed_archive_pk PRIMARY KEY (rca_id)
) COMMENT 'stores completed rides from active ride requests.';

-- Table: shri_user_authentication
CREATE TABLE shri_user_authentication (
    auth_id bigint NOT NULL AUTO_INCREMENT,
    user_id bigint NOT NULL,
    email_token varchar(50) NOT NULL DEFAULT "",
    otp_token int NOT NULL DEFAULT 0,
    status enum('none','email','otp','both') NOT NULL COMMENT 'Status, 0= none ,2=email,3=otp,5=both',
    validated_on datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT shri_user_authentication_pk PRIMARY KEY (auth_id)
) COMMENT 'Authentication parameters';

-- Table: shri_users
CREATE TABLE shri_users (
    user_id bigint NOT NULL AUTO_INCREMENT,
    first_name char(30) NOT NULL,
    last_name char(30) NOT NULL,
    email varchar(50) NOT NULL,
    mobile bigint NOT NULL,
    city char(50) NOT NULL,
    state char(50) NOT NULL,
    country char(50) NOT NULL,
    profile_image varchar(100) NOT NULL,
    gender enum('male','female') NOT NULL,
    dob date NOT NULL,
    password varchar(100) NOT NULL,
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    registered_on datetime NOT NULL,
    email_verified enum('0','1') NOT NULL DEFAULT '0',
    mobile_verified enum('0','1') NOT NULL DEFAULT '0',
    sign_up_ip varchar(50) NOT NULL,
    last_login_on datetime NOT NULL,
    last_login_ip varchar(50) NOT NULL,
    unique_token varchar(50) NOT NULL,
    CONSTRAINT shri_users_pk PRIMARY KEY (user_id)
) COMMENT 'Stores users information';

-- Table: shri_vehicle_images
CREATE TABLE shri_vehicle_images (
    id bigint NOT NULL,
    driver_id bigint NOT NULL,
    image varchar(100) NOT NULL,
    vehicle_number varchar(15) NOT NULL,
    CONSTRAINT shri_vehicle_images_pk PRIMARY KEY (id)
);

-- Table: shri_vehicle_make
CREATE TABLE shri_vehicle_make (
    make_id bigint NOT NULL AUTO_INCREMENT,
    make varchar(50) NOT NULL,
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    CONSTRAINT shri_vehicle_make_pk PRIMARY KEY (make_id)
) COMMENT 'store all vehicles details';

-- Table: shri_vehicle_model
CREATE TABLE shri_vehicle_model (
    model_id bigint NOT NULL AUTO_INCREMENT,
    make_id bigint NOT NULL,
    model_name varchar(50) NOT NULL,
    specs varchar(100) NOT NULL,
    type varchar(20) NOT NULL,
    is_deleted enum('0','1') NOT NULL DEFAULT '0',
    CONSTRAINT shri_vehicle_model_pk PRIMARY KEY (model_id)
);

-- foreign keys
-- Reference: active_rides_listings_drivers_profile (table: shri_active_rides_listings)
ALTER TABLE shri_active_rides_listings ADD CONSTRAINT active_rides_listings_drivers_profile FOREIGN KEY active_rides_listings_drivers_profile (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: active_rides_requests_active_rides_listings (table: shri_active_rides_requests)
ALTER TABLE shri_active_rides_requests ADD CONSTRAINT active_rides_requests_active_rides_listings FOREIGN KEY active_rides_requests_active_rides_listings (arl_id)
    REFERENCES shri_active_rides_listings (arl_id);

-- Reference: active_rides_requests_drivers_profile (table: shri_active_rides_requests)
ALTER TABLE shri_active_rides_requests ADD CONSTRAINT active_rides_requests_drivers_profile FOREIGN KEY active_rides_requests_drivers_profile (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: active_rides_requests_riders_profile (table: shri_active_rides_requests)
ALTER TABLE shri_active_rides_requests ADD CONSTRAINT active_rides_requests_riders_profile FOREIGN KEY active_rides_requests_riders_profile (rider_id)
    REFERENCES shri_riders_profile (rider_id);

-- Reference: driver_cancellation_log_active_rides_listings (table: shri_driver_cancellation_log)
ALTER TABLE shri_driver_cancellation_log ADD CONSTRAINT driver_cancellation_log_active_rides_listings FOREIGN KEY driver_cancellation_log_active_rides_listings (arl_id)
    REFERENCES shri_active_rides_listings (arl_id);

-- Reference: driver_payment_history_active_rides_requests (table: shri_driver_payment_log)
ALTER TABLE shri_driver_payment_log ADD CONSTRAINT driver_payment_history_active_rides_requests FOREIGN KEY driver_payment_history_active_rides_requests (arr_id)
    REFERENCES shri_active_rides_requests (arr_id);

-- Reference: driver_payment_history_drivers (table: shri_driver_payment_log)
ALTER TABLE shri_driver_payment_log ADD CONSTRAINT driver_payment_history_drivers FOREIGN KEY driver_payment_history_drivers (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: driver_reviews_drivers_profile (table: shri_drivers_reviews)
ALTER TABLE shri_drivers_reviews ADD CONSTRAINT driver_reviews_drivers_profile FOREIGN KEY driver_reviews_drivers_profile (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: driver_reviews_riders_profile (table: shri_drivers_reviews)
ALTER TABLE shri_drivers_reviews ADD CONSTRAINT driver_reviews_riders_profile FOREIGN KEY driver_reviews_riders_profile (rider_id)
    REFERENCES shri_riders_profile (rider_id);

-- Reference: driver_rider_disputes_drivers_profile (table: shri_drivers_rider_disputes)
ALTER TABLE shri_drivers_rider_disputes ADD CONSTRAINT driver_rider_disputes_drivers_profile FOREIGN KEY driver_rider_disputes_drivers_profile (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: driver_rider_disputes_riders_profile (table: shri_drivers_rider_disputes)
ALTER TABLE shri_drivers_rider_disputes ADD CONSTRAINT driver_rider_disputes_riders_profile FOREIGN KEY driver_rider_disputes_riders_profile (rider_id)
    REFERENCES shri_riders_profile (rider_id);

-- Reference: drivers_rider_disputes_active_rides_requests (table: shri_drivers_rider_disputes)
ALTER TABLE shri_drivers_rider_disputes ADD CONSTRAINT drivers_rider_disputes_active_rides_requests FOREIGN KEY drivers_rider_disputes_active_rides_requests (arr_id)
    REFERENCES shri_active_rides_requests (arr_id);

-- Reference: drivers_users (table: shri_drivers_profile)
ALTER TABLE shri_drivers_profile ADD CONSTRAINT drivers_users FOREIGN KEY drivers_users (user_id)
    REFERENCES shri_users (user_id);

-- Reference: payment_info_users (table: shri_payment_info)
ALTER TABLE shri_payment_info ADD CONSTRAINT payment_info_users FOREIGN KEY payment_info_users (user_id)
    REFERENCES shri_users (user_id);

-- Reference: ride_cancellation_history_drivers_profile (table: shri_driver_cancellation_log)
ALTER TABLE shri_driver_cancellation_log ADD CONSTRAINT ride_cancellation_history_drivers_profile FOREIGN KEY ride_cancellation_history_drivers_profile (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: rider_cancellation_log_active_rides_requests (table: shri_rider_cancellation_log)
ALTER TABLE shri_rider_cancellation_log ADD CONSTRAINT rider_cancellation_log_active_rides_requests FOREIGN KEY rider_cancellation_log_active_rides_requests (arr_id)
    REFERENCES shri_active_rides_requests (arr_id);

-- Reference: rider_cancellation_log_riders_payment_log (table: shri_rider_cancellation_log)
ALTER TABLE shri_rider_cancellation_log ADD CONSTRAINT rider_cancellation_log_riders_payment_log FOREIGN KEY rider_cancellation_log_riders_payment_log (rpl_id)
    REFERENCES shri_riders_payment_log (rpl_id);

-- Reference: rider_cancellation_log_riders_refund_log (table: shri_rider_cancellation_log)
ALTER TABLE shri_rider_cancellation_log ADD CONSTRAINT rider_cancellation_log_riders_refund_log FOREIGN KEY rider_cancellation_log_riders_refund_log (rrl_id)
    REFERENCES shri_riders_refund_log (rrl_id);

-- Reference: rider_payment_history_active_rides_requests (table: shri_riders_payment_log)
ALTER TABLE shri_riders_payment_log ADD CONSTRAINT rider_payment_history_active_rides_requests FOREIGN KEY rider_payment_history_active_rides_requests (arr_id)
    REFERENCES shri_active_rides_requests (arr_id);

-- Reference: rider_payment_history_riders_profile (table: shri_riders_payment_log)
ALTER TABLE shri_riders_payment_log ADD CONSTRAINT rider_payment_history_riders_profile FOREIGN KEY rider_payment_history_riders_profile (rider_id)
    REFERENCES shri_riders_profile (rider_id);

-- Reference: rider_refund_history_active_rides_requests (table: shri_riders_refund_log)
ALTER TABLE shri_riders_refund_log ADD CONSTRAINT rider_refund_history_active_rides_requests FOREIGN KEY rider_refund_history_active_rides_requests (arr_id)
    REFERENCES shri_active_rides_requests (arr_id);

-- Reference: rider_refund_history_riders_profile (table: shri_riders_refund_log)
ALTER TABLE shri_riders_refund_log ADD CONSTRAINT rider_refund_history_riders_profile FOREIGN KEY rider_refund_history_riders_profile (rider_id)
    REFERENCES shri_riders_profile (rider_id);

-- Reference: riders_users (table: shri_riders_profile)
ALTER TABLE shri_riders_profile ADD CONSTRAINT riders_users FOREIGN KEY riders_users (user_id)
    REFERENCES shri_users (user_id);

-- Reference: rides_completed_archive_active_rides_requests (table: shri_rides_completed_archive)
ALTER TABLE shri_rides_completed_archive ADD CONSTRAINT rides_completed_archive_active_rides_requests FOREIGN KEY rides_completed_archive_active_rides_requests (arr_id)
    REFERENCES shri_active_rides_requests (arr_id);

-- Reference: shri_vehicle_insurance_shri_drivers_profile (table: shri_vehicle_images)
ALTER TABLE shri_vehicle_images ADD CONSTRAINT shri_vehicle_insurance_shri_drivers_profile FOREIGN KEY shri_vehicle_insurance_shri_drivers_profile (driver_id)
    REFERENCES shri_drivers_profile (driver_id);

-- Reference: shri_vehicle_model_shri_vehicle_make (table: shri_vehicle_model)
ALTER TABLE shri_vehicle_model ADD CONSTRAINT shri_vehicle_model_shri_vehicle_make FOREIGN KEY shri_vehicle_model_shri_vehicle_make (make_id)
    REFERENCES shri_vehicle_make (make_id);

-- Reference: user_authentication_users (table: shri_user_authentication)
ALTER TABLE shri_user_authentication ADD CONSTRAINT user_authentication_users FOREIGN KEY user_authentication_users (user_id)
    REFERENCES shri_users (user_id);

-- End of file.

