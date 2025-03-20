

USE ecommerce;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(255) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL
);

CREATE TABLE products (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          price DECIMAL(10, 2) NOT NULL,
                          stock INT NOT NULL,
                          image VARCHAR(255) NOT NULL,
                          description TEXT NOT NULL,
                          formato ENUM('CD', 'Vinile', 'Digitale') NOT NULL,
                          versione ENUM('Standard', 'collector\'s edition', 'deluxe') NOT NULL
);
CREATE TABLE cart (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      user_id INT NOT NULL,
                      product_id INT NOT NULL,
                      quantity INT DEFAULT 1,
                      formato VARCHAR(50) NOT NULL,
                      versione VARCHAR(50) NOT NULL,
                      FOREIGN KEY (user_id) REFERENCES users(id),
                      FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE product_images (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                product_id INT,
                                image_url VARCHAR(255) NOT NULL,
                                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO products (name, price, stock, image, description, formato, versione) VALUES
                                                                                     ('DAMN. - Kendrick Lamar', 44.99, 10, 'https://www.disclan.com/150738-home_default/damn-lamar-kendrick-lp.jpg', 'Descrizione dettagliata per DAMN. - Kendrick Lamar.', 'Vinile', 'Standard'),
                                                                                     ('All Eyez On Me - 2Pac', 34.99, 15, 'https://www.disclan.com/160944-home_default/all-eyez-on-me-2pac-lp.jpg', 'Descrizione dettagliata per All Eyez On Me - 2Pac.', 'CD', 'collector\'s edition'),
    ('Effigy - Lamb As', 24.99, 20, 'https://www.disclan.com/162611-home_default/lamb-as-effigy-.jpg', 'Descrizione dettagliata per Effigy - Lamb As.', 'Digitale', 'Standard'),
    ('Madra - Indie Exclusive', 22.99, 5, 'https://www.disclan.com/163550-home_default/madra-indie-exclusive-green-vinyl.jpg', 'Descrizione dettagliata per Madra - Indie Exclusive.', 'Vinile', 'deluxe'),
    ('The Razors Edge - AC/DC', 39.99, 8, 'https://www.disclan.com/163490-home_default/the-razors-edge-lp-colore-oro-ac-dc-lp.jpg', 'Descrizione dettagliata per The Razors Edge - AC/DC.', 'CD', 'Standard'),
    ('Where Is My Utopia - Indie Exclusive', 26.99, 12, 'https://www.disclan.com/163445-home_default/where-is-my-utopia-colored-vinyl-indie-exclusive-ltd-ed.jpg', 'Descrizione dettagliata per Where Is My Utopia - Indie Exclusive.', 'Vinile', 'collector\'s edition'),
                                                                                     ('Lives Outgrown - Deluxe', 28.99, 7, 'https://www.disclan.com/163881-home_default/lives-outgrown-deluxe-indie-only.jpg', 'Descrizione dettagliata per Lives Outgrown - Deluxe.', 'Digitale', 'deluxe'),
                                                                                     ('For Those About to Rock - AC/DC', 38.99, 6, 'https://www.disclan.com/163488-home_default/for-those-about-to-rock-we-salute-you-lp-colore-oro-ac-dc-lp.jpg', 'Descrizione dettagliata per For Those About to Rock - AC/DC.', 'Vinile', 'Standard'),
                                                                                     ('Who Made Who - AC/DC', 37.99, 9, 'https://www.disclan.com/163491-home_default/who-made-who-lp-colore-oro-ac-dc-lp.jpg', 'Descrizione dettagliata per Who Made Who - AC/DC.', 'CD', 'collector\'s edition');


INSERT INTO product_images (product_id, image_url) VALUES
                                                       (1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxc0B1jarPtuzCrz_A7mS0pRkzxZO6xniTYg&s'),
                                                       (1, 'https://i5.walmartimages.com/seo/Kendrick-Lamar-Poster-DAMN-Album-Cover-Posters-Prints-Rapper-Bedroom-Decor-Office-Room-Gift-Unframe-12x18inch-30x46cm_fdb06b12-3592-4470-aa38-2c47bed4a0be.329653ca1a602f0e5e97e2cc14f20c1d.jpeg'),
                                                       (1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScmrfWuWd2k1sje6oDzYvlTdFqSbRzI3Zc-w&s'),
                                                       (2,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQExj8PU_4y9NU1nD6qlNJnKfCPscThyuoCag&s'),
                                                       (2,'https://i.pinimg.com/736x/48/01/97/480197db7fdf209fe693a8625bd09b2e.jpg'),
                                                       (2,'https://interscope.com/cdn/shop/products/Interscope_Ecom_Sizing_0005s_0002_2pac_alleyezonme_discalbum.png?v=1680822193'),
                                                       (3,'https://lh6.googleusercontent.com/proxy/zXc2Kw7FyouovdltVi-Q2Ur4SYtl3j6H5a-rg0dxLXyIu-aCwpZv1cAs5k71VivMDViScQeQQ_1IzXc1QNjLbBumCkF6XXhCxU2go-3lKJKnT5l42skrJDiWtB59OgW6uge3Av9XW8c'),
                                                       (3,'https://www.redbrick.me/wp-content/uploads/2023/09/sprain-e1694631127751.jpg'),
                                                       (3,'https://external-preview.redd.it/oLZZEno1szEzGnpOJC0iDO4fYmNCgM-8JasHHHR3PxQ.jpg?auto=webp&s=f50eb2a894526be069cde2117d0e33105827389f'),
                                                       (4,'https://i.discogs.com/oliHQ7bcDxaw5E9W_iqBKGt-P5Z8k5uOtV6fhMWdBIE/rs:fit/g:sm/q:90/h:600/w:590/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTMxMDA0/NTcyLTE3MTg4MTY0/OTgtNDE0Ni5qcGVn.jpeg'),
                                                       (4,'https://www.picclickimg.com/BoUAAOSwa35nSYqm/NewDad-Madra-Signed-Green-12-Vinyl-LP-2024.webp'),
                                                       (4,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUENhVs9LaLl19G-ZLmAMIupdqlXP5ULU-Msda_6IJelXdf4zHbMrl-xtUxvDMdGf9mpY&usqp=CAU'),
                                                       (5,'https://vinyl.bertelsmann.com/img/cover/03/L_02007-02.jpg'),
                                                       (5,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQRnOf4dELPs2gAUYT1Y1bIvPbaPu0Z_RUlg&s'),
                                                       (5,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1WAZKHMZNFUSzc_KIiXLbgTnnw5ql1ZSeFg&s'),
                                                       (6,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnMqb1cc5OwKQO9qFKtpBZBc1GQOjJFOTUCg&s'),
                                                       (6,'https://s3-eu-west-1.amazonaws.com/discotecalaziale/images/cover/0602458508369_1.jpg'),
                                                       (6,'https://cdn11.bigcommerce.com/s-t6au9pi8wv/images/stencil/1280x1280/products/2205/3981/Indies_Exclusive_LP_with_Sticker_Sheet_-_2__50651.1709294145.jpg?c=1'),
                                                       (7,'https://www.platomania.nl/upload/20240405/vGujEKpKkEJM2ZYGTUUAf1mBU8i3QdEfkLYtVZTN.png'),
                                                       (7,'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_141080046?x=536&y=402&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=536&ey=402&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=536&cdy=402'),
                                                       (7,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoqs9dk16gAt9CZ7vOUgxWsOWgx4V5Bh2Hnw&s'),
                                                       (8,'https://img01.ztat.net/article/spp-media-p1/e93624c8787c4244b1dbbb76d6def7b1/fe4bf05e8ad84b5580cb6aa28a09e2ff.jpg?imwidth=762'),
                                                       (8,'https://i.discogs.com/wuVBTHDw4YHgWBZOCBc2jFgeoBUkLXuf0nmb3XR_nh8/rs:fit/g:sm/q:90/h:600/w:599/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTMwMTAz/MDc5LTE3MTM1Mjg4/MzUtOTA0My5qcGVn.jpeg'),
                                                       (8,'https://millenniumshopone.it/wp-content/uploads/2022/10/Cannon-N27-1500.jpg'),
                                                       (9,'https://c.shld.net/rpx/i/s/pi/mp/10160405/prod_9677840332?src=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F51qX44HKlKL.jpg&d=2bf38af361f33a7795e6427e5ff5a17db6a6110d'),
                                                       (9,'https://cdn.charitystars.com/cache/resizedcrop-9532b75f5214218d270e17c179f20788-840x630.jpg'),
                                                       (9,'https://www.thenostalgiashop.co.uk/cdn/shop/products/1.070889IMG_4923-001.jpg?v=1551533152');


-- Inserimento di un utente (esempio)
INSERT INTO users (email, password) VALUES
    ('test@example.com', 'password123');


INSERT INTO cart (user_id, product_id, quantity, formato, versione) VALUES
    (1, 1, 2, 'Vinile', 'Deluxe');