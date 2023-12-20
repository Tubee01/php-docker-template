DROP DATABASE IF EXISTS master;


CREATE DATABASE master;
\c master
CREATE TABLE Urak
(
   id serial PRIMARY KEY,
   name varchar(255) NOT NULL,
   description varchar(255) NULL,
   created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP

);

INSERT INTO Urak
   (name, description)
VALUES
   ('uram','Árvíztűrő tükörfúrógép')