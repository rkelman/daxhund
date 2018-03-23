-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2016 at 12:34 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a5034661_dax`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailyPriceYieldOTC`
--

CREATE TABLE `dailyPriceYieldOTC` (
  `currDate` date NOT NULL,
  `ID` int(11) NOT NULL,
  `Yield` float(5,2) DEFAULT NULL,
  `Price` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`currDate`,`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `dailyPriceYieldOTC`
--

INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 5, 2.79, 102.62);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 6, 0.00, 94.10);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 1, 5.11, 71.30);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 2, 0.74, 87.09);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 3, 5.43, 15.31);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 4, 4.08, 82.39);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 7, 2.98, 28.24);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 8, 3.18, 7.10);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 9, 2.02, 43.00);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 10, 0.00, 12.75);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 11, 2.74, 82.02);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 12, 7.78, 7.27);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 13, 4.77, 11.68);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 14, 2.94, 31.60);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 15, 3.64, 17.13);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 16, 1.00, 45.08);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 17, 1.00, 45.08);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 18, 1.38, 94.20);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 19, 0.88, 137.08);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 24, 3.34, 19.07);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 20, 1.28, 17.33);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 21, 4.57, 10.10);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 22, 0.00, 161.53);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 23, 2.92, 62.96);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 25, 0.00, 16.78);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 26, 1.43, 91.54);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 27, 3.14, 119.25);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 28, 0.00, 24.00);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 29, 0.09, 28.94);
INSERT INTO `dailyPriceYieldOTC` VALUES('2016-09-25', 30, 0.00, 29.75);

-- --------------------------------------------------------

--
-- Table structure for table `dax30`
--

CREATE TABLE `dax30` (
  `CompanyName` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `OTCStockTicker` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `FRAStockTicker` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `GoogFinURLOTC` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `GoogFINURLFRA` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `dax30`
--

INSERT INTO `dax30` VALUES('Daimler AG', 'DDAIF', NULL, 'https://www.google.com/finance?q=OTCMKTS%3ADDAIF', NULL, 1, 'Daimler AG (Daimler) is an automotive engineering company. The Company is engaged in the development, production and distribution of cars, trucks and vans in Germany, and the management of the Daimler Group. Daimler''s segments include Mercedes-Benz C');
INSERT INTO `dax30` VALUES('Adidas AG', 'ADDYY', NULL, 'https://www.google.com/finance?q=OTCMKTS%3AADDYY', NULL, 2, 'adidas AG and its subsidiaries design, develop, produce and market a range of athletic and sports lifestyle products. The Company''s segments include Western Europe; North America; Greater China; Russia/CIS; Latin America; Japan; Middle East, South Ko');
INSERT INTO `dax30` VALUES('Allianz SE', 'AZSEY', NULL, 'https://www.google.com/finance?q=OTCMKTS%3AAZSEY', NULL, 3, 'Allianz SE is a financial service company. The Company is the holding company of the Allianz Group. The Company operates in the field of reinsurance, providing reinsurance protection for Allianz Group companies, in particular. The Company''s segments ');
INSERT INTO `dax30` VALUES('BASF SE', 'BASFY', NULL, 'https://www.google.com/finance?q=OTCMKTS%3ABASFY', NULL, 4, 'BASF SE is a chemical company. The Company operates through five segments: Chemicals, Performance Products, Functional Materials & Solutions, Agricultural Solutions, and Oil & Gas. The Chemicals segment consists of the Petrochemicals, Monomers and In');
INSERT INTO `dax30` VALUES('Bayer AG', 'BAYRY', NULL, 'https://www.google.com/finance?q=OTCMKTS%3ABAYRY', NULL, 5, 'Bayer AG is a life science company. The Company''s segments are Pharmaceuticals, Consumer Health, Crop Science, Animal Health and Covestro. The Pharmaceuticals segment is engaged in the development of prescription pharmaceuticals; contraceptives, and ');
INSERT INTO `dax30` VALUES('Beiersdorf AG', 'BDRFF', 'BEI', 'https://www.google.com/finance?q=OTCMKTS%3ABDRFF', 'https://www.google.com/finance?q=FRA%3ABEI', 6, 'Beiersdorf AG is a Germany-based company engaged in the production of personal products with focus on cosmetic products manufacture. The Company operates through the two business segments Consumer as well as tesa. The Consumer business segment provid');
INSERT INTO `dax30` VALUES('BMW', 'BMWYY', 'BMW', 'https://www.google.com/finance?q=OTCMKTS%3ABMWYY', 'https://www.google.com/finance?q=FRA%3ABMW', 7, 'Bayerische Motoren Werke AG is a German holding company and automobile manufacturer that focuses on the automobile and motorcycle markets. It divides its activities into the three main segments: Automobiles, Motorcycles and Financial Services. It own');
INSERT INTO `dax30` VALUES('Commerzbank', 'CRZBY', 'CBK', 'https://www.google.com/finance?q=OTCMKTS%3ACRZBY', 'https://www.google.com/finance?q=FRA%3ACBK', 8, 'Commerzbank AG is a bank for private and corporate customers. The Bank''s business segments are Private Customers, Mittelstandsbank, Central & Eastern Europe, Corporates & Markets and Non-Core Assets. The Private Customers segment comprises the Privat');
INSERT INTO `dax30` VALUES('Continental AG', 'CTTAY', 'CON', 'https://www.google.com/finance?q=OTCMKTS%3ACTTAY', 'https://www.google.com/finance?q=FRA%3ACON', 9, 'Continental AG is an automotive supplier. The Company''s segments include Chassis & Safety, Powertrain, Interior, Tires, ContiTech and Other/consolidation. The Chassis & Safety division develops, produces and markets intelligent systems. The Chassis &');
INSERT INTO `dax30` VALUES('Deutsche Bank AG', 'DB', 'DBK', 'https://www.google.com/finance?q=NYSE%3ADB', 'https://www.google.com/finance?q=FRA%3ADBK', 10, 'Deutsche Bank AG is a global investment bank. The Bank is engaged in providing commercial and investment banking, retail banking, transaction banking and asset and wealth management products and services to corporations, governments, institutional in');
INSERT INTO `dax30` VALUES('Deutsche Boerse AG', 'DBOEF', 'DB1', 'https://www.google.com/finance?q=OTCMKTS%3ADBOEF', 'https://www.google.com/finance?q=FRA%3ADB1', 11, 'Deutsche Boerse AG is a Germany-based international financial marketplace operator. It operates four business segments: Xetra; Eurex; Clearstream, and Market Data & Analytics. The Xetra business segment comprises three business areas: cash market usi');
INSERT INTO `dax30` VALUES('E.ON SE', 'EONGY', 'EOAN', 'https://www.google.com/finance?q=OTCMKTS%3AEONGY', 'https://www.google.com/finance?q=FRA%3AEOAN', 12, 'E.ON SE is a provider of energy solutions. The Company''s segments include global units and regional units. The Company''s global units include Generation, which consists of the Company''s conventional (fossil and nuclear) generation assets in Europe; R');
INSERT INTO `dax30` VALUES('Deutsche Lufthansa AG', 'DLAKY', 'LHA', 'https://www.google.com/finance?q=OTCMKTS%3ADLAKY', 'https://www.google.com/finance?q=FRA%3ALHA', 13, 'Deutsche Lufthansa AG is an aviation company. The Company''s segments include Passenger Airline Group; Logistics; maintenance, repair and overhaul services (MRO), Catering and Other. The Company''s fleet consists of approximately 600 aircrafts. The Com');
INSERT INTO `dax30` VALUES('Deutsche Post AG', 'DPSGY', 'DPW', 'https://www.google.com/finance?q=OTCMKTS%3ADPSGY', 'https://www.google.com/finance?q=FRA%3ADPW', 14, 'Deutsche Post AG is a Germany-based logistics services provider. The Company operates four main business divisions: Mail; Express; Global Forwarding, Freight, and Supply Chain. The Mail business division comprises the transport and delivery of writte');
INSERT INTO `dax30` VALUES('Deutsche Telekom AG', 'DTEGY', 'DTE', 'https://www.google.com/finance?q=OTCMKTS%3ADTEGY', 'https://www.google.com/finance?q=FRA%3ADTE', 15, 'Deutsche Telekom AG provides information technology (IT) and telecommunications services. The Company''s operating segments include Germany, consisting of fixed-network and mobile activities in Germany; United States, which consists of mobile activiti');
INSERT INTO `dax30` VALUES('Fresenius SE & Co', 'FMS', 'FRE', 'https://www.google.com/finance?q=NYSE%3AFMS', 'https://www.google.com/finance?q=FRA%3AFRE', 16, 'Fresenius Medical Care AG & Co. KGaA (FMC AG & CO. KGAA) is a kidney dialysis company. The Company provides dialysis care and related services to persons suffering from end stage renal disease (ESRD), as well as other healthcare services. The Company');
INSERT INTO `dax30` VALUES('Fresenius Medical Care AG & Co.', 'FMS', 'FME', 'https://www.google.com/finance?q=NYSE%3AFMS', 'https://www.google.com/finance?q=FRA%3AFME', 17, 'Fresenius Medical Care AG & Co. KGaA (FMC AG & CO. KGAA) is a kidney dialysis company. The Company provides dialysis care and related services to persons suffering from end stage renal disease (ESRD), as well as other healthcare services. The Company');
INSERT INTO `dax30` VALUES('HeidelbergCement AG', 'HLBZF', 'HEI', 'https://www.google.com/finance?q=OTCMKTS%3AHLBZF', 'https://www.google.com/finance?q=FRA%3AHEI', 18, 'Heidelbergcement AG is a Germany-based company engaged in the manufacture of building materials. The Company’s main activities include the production and distribution of cement and aggregates, the two raw materials for the manufacture of concrete. Fu');
INSERT INTO `dax30` VALUES('Henkel AG & Co', 'HENOY', 'HEN3', 'https://www.google.com/finance?q=OTCMKTS%3AHENOY', 'https://www.google.com/finance?q=FRA%3AHEN3', 19, 'Henkel AG & Co. KGaA is engaged in the consumer and industrial business. The Company''s segments include Laundry & Home Care, Beauty Care and Adhesive Technologies. The Laundry & Home Care business unit is active in the laundry and home care branded c');
INSERT INTO `dax30` VALUES('Infineon Technologies AG', 'IFNNY', 'IFX', 'https://www.google.com/finance?q=OTCMKTS%3AIFNNY', 'https://www.google.com/finance?q=FRA%3AIFX', 20, 'Infineon Technologies AG develops, manufactures and markets a range of semiconductors and system solutions. The Company operates through four segments: Automotive; Industrial Power Control; Power Management & Multimarket, and Chip Card & Security. Th');
INSERT INTO `dax30` VALUES('K+S AG', 'KPLUY', 'SDF', 'https://www.google.com/finance?q=OTCMKTS%3AKPLUY', 'https://www.google.com/finance?q=FRA%3ASDF', 21, 'K&S AG is a Germany-based holding company which is active in the chemical sector. The Company divides its activities into three business segments. The Potash and Magnesium Products segment combines the production and marketing of potash fertilizers a');
INSERT INTO `dax30` VALUES('Linde AG', 'LNAGF', 'LIN', 'https://www.google.com/finance?q=OTCMKTS%3ALNAGF', 'https://www.google.com/finance?q=FRA%3ALIN', 22, 'Linde AG is a Germany-based gas and engineering company that operates through three segments: Gases, Engineering and Other. The Gases segment offers a wide range of compressed and liquefied -gases, as well as chemicals to various industries, includin');
INSERT INTO `dax30` VALUES('Merck & Co', 'MRK', 'MRK', 'https://www.google.com/finance?q=NYSE%3AMRK', 'https://www.google.com/finance?q=FRA%3AMRK', 23, 'Merck KGaA is a Germany-based company engaged in the pharmaceutical industry. The Company diversifies its activities into four business divisions: Merck Serono; Consumer Health; Merck Millipore, and Performance Materials. Within the Merck Serono divi');
INSERT INTO `dax30` VALUES('Munich RE AG', 'MURGY', 'MUV2', 'https://www.google.com/finance?q=OTCMKTS%3AMURGY', 'https://www.google.com/finance?q=fra%3AMUV2', 24, 'Muenchener Rueckversicherungs Gesellschaft in Muenchen AG is a Germany-based company engaged in reinsurance and insurance business. The Company divides its operations into reinsurance, primary insurance, and Munich Health and Asset management. The Re');
INSERT INTO `dax30` VALUES('RWE AG', 'RWEOY', 'RWE', 'https://www.google.com/finance?q=OTCMKTS%3ARWEOY', 'https://www.google.com/finance?q=fra%3Arwe', 25, 'RWE AG is a holding company. The Company is a supplier of electricity and natural gas in Europe. The Company is engaged in lignite production; electricity generation from gas, coal, nuclear and renewables, and energy trading and electricity and gas d');
INSERT INTO `dax30` VALUES('SAP SE', 'SAP', 'SAP', 'https://www.google.com/finance?q=NYSE%3ASAP', 'https://www.google.com/finance?q=FRA%3ASAP', 26, 'SAP SE (SAP), formerly SAP AG, is engaged in business application and analytics software. The Company is also engaged in digital commerce and is an enterprise cloud company. Its segments include Applications, Technology & Services segment, which is e');
INSERT INTO `dax30` VALUES('Siemens', 'SIEGY', 'SIE', 'https://www.google.com/finance?q=OTCMKTS%3ASIEGY', 'https://www.google.com/finance?q=FRA%3ASIE', 27, 'Siemens AG is a Germany-based industrial conglomerate that operates in nine segments: Power and Gas offers products and solutions for generating electricity from fossil and renewable fuels and for transporting oil and natural gas; Wind Power and Rene');
INSERT INTO `dax30` VALUES('ThyssenKrupp', 'TYEKF', 'TKA', 'https://www.google.com/finance?q=OTCMKTS%3ATYEKF', 'https://www.google.com/finance?q=FRA%3ATKA', 28, 'ThyssenKrupp AG is a Germany-based diversified industrial company. It operates in six segments: The Steel Europe segment produces flat carbon steel products; the Steel Americas segment processes and markets steel products in North and South America; ');
INSERT INTO `dax30` VALUES('Volkswagen', 'VLKAY', 'VOW3', 'https://www.google.com/finance?q=OTCMKTS%3AVLKAY', 'https://www.google.com/finance?q=FRA%3AVOW3', 29, 'Volkswagen AG is an automobile manufacturer and a carmaker. The Company develops vehicles and components for its brands. It also produces and sells vehicles. The activities of its Passenger Cars segment cover the development of vehicles and engines, ');
INSERT INTO `dax30` VALUES('Vonovia', 'DAIMF', 'VNA', 'https://www.google.com/finance?q=OTCMKTS%3ADAIMF', 'https://www.google.com/finance?q=FRA%3AVNA', 30, 'Vonovia SE, formerly Deutsche Annington Immobilien SE, is a Germany-based real estate that focuses on residential properties. The majority of its portfolio is located in the old German Federal States including Berlin. Furthermore, it offers additiona');
