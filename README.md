# Protein Conservation Analysis Website

## Overview

This repository contains the scripts used to create a protein conservation analysis website interface as part of the Introduction to Website and Database Design at the University of Edinburgh (https://bioinfmsc8.bio.ed.ac.uk/~s2883992/website/front).
The website allows users to test the conservation level of a family of related proteins within a certain taxonomic group, using publicly available tools (sequences from NCBI, multiple sequence alignment with ClustalO, conservation plot with plotcon and motif searching against PROSITE with patmatmotifs).

**Required software:** PHP · Python · MySQL · JavaScript (AJAX) · EMBOSS suite

---

## Directory and File Descriptions

### `py_scripts/`

Python processing scripts of the retrieved data from public databases. The scripts simplify the data and allow working with it in backend server settings.

Also included is **`full_process.txt`**, which provides an ordered record of all commands run throughout the analysis pipeline.

### `sql_scripts/`

The SQL script used to create the database. Includes the table design with relevant constraints and indexing.

### `images/`

Images included in the website pages.

### Other scripts

The rest of the scripts are the PHP processing scripts responsible for the website design.

Main pages include:
* **front.php** - landing page with site overview and navigation
* **query.php** - form for entering taxon, protein family, and analysis options (form validation with JavaScript)
* **loading_page.php** - creates a pending job and waits for processing to finish (automatic refresh, polling job status)
* **results.php** - wrapper page for presenting completed results
* **example.php** - explanatory page for a precomputed example dataset
* **previous_results.php** - lists previous jobs associated with the current browser
* **help_page.php** - user-facing help and interpretation guide
* **about.php** - developer-oriented help page
* **credit.php** - statement of credits and sources used in creating the site
* **not_found.php** - custom 404 page

Background scripts include:
* **set_cookies.php** - creates and hashes the browser‑level cookie used for job ownership
* **process_query.php** - CLI worker that processes a job by job ID (runs python scripts, loads results to MySQL)
* **results_content.php** - results rendering script used by results and example pages (queries database, displays results on page with HTML and JavaScript)
* **get_output.php** - returns stored output files (MSA and plotcon) for display or download (forced header download)
* **alignment_ajax.php** - returns alignment overview data as JSON for interactive tables in results_content.php
* **motif_ajax.php** - returns motif overview data as JSON for interactive tables in results_content.php
* **download_alignment_ajax.php** - exports filtered alignment tables as TSV (alignment_ajax.php with forced header download)
* **download_motif_ajax.php** - exports filtered motif tables as TSV (motif_ajax.php with forced header download)
* **download_motif_hits.php** - exports total motif-hit summary as TSV (forced header download)

Additional files:
* **.htaccess** - used to present clean URLs
* **styles.css** - website stylesheet
* **cookies.html** - cookies banner design
* **inserting_example.php** - test script to insert example sequences into the underlying database
* **menuf.php** - main menu setup script
