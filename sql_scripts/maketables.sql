CREATE DATABASE IF NOT EXISTS s2883992_web_project;
USE s2883992_web_project;

# queries table for unique query combinations (protein and taxon)
CREATE TABLE `queries` (
`query_id` INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
`protein_family` VARCHAR(255) NOT NULL,
`taxon` VARCHAR(255) NOT NULL,
`query_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`is_example` TINYINT(1) NOT NULL DEFAULT 0, # for example set retrieval
CONSTRAINT `full_query` UNIQUE (`protein_family`, `taxon`) # unique constraint for protein-taxon combination
);

# sequences table for storing unique sequences once
CREATE TABLE `sequences` (
`accession` VARCHAR(255) NOT NULL,
`organism` VARCHAR(255) NOT NULL, 
`sequence` LONGTEXT NOT NULL, 
PRIMARY KEY(`accession`)
); 
 
# mapping table for queries and sequences
CREATE TABLE `seq_group` (
`query_id` INT UNSIGNED NOT NULL,
`seq_id` VARCHAR(255) NOT NULL,
PRIMARY KEY (`query_id`, `seq_id`), # unique combinations of query and sequence, for sequences in multiple queries
FOREIGN KEY (`query_id`) REFERENCES `queries`(`query_id`) ON DELETE CASCADE, # link to queries table
FOREIGN KEY (`seq_id`) REFERENCES `sequences`(`accession`) ON DELETE CASCADE # link to sequences table
);

# table for connecting users and queries
CREATE TABLE `jobs` (
`job_id` INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
`user_id` VARCHAR(255) NOT NULL,
`query_id` INT UNSIGNED NOT NULL,
`job_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`status` ENUM('pending', 'complete', 'error') DEFAULT 'pending',
FOREIGN KEY (`query_id`) REFERENCES `queries`(`query_id`) ON DELETE CASCADE
);

