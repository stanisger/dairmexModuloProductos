CREATE DATABASE dairmexc_crm_db;
use dairmexc_crm_db;

#-- phpMyAdmin SQL Dump
#-- version 4.7.7
#-- https://www.phpmyadmin.net/
--
#-- Servidor: localhost:3306
#-- Tiempo de generación: 18-11-2018 a las 19:17:08
#-- Versión del servidor: 10.1.35-MariaDB-cll-lve
#-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `productos` (
  `id_producto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `medida` int(10) unsigned NOT NULL,
  `unidad_medida` varchar(10) NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

-- 
-- Se cambia el campo de medida para que acepte cadenas de texto.
-- 
-- Autor: Ricardo Bermúdez Bermúdez
-- Fecha: 12 de Febrero del 2019
alter table productos
change medida medida varchar(100) NOT NULL;

CREATE TABLE `proveedores` (
  `id_proveedor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;

CREATE TABLE `precios_de_proveedores` (
  `id_precio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_producto` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `precio_por_unidad` int(10) unsigned NOT NULL,
  `unidad_precio` varchar(10) NOT NULL,
  PRIMARY KEY (`id_precio`),
  KEY `precios_de_productos` (`id_producto`),
  KEY `proveedores_de_productos` (`id_proveedor`),
  CONSTRAINT `precios_de_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proveedores_de_productos` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

CREATE TABLE `detalle_requisicion` (
  `id` int(11) NOT NULL,
  `articulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `medida` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `proyecto` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `folio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `requesicion_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `fecha_estatus` datetime NOT NULL,
  `fecha_entrega` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `requisicion` (
  `id` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `estatus_req` int(11) NOT NULL DEFAULT '0',
  `fecha_estatus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `perfil` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apaterno` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `empresa` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `registro` date NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `detalle_requisicion`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `requisicion`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `detalle_requisicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3807;

ALTER TABLE `requisicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=633;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

create user dairmexc_crm_usr@localhost identified by 'oa+_9_tF!a~@';
grant all privileges on dairmexc_crm_db.* to dairmexc_crm_usr@localhost;
