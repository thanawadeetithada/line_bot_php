﻿# phonenumber_php

SQL
phpMyAdmin SQL Dump
version 5.2.1
https://www.phpmyadmin.net/
Server version: 10.4.32-MariaDB
PHP Version: 8.2.12

# PhoneNumber Management System

This project is a **PhoneNumber Management System** built using **PHP**, **MariaDB**, and **phpMyAdmin**. It allows users to manage phone numbers, categories, and tags, with user roles and access management.

## Database Schema

The database consists of three main tables: `phonenumber`, `total_category`, `total_tag`, and `users_collection`. Below is the SQL schema for setting up the database.

---

### Database: `phonenumber`

#### **`phonenumber` Table**
This table stores the phone numbers and related data.

```sql
CREATE TABLE `users_collection` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isShowManagement` tinyint(1) DEFAULT 0,
  `isShowData` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
);

ALTER TABLE `users_collection`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

ALTER TABLE `users_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

#   l i n e _ b o t _ p h p 
 
 
