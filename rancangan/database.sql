/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     14/11/2023 21:03:23                          */
/*==============================================================*/


drop table if exists KARYAWAN;

drop table if exists KATEGORI;

drop table if exists KERANJANG;

drop table if exists MAKANAN;

drop table if exists METODE_BAYAR;

drop table if exists PELANGGAN;

drop table if exists ROLE;

drop table if exists SUPPLIER;

drop table if exists TRANSAKSI;

drop table if exists TRANSAKSI_DETAIL;

/*==============================================================*/
/* Table: KARYAWAN                                              */
/*==============================================================*/
create table KARYAWAN
(
   ID_KARYAWAN          int not null,
   ID_ROLE              int,
   USERNAME_KARYAWAN    varchar(30) not null,
   PASSWORD_KARYAWAN    varchar(255) not null,
   NAMA_KARYAWAN        varchar(100) not null,
   NO_TELP_KARYAWAN     varchar(15) not null,
   primary key (ID_KARYAWAN)
);

/*==============================================================*/
/* Table: KATEGORI                                              */
/*==============================================================*/
create table KATEGORI
(
   KODE_KATERGORI       int not null,
   NAMA_KATEGORI        varchar(100) not null,
   primary key (KODE_KATERGORI)
);

/*==============================================================*/
/* Table: KERANJANG                                             */
/*==============================================================*/
create table KERANJANG
(
   KODE_PELANGGAN       int not null,
   KODE_MAKANAN         int not null,
   QTY                  int not null,
   STATUS_K             int not null,
   CREATED_AT_K         timestamp,
   UPDATED_AT_K         timestamp,
   primary key (KODE_PELANGGAN, KODE_MAKANAN)
);

/*==============================================================*/
/* Table: MAKANAN                                               */
/*==============================================================*/
create table MAKANAN
(
   KODE_MAKANAN         int not null,
   ID_SUPPLIER          int,
   KODE_KATERGORI       int,
   NAMA_MAKANAN         varchar(100) not null,
   GAMBAR_MAKANAN       varchar(255) not null,
   HARGA_MAKANAN        int not null,
   STOK_PRODUK          int not null,
   CREATED_AT_M         timestamp,
   UPDATED_AT_M         timestamp,
   primary key (KODE_MAKANAN)
);

/*==============================================================*/
/* Table: METODE_BAYAR                                          */
/*==============================================================*/
create table METODE_BAYAR
(
   ID_METODE            int not null,
   KODE_PELANGGAN       int,
   NAMA_METODE          varchar(20) not null,
   NO_REKENING          varchar(25),
   primary key (ID_METODE)
);

/*==============================================================*/
/* Table: PELANGGAN                                             */
/*==============================================================*/
create table PELANGGAN
(
   KODE_PELANGGAN       int not null,
   USERNAME_PELANGGAN   varchar(30) not null,
   PASSWORD_PELANGGAN   varchar(30) not null,
   NAMA_PELANGGAN       varchar(50) not null,
   NO_TELP_PELANGGAN    varchar(15) not null,
   ALAMAT_PELANGGAN     text not null,
   JENIS_KELAMIN        national varchar(255) not null,
   primary key (KODE_PELANGGAN)
);

/*==============================================================*/
/* Table: ROLE                                                  */
/*==============================================================*/
create table ROLE
(
   ID_ROLE              int not null,
   NAMA_ROLE            varchar(20) not null,
   primary key (ID_ROLE)
);

/*==============================================================*/
/* Table: SUPPLIER                                              */
/*==============================================================*/
create table SUPPLIER
(
   ID_SUPPLIER          int not null,
   NAMA_SUPPLIER        varchar(100) not null,
   NO_TELP_SUPPLIER     varchar(15) not null,
   ALAMAT_SUPPLIER      text,
   primary key (ID_SUPPLIER)
);

/*==============================================================*/
/* Table: TRANSAKSI                                             */
/*==============================================================*/
create table TRANSAKSI
(
   KODE_TRANSAKSI       int not null,
   KODE_PELANGGAN       int,
   TANGGAL_PESAN        datetime not null,
   TOTAL                int not null,
   STATUS               int not null,
   WAKTU_BAYAR          datetime,
   primary key (KODE_TRANSAKSI)
);

/*==============================================================*/
/* Table: TRANSAKSI_DETAIL                                      */
/*==============================================================*/
create table TRANSAKSI_DETAIL
(
   KODE_TRANSAKSI       int not null,
   KODE_MAKANAN         int not null,
   HARGA_MAKANAN        int not null,
   QTY                  int not null,
   primary key (KODE_TRANSAKSI, KODE_MAKANAN)
);

alter table KARYAWAN add constraint FK_MEMILIKI5 foreign key (ID_ROLE)
      references ROLE (ID_ROLE) on delete restrict on update restrict;

alter table KERANJANG add constraint FK_MEMPUNYAI foreign key (KODE_PELANGGAN)
      references PELANGGAN (KODE_PELANGGAN) on delete restrict on update restrict;

alter table KERANJANG add constraint FK_MEMPUNYAI5 foreign key (KODE_MAKANAN)
      references MAKANAN (KODE_MAKANAN) on delete restrict on update restrict;

alter table MAKANAN add constraint FK_BERISI foreign key (KODE_KATERGORI)
      references KATEGORI (KODE_KATERGORI) on delete restrict on update restrict;

alter table MAKANAN add constraint FK_MENYEDIAKAN foreign key (ID_SUPPLIER)
      references SUPPLIER (ID_SUPPLIER) on delete restrict on update restrict;

alter table METODE_BAYAR add constraint FK_MEMPUNYAI9 foreign key (KODE_PELANGGAN)
      references PELANGGAN (KODE_PELANGGAN) on delete restrict on update restrict;

alter table TRANSAKSI add constraint FK_MELAKUKAN foreign key (KODE_PELANGGAN)
      references PELANGGAN (KODE_PELANGGAN) on delete restrict on update restrict;

alter table TRANSAKSI_DETAIL add constraint FK_MEMILIKI2 foreign key (KODE_TRANSAKSI)
      references TRANSAKSI (KODE_TRANSAKSI) on delete restrict on update restrict;

alter table TRANSAKSI_DETAIL add constraint FK_TERDAPAT foreign key (KODE_MAKANAN)
      references MAKANAN (KODE_MAKANAN) on delete restrict on update restrict;

