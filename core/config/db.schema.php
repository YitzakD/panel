<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	utypes	->	Accès disponible dans l'APP
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`utypes` ( `id` INT NOT NULL AUTO_INCREMENT , `utype_name` VARCHAR(225) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`utype_name`)) ENGINE = InnoDB COMMENT = 'Accès disponible dans l\'APP';

	/**Modifications #*/
	---

	/**Remplisage #*/
	INSERT INTO `utypes` (`id`, `utype_name`) VALUES (NULL, 'SUPER'), (NULL, 'ADMINISTRATEUR'), (NULL, 'MANAGER'), (NULL, 'AGENT');






#	auth_tokens	->	Tokens de récupération de sessions
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`auth_tokens` ( `id` INT NOT NULL AUTO_INCREMENT , `expires` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `selector` VARCHAR(225) NOT NULL , `uid` INT NOT NULL , `token` VARCHAR(225) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Tokens de récupération de sessions';

	/**Modification #*/
	---





#	users 	->	Stock les utilisateurs
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `pseudo` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(225) NOT NULL , `utid` ENUM('1','2','3','4') NOT NULL , `active` ENUM('0','1') NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB COMMENT = 'Stock les utilisateurs';

	/**Modifications #*/
	---





#	activities   ->		Stock les activités sur l'APP
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`activities` ( `id` INT NOT NULL AUTO_INCREMENT , `uid` INT NOT NULL , `field` VARCHAR(225) NOT NULL , `title` VARCHAR(225) NOT NULL , `activity` TEXT NOT NULL , `created_year` YEAR NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les activités sur l\'APP';

	/**Modifications #*/
	---





#	clients   ->	Stock les clients
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`clients` ( `id` INT NOT NULL AUTO_INCREMENT , `e_name` VARCHAR(225) NOT NULL , `c_name` VARCHAR(225) NOT NULL , `a_mail` VARCHAR(225) NOT NULL , `contacts` VARCHAR(225) NOT NULL , `bp` VARCHAR(225) NOT NULL , `cc` VARCHAR(225) NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE (`e_name`)) ENGINE = InnoDB COMMENT = 'Stock les clients';

	/**Modifications #*/
	ALTER TABLE `clients` ADD `type` ENUM('RP','AC','IP','II','AP') NOT NULL AFTER `cc`;
	---





#	zones   ->	Stock les zones
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`zones` ( `id` INT NOT NULL AUTO_INCREMENT , `zone_title` VARCHAR(225) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`zone_title`)) ENGINE = InnoDB COMMENT = 'Stock les zones';

	/**Modifications #*/
	---





#	cities   ->	Stock les villes
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`cities` ( `id` INT NOT NULL AUTO_INCREMENT , `zid` INT NOT NULL , `city_title` VARCHAR(225) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`city_title`)) ENGINE = InnoDB COMMENT = 'Stock les villes';

	/**Modifications #*/
	---





#	cmunes   ->	Stock les communes
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`cmunes` ( `id` INT NOT NULL AUTO_INCREMENT , `zid` INT NOT NULL , `vid` INT NOT NULL , `cmune_title` VARCHAR(225) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`cmune_title`)) ENGINE = InnoDB COMMENT = 'Stock les communes';

	/**Modifications #*/
	---





#	sizes   ->	Stock les formats en m²
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`sizes` ( `id` INT NOT NULL AUTO_INCREMENT , `size` INT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`size`)) ENGINE = InnoDB COMMENT = 'Stock les formats en m²';

	/**Modifications #*/
	---





#	signboards   ->	Stock les panneaux
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`signboards` ( `id` INT NOT NULL AUTO_INCREMENT , `nbr` INT NOT NULL , `zone` INT NOT NULL , `ville` INT NOT NULL , `cmune` INT NOT NULL , `size` INT NOT NULL , `geoloc` VARCHAR(225) NOT NULL , `file_road` VARCHAR(225) NOT NULL , `etat` ENUM('ras','en reparation','accidente','coupe') NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE (`nbr`)) ENGINE = InnoDB COMMENT = 'Stock les panneaux';

	/**Modifications #*/
	ALTER TABLE `signboards` ADD `file_road_sm` VARCHAR(225) NOT NULL AFTER `file_road`;
	ALTER TABLE `signboards` ADD `filename` VARCHAR(225) NOT NULL AFTER `geoloc`;
	---





#	signboards   ->	Stock les employés
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`employees` ( `id` INT NOT NULL AUTO_INCREMENT , `matr` VARCHAR(10) NOT NULL , `emp_names` VARCHAR(225) NOT NULL , `emb_date` DATE NOT NULL , `contract_type` ENUM('CDD', 'CDI', 'FREELANCE') NOT NULL , `occ_poste` VARCHAR(225) NOT NULL , `salary` INT NOT NULL , `dev_mail` VARCHAR(225) NOT NULL , `add_phone` VARCHAR(225) NOT NULL , `others_infos` TEXT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE (`matr`)) ENGINE = InnoDB COMMENT = 'Stock les employés';

	/**Modifications #*/
	---





#	init_caisse   ->	Initialise le mois pour la caisse
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_caisse` ( `id` INT NOT NULL AUTO_INCREMENT , `month_id` VARCHAR(10) NOT NULL , `month` INT NOT NULL , `year` INT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`month_id`)) ENGINE = InnoDB COMMENT = 'Initialise le mois pour la caisse';

	/**Modifications #*/
	---





#	caisse   ->		Stock les opérations de la caisse
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`caisse` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `month_id` VARCHAR(10) NOT NULL , `day` INT NOT NULL , `typeof` ENUM('1','2') NOT NULL , `amount` INT NOT NULL , `description` TEXT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les opérations de la caisse';

	/**Modifications #*/
	---





#	point_caisse   ->		Stock les points de la caisse
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`point_caisse` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `mo_new_solde` INT NOT NULL , `mo_in` INT NOT NULL , `mo_out` INT NOT NULL , `mo_solde` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les points de la caisse';

	/**Modifications #*/
	---





#	providers   ->		Stock les fourisseurs
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`providers` ( `id` INT NOT NULL AUTO_INCREMENT , `p_name` VARCHAR(225) NOT NULL , `c_name` VARCHAR(225) NOT NULL , `p_mail` VARCHAR(225) NOT NULL , `contacts` VARCHAR(225) NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE (`p_name`)) ENGINE = InnoDB COMMENT = 'Stock les fournisseurs';

	/**Modifications #*/
	ALTER TABLE `providers` ADD `type` ENUM('RP','AC','AP') NOT NULL AFTER `contacts`;
	---





#	bc   ->		Stock les commandes
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`bc` ( `id` INT NOT NULL AUTO_INCREMENT , `bc_id` INT NOT NULL , `f_id` INT NOT NULL , `description` TEXT NOT NULL , `dating` VARCHAR(225) NOT NULL , `qte` INT NOT NULL , `pu` INT NOT NULL , `ht` INT NOT NULL , `transport` INT NOT NULL , `odp` INT NOT NULL , `tm` INT NOT NULL , `tva` INT NOT NULL , `tsp` INT NOT NULL , `other_tax` VARCHAR(225) NOT NULL , `other_tax_name` VARCHAR(225) NOT NULL , `other_tax_amount` INT NOT NULL , `ttc` INT NOT NULL , `state` ENUM('Non','Oui') NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les commandes';

	/**Modifications #*/
	---





#	init_deposit   ->		Initialise les paiements de commande
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_deposit` ( `id` INT NOT NULL AUTO_INCREMENT , `f_id` INT NOT NULL , `bc_id` INT NOT NULL , `ttc` INT NOT NULL , `tac` INT NOT NULL , `rap` INT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Initialise les paiements de commande';

	/**Modifications #*/
	---





#	deposit   ->		Stock les déclarations de paiement de commande
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`deposit` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `bc_id` INT NOT NULL , `deposit_amount` INT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les déclaration de paiement de commande';

	/**Modifications #*/
	---





#	pformas   ->		Stock les proformas
	/**Création #*/
	CREATE TABLE `pformas` (`id` int(11) NOT NULL AUTO_INCREMENT, `pf_id` int(11) NOT NULL, `client_id` int(11) NOT NULL, `sb_size` int(11) NOT NULL, `screen_type` varchar(225) NOT NULL, `letter_time` varchar(225) NOT NULL, `numeric_time` int(11) NOT NULL, `nb_month` int(11) NOT NULL, `debut` date NOT NULL, `fin` date NOT NULL, `one_ht_price` int(11) NOT NULL, `sb_count` int(11) NOT NULL, `sb_p_count` int(11) NOT NULL, `remised` enum('Oui','Non') NOT NULL, `one_stoped_price` int(11) NOT NULL, `ht_price` int(11) NOT NULL, `agency_remised` enum('Non','Oui') NOT NULL, `agency_remised_ht_price` int(11) NOT NULL, `int_city_count` int(11) NOT NULL, `transport_price` int(11) NOT NULL, `alcool_type` enum('Non','Oui') NOT NULL, `tm_alcool_amount` int(11) NOT NULL, `odp` enum('Oui','Non') NOT NULL, `odp_amount` int(11) NOT NULL, `odp_p_amount` int(11) NOT NULL, `tm` enum('Oui','Non') NOT NULL, `tm_amount` int(11) NOT NULL, `agree_tva` enum('Oui','Non') NOT NULL, `tva` int(11) NOT NULL, `tsp` int(11) NOT NULL, `numeric_ttc_price` int(11) NOT NULL, `letter_ttc_price` varchar(550) NOT NULL, `state` enum('Non','Oui') NOT NULL, `created` datetime NOT NULL , PRIMARY KEY (`id`), UNIQUE (`pf_id`)) ENGINE = InnoDB COMMENT = 'Stock les proformas';

	/**Modifications #*/
	ALTER TABLE `pformas` CHANGE `state` `state` ENUM('Non','Attente','Oui') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
	---





#	notifications   ->		Stock les notifications
	/**Création #*/
	CREATE TABLE `notifications` (`id` int(11) NOT NULL AUTO_INCREMENT, `type` enum('S','H') NOT NULL, `description` text NOT NULL, `starter_id` int(11) NOT NULL, `dest` int(11) NOT NULL, `link` text NOT NULL, `state` enum('on','off') NOT NULL, `created` datetime NOT NULL , PRIMARY KEY (`id`)) ENGINE=InnoDB COMMENT = 'Stock les notifications';

	/**Modifications #*/
	---





#	notifications   ->		Stock les factures
	/**Création #*/
	CREATE TABLE `bills` (`id` int(11) NOT NULL AUTO_INCREMENT, `pf_id` int(11) NOT NULL, `p_id` int(11) NOT NULL, `client_id` int(11) NOT NULL, `sb_size` int(11) NOT NULL, `nb_month` int(11) NOT NULL, `debut` date NOT NULL, `fin` date NOT NULL, `agency_remised_ht_price` int(11) NOT NULL, `odp_amount` int(11) NOT NULL, `odp_p_amount` int(11) NOT NULL, `tm_amount` int(11) NOT NULL, `tva` int(11) NOT NULL, `tsp` int(11) NOT NULL, `numeric_ttc_price` int(11) NOT NULL, `created` datetime NOT NULL , PRIMARY KEY (`id`), UNIQUE (`pf_id`)) ENGINE = InnoDB COMMENT = 'Stock les factures';

	/**Modifications #*/
	---





#	init_payement   ->		Initialise les paiements reçues sur les factures
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_payement` ( `id` INT NOT NULL AUTO_INCREMENT , `client_id` INT NOT NULL , `pf_id` INT NOT NULL , `ttc` INT NOT NULL , `tac` INT NOT NULL , `rap` INT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Initialise les paiements reçues sur les factures';

	/**Modifications #*/
	---





#	payements   ->		Stock les déclarations de paiement reçus de factures
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`payements` ( `id` INT NOT NULL AUTO_INCREMENT , `statement_id` INT NOT NULL , `pf_id` INT NOT NULL , `payed_amount` INT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les déclarations de paiement reçus de factures';

	/**Modifications #*/
	---





#	init_rsv   ->		Initialise les réservations
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_rsv` ( `id` INT NOT NULL AUTO_INCREMENT , `client_id` INT NOT NULL , `camp_name` VARCHAR(225) NOT NULL , `debut` DATE NOT NULL , `fin` DATE NOT NULL , `etat` ENUM('En attente','En cours','En pause','Closed') NOT NULL , `created` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Initialise les reservations';

	/**Modifications #*/
	---





#	rsv   ->		Stock les panneaux réserver
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`rsv` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `nbr` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les panneaux réserver';

	/**Modifications #*/
	---





#	init_camp   ->		Initialise les campagnes
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_camp` ( `id` INT NOT NULL AUTO_INCREMENT , `init_rid` INT NOT NULL , `client_id` INT NOT NULL , `camp_name` VARCHAR(225) NOT NULL , `debut` DATE NOT NULL , `fin` DATE NOT NULL , `created` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Initialise les campagnes';

	/**Modifications #*/
	---





#	camps   ->		Stock les panneaux en campagne
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`camps` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `init_rid` INT NOT NULL , `nbr` INT NOT NULL , `debut` DATE NOT NULL , `fin` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les panneaux en campagne';

	/**Modifications #*/
	---





#	uprefs   ->		Stock les préférences des utilisateurs
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`uprefs` ( `id` INT NOT NULL AUTO_INCREMENT , `uid` INT NOT NULL , `menumode` ENUM('W','M') NOT NULL , `stylemode` ENUM('C','D') NOT NULL , PRIMARY KEY (`id`), UNIQUE (`uid`)) ENGINE = InnoDB COMMENT = 'Stock les préférences des utilisateurs';

	/**Modifications #*/
	ALTER TABLE `uprefs` ADD `sessionmode` ENUM('0','1') NOT NULL AFTER `stylemode`;
	ALTER TABLE `uprefs` ADD `onlinemode` ENUM('1','0') NOT NULL AFTER `sessionmode`;
	---
	###########Last commit 17/10/19





#	notobook   ->		Stock les informations complémentaire sur le client
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`notebook` ( `id` INT NOT NULL AUTO_INCREMENT , `client_id` INT NOT NULL , `note` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`client_id`)) ENGINE = InnoDB COMMENT = 'Stock les informations complémentaire sur le client';

	/**Modifications #*/
	---




	###########Last commit 08/10/19
#	bank   ->		Stock les informations des banques
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`bank` ( `id` INT NOT NULL AUTO_INCREMENT , `bankhash` VARCHAR(20) NOT NULL , `bank_name` VARCHAR(225) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`bankhash`)) ENGINE = InnoDB COMMENT = 'Stock les informations des banques';

	/**Modifications #*/
	ALTER TABLE `bank` ADD `bank_number` INT NOT NULL AFTER `bank_name`, ADD `account_manager` VARCHAR(225) NOT NULL AFTER `bank_number`, ADD `am_infos` TEXT NOT NULL AFTER `account_manager`;
	ALTER TABLE `bank` ADD `prefered` ENUM('0','1') NOT NULL AFTER `am_infos`;
	---





#	init_bank   ->		Initialise les mois pour le rapprochement bancaire
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_bank` ( `id` INT NOT NULL AUTO_INCREMENT , `bank_id` INT NOT NULL , `bankhash` VARCHAR(20) NOT NULL , `month_id` VARCHAR(10) NOT NULL , `month` INT NOT NULL , `year` INT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`month_id`)) ENGINE = InnoDB COMMENT = 'Initialise le mois pour le rapprochement bancaire';

	/**Modifications #*/
	---





#	point_bank   ->		Stock les point du compte bancaire
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`point_bank` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `solde_depart` INT NOT NULL , `credit` INT NOT NULL , `debit` INT NOT NULL , `solde` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les point du compte bancaire';

	/**Modifications #*/
	---





#	bank_moovs   ->		Stock les mouvements du compte bancaire
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`bank_moovs` ( `id` INT NOT NULL AUTO_INCREMENT , `init_id` INT NOT NULL , `month_id` VARCHAR(10) NOT NULL , `day` INT NOT NULL , `typeof` ENUM('1','2') NOT NULL , `amount` INT NOT NULL , `description` TEXT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les mouvements du compte bancaire';

	/**Modifications #*/
	---





#	init_chat   ->		Initialise les conversations entre utilisateurs
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`init_chat` ( `id` INT NOT NULL AUTO_INCREMENT , `chathash` VARCHAR(12) NOT NULL , `starter` INT NOT NULL , `reciever` INT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`chathash`)) ENGINE = InnoDB COMMENT = 'Initialise les conversations entre utilisateurs';

	/**Modifications #*/
	---





#	chat   ->		Stock les messages entre utilisateurs
	/**Création #*/
	CREATE TABLE `u532250745_panel`.`chat` ( `id` INT NOT NULL AUTO_INCREMENT , `chathash` VARCHAR(12) NOT NULL , `sender` INT NOT NULL , `msg` LONGTEXT NOT NULL , `etat` ENUM('0','1') NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = 'Stock les messages entre utilisateurs';

	/**Modifications #*/
	---