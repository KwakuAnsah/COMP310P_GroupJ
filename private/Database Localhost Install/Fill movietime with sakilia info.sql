GRANT ALL PRIVILEGES ON sakila.* TO 'webuser'@'localhost' IDENTIFIED BY 'secretpassword';
GRANT ALL PRIVILEGES ON MovieTime.* TO 'webuser'@'localhost' IDENTIFIED BY 'secretpassword';
GRANT ALL PRIVILEGES ON world.* TO 'webuser'@'localhost' IDENTIFIED BY 'secretpassword';


INSERT INTO movietime.film (film_id, title, tagline, certificate)
SELECT film_id, title, description, rating 
FROM sakila.film;

INSERT INTO movietime.film_film_genre (film_id, genre_id)
SELECT film_id, category_id
FROM sakila.film_category;

INSERT INTO movietime.film_genre (genre_id, genre_name)
SELECT category_id, name 
FROM sakila.category;

INSERT INTO movietime.country (country_name)
SELECT Name 
FROM world.country;

INSERT INTO movietime.country (,)
SELECT Name 
WHERE movietime.country_name = world.name 
FROM world.country;

INSERT INTO movietime.city (city_name, country_id) 
SELECT world.city.name, movietime.country.country_id 
FROM world.country 
JOIN world.city ON world.country.Code = world.city.CountryCode 
JOIN movietime.country 
    ON movietime.country.country_name = world.country.Name; 

INSERT INTO movietime.address (postcode, country_id, city_id) 
SELECT  sakila.address.postal_code, movietime.city.country_id,   
        movietime.city.city_id 
FROM Sakila.address 
JOIN movietime.city ON movietime.city.city_id = Sakila.address.city_id;


