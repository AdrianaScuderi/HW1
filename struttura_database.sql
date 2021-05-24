create database gestionecentrobellezza;

create table PERSONALE(
id integer auto_increment primary key,
nome varchar(255),
cognome varchar(255),
ruolo varchar(255),
immagine varchar(255),
numero_qualifiche integer
)Engine='Innodb';

create table TRATTAMENTO(
immagine varchar(255),
nome varchar(255) primary key,
costo integer,
descrizione varchar(255)
) Engine='Innodb';

create table CLIENTE(
nome varchar(255),
cognome varchar(255),
email varchar(255) primary key,
password varchar(255),
data_nascita date
) Engine='Innodb';

create table EFFETTUA(
codice_prenotazione integer auto_increment primary key,
data_iniziale datetime,
email_cliente varchar(255),
nome_trattamento varchar(255),
data_finale datetime default NULL,
index idx_ec(email_cliente),
index idx_nt(nome_trattamento),
foreign key (email_cliente) references CLIENTE(email),
foreign key (nome_trattamento) references TRATTAMENTO(nome),
unique (data_iniziale, email_cliente, nome_trattamento)
) Engine='Innodb';

create table QUALIFICA(
id integer primary key,
nome varchar(255)
) Engine='Innodb';

create table ACQUISIZIONE_QUALIFICA (
id_competenza integer,
id_personale integer,
data_acquisizione date,
index idx_c(id_competenza),
index idx_pers(id_personale),
foreign key (id_competenza) references QUALIFICA(id),
foreign key (id_personale) references PERSONALE(id),
primary key (id_competenza, id_personale)
) Engine='Innodb';

create table PRODOTTI_SALVATI (
email_cliente varchar(255),
immagine varchar(255),
nome varchar(255) primary key,
index idx_email(email_cliente),
foreign key (email_cliente) references CLIENTE(email)
) Engine = 'Innodb';

-- DATI
insert into PERSONALE values(1, 'Maria', 'Vita', 'Parrucchiere', 'images/maria.jpg', 0);
insert into PERSONALE values(2, 'Raffaella', 'Bini','Estetista', 'images/raffaella.jpg', 0);
insert into PERSONALE values(3, 'Angela', 'Trichi','Parrucchiera', 'images/angela.jpg', 0);
insert into PERSONALE values(4, 'Marco', 'Carta','Parrucchiere', 'images/marco.jpg', 0);
insert into PERSONALE values(5, 'Federico', 'Sinatra','Massaggiatore', 'images/federico.jpg', 0);
insert into PERSONALE values(6, 'Melania', 'Genta','Onicotecnica', 'images/melania.jpg', 0);
insert into PERSONALE values(7, 'Martina', 'Cervi','Estetista', 'images/martina.jpg', 0);

insert into TRATTAMENTO values('img/ceretta.jpg', 'Ceretta', 20, 'Servizio Estetica');
insert into TRATTAMENTO values('img/microblading.jpg', 'Microblading', 100, 'Servizio Estetica');
insert into TRATTAMENTO values('img/taglio.jpg', 'Taglio', 35, 'Servizio Parrucchiere');
insert into TRATTAMENTO values('img/piega.jpg', 'Piega', 20, 'Servizio Parrucchiere');
insert into TRATTAMENTO values('img/colore.jpg', 'Colore', 20, 'Servizio Parrucchiere');
insert into TRATTAMENTO values('img/semi.jpg', 'Semipermanente', 20, 'Servizio Onicotecnica');
insert into TRATTAMENTO values('img/gel.jpg', 'Allungamento gel', 30, 'Servizio Onicotecnica');
insert into TRATTAMENTO values('img/acri.jpg', 'Allungamento acrilico', 30, 'Servizio Onicotecnica');
insert into TRATTAMENTO values('img/shiatsu.jpg', 'Massaggio shiatsu', 50, 'Servizio Massaggio');
insert into TRATTAMENTO values('img/stone.jpg', 'Massaggio hot stone', 60, 'Servizio Massaggio');

insert into CLIENTE values ('Agata', 'Rosselli', 'agata.rosselli@gmail.com', 'ciao12345', '1999-06-06');


insert into EFFETTUA values(1,'2020-12-11 10:00:00.000','agata.rosselli@gmail.com','Semipermanente','2020-12-11 11:00:00.000');

insert into QUALIFICA values(1, 'Parrucchiere corso base');
insert into QUALIFICA values(2, 'Onicotecnico corso base');
insert into QUALIFICA values(3, 'Estetista corso base');
insert into QUALIFICA values(4, 'Massaggiatore corso base');
insert into QUALIFICA values(5, 'Massaggiatore sportivo');
insert into QUALIFICA values(6, 'Massaggiatore riflessologia plantare');
insert into QUALIFICA values(7, 'Parrucchiere taglio uomo');
insert into QUALIFICA values(8, 'Parrucchiere colorista');
insert into QUALIFICA values(10, 'Parrucchiere acconciature sposa');
insert into QUALIFICA values(9, 'Onicotecnico micropittura');
insert into QUALIFICA values(11, 'Estetista microblanding');


-- prima devo attivare il trigger per aggiornare il numero_qualifiche
delimiter //
create trigger aggiorno_n_qualifiche
after insert on acquisizione_qualifica
for each row
begin
    if exists (select * from personale where id=new.id_personale)
    then update personale set numero_qualifiche=numero_qualifiche+1
                          where id=new.id_personale;
    end if;
end //
delimiter ;

insert into ACQUISIZIONE_QUALIFICA values(1,1,'1998-12-02');
insert into ACQUISIZIONE_QUALIFICA values(7,1,'1999-04-08');
insert into ACQUISIZIONE_QUALIFICA values(8,1,'1999-12-12');
insert into ACQUISIZIONE_QUALIFICA values(3,2,'2000-08-02');
insert into ACQUISIZIONE_QUALIFICA values(11,2,'2000-09-12');
insert into ACQUISIZIONE_QUALIFICA values(1,3,'1998-12-02');
insert into ACQUISIZIONE_QUALIFICA values(1,4,'2004-07-12');
insert into ACQUISIZIONE_QUALIFICA values(8,4,'2004-09-01');
insert into ACQUISIZIONE_QUALIFICA values(4 , 5,'2010-11-24');
insert into ACQUISIZIONE_QUALIFICA values(5,5,'2010-12-05');
insert into ACQUISIZIONE_QUALIFICA values(2,6,'2009-02-23');
insert into ACQUISIZIONE_QUALIFICA values(9,6,'2009-07-12');
insert into ACQUISIZIONE_QUALIFICA values(7,4,'2004-09-02');
insert into ACQUISIZIONE_QUALIFICA values(10,4,'2004-09-03');
insert into ACQUISIZIONE_QUALIFICA values(3,7,'2000-09-03');


