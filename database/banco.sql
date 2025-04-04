CREATE TABLE tasktask (
    id SERIAL PRIMARY KEY,
    description VARCHAR(50) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    date_limit DATE,
    status INT
);

CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    user_email VARCHAR(50),
    user_password VARCHAR(50) NOT NULL
);
