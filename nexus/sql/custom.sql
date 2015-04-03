DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
    `id`        INT(11)      NOT NULL AUTO_INCREMENT,
    `region`    VARCHAR(10)  NOT NULL,
    `name`      VARCHAR(255) NOT NULL,
    `longitude` FLOAT(10, 6) NOT NULL,
    `latitude`  FLOAT(10, 6) NOT NULL,
    UNIQUE (`id`),
    Primary Key (`id`)
) ENGINE = InnoDB;
             

INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('ATL', 'Atlanta', -84.42810059, 33.63669968);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('BOS', 'Boston', -71.00520325, 42.36429977);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('ORD', 'Chicago', -87.90480042, 41.97859955);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('Dallas/Fort Worth', 'DFW', -83.35340118, 42.21239853);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('DEN', 'Denver', -104.6729965, 39.86169815);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('DTW', 'Detroit', -83.35340118, 42.21239853);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('HNL', 'Honolulu', -157.9219971, 21.31870079);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('IAH', 'Houston', -95.34140015, 29.9843998);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('LAS', 'Las Vegas', -115.1520004, 36.08010101);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('LAX', 'Los Angeles', -118.4079971, 33.94250107);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('MIA', 'Miami', -80.29060364, 25.79319954);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('MSP', 'Minneapolis/St. Paul', -93.22180176, 44.88199997);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('JFK', 'New York', -73.77890015, 40.63980103);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('LGA', 'New York', -73.87259674, 40.77719879);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('EWR', 'Newark', -74.16870117, 40.69250107);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('MCO', 'Orlando', -81.30899811, 28.42939949);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('PHX', 'Phoenix', -112.012001, 33.43429947);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('SFO', 'San Francisco', -122.375, 37.61899948);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('SEA', 'Seattle', -122.3089981, 47.44900131);
INSERT INTO location (region, name, longitude, latitude) VALUES
                     ('STL', 'St. Louis', -90.37000275, 38.74869919);

DROP TABLE IF EXISTS `driverLicense`;
CREATE TABLE `driverLicense` (
    `id`         INT(11)      NOT NULL AUTO_INCREMENT,
    `customerId` INT(11)      NOT NULL,
    `state`      VARCHAR(25)  NOT NULL,
    `number`     VARCHAR(255) NOT NULL,
    `dob`        DATE         NOT NULL,
    FOREIGN KEY(customerId) REFERENCES  customer(id),        
    Primary Key (`id`)    
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `ride`;
CREATE TABLE `ride` (
    `id`         INT(11)      NOT NULL AUTO_INCREMENT,
    `ownerId`    INT(11)      NOT NULL,
    `entityId`   INT(11)      NOT NULL,
    `locationId` INT(11)      NOT NULL, 
    `startType`  INT(1)       NOT NULL,
    `status`     INT(1)       NOT NULL,
    `dt`         DATETIME     NOT NULL,
    `longitude`  FLOAT(10, 6) NOT NULL,
    `latitude`   FLOAT(10, 6) NOT NULL,
    `start`      VARCHAR(255) NOT NULL,
    `to`         VARCHAR(255) NOT NULL,
    `via`        VARCHAR(255) NULL,
    `maxMiles`   INT(5)       NOT NULL,
    `seats`      INT(5)       NOT NULL,
    `smoker`     BOOLEAN      NOT NULL,
    `bags`       INT          NULL,
    `bagSize`    CHAR(1)      NULL,
    `note`       TEXT         NULL,       
    FOREIGN KEY(ownerId)  REFERENCES owner(id),        
    FOREIGN KEY(entityId) REFERENCES entity(id),        
    FOREIGN KEY(locationId) REFERENCES location(id),        
    Primary Key (`id`)    
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `lift`;
CREATE TABLE `lift` (
    `id`           INT(11)        NOT NULL AUTO_INCREMENT,
    `customerId`   INT(11)        NOT NULL,
    `orderId`      INT(11)        NULL,
    `rideId`       INT(11)        NULL,
    `locationId`   INT(11)        NOT NULL, 
    `confNum`      VARCHAR(20)    NULL,
    `contribution` DECIMAL(12,2)  NULL,
    `startType`    INT(1)         NOT NULL,
    `status`       INT(1)         NOT NULL,
    `dt`           DATETIME       NOT NULL,
    `longitude`    FLOAT(10, 6)   NOT NULL,
    `latitude`     FLOAT(10, 6)   NOT NULL,
    `start`        VARCHAR(255)   NOT NULL,
    `to`           VARCHAR(255)   NOT NULL,
    `via`          VARCHAR(255)   NULL,
    `maxMiles`     INT(5)         NOT NULL,
    `seats`        INT(5)         NULL,
    `smoker`       BOOLEAN        NULL,
    `bags`         INT            NULL,
    `bagSize`      CHAR(1)        NULL,
    `note`         TEXT           NULL,
    FOREIGN KEY(customerId) REFERENCES customer(id),        
    FOREIGN KEY(orderId)    REFERENCES `order`(id),        
    FOREIGN KEY(rideId)     REFERENCES ride(id),        
    FOREIGN KEY(locationId) REFERENCES location(id),        
    Primary Key (`id`)    
) ENGINE = InnoDB;

/* 
used for deletion, insert it into the custom table
*/
INSERT INTO customTable (customT, nexusT, foKEY) VALUES ('driverLicense', 
                                                         'customer', 
                                                         'customerId');                                                         
                                                         
INSERT INTO customTable (customT, nexusT, foKEY) VALUES ('ride', 
                                                         'owner', 
                                                         'ownerId');
INSERT INTO customTable (customT, nexusT, foKEY) VALUES ('ride', 
                                                         'entity', 
                                                         'entityId');
                                                         
INSERT INTO customTable (customT, nexusT, foKEY) VALUES ('lift', 
                                                         'customer', 
                                                         'customerId');
                                                                         