USE ohtu;

CREATE TABLE viite
(
id serial primary key,
author text,
year text,
name text,
key text,
type text
);

CREATE TABLE lisatieto
(
dataid serial primary key,
type text,
data text
);

CREATE TABLE tiedot
(
id integer references viite(id),
dataid integer references lisatieto(dataid)
);
