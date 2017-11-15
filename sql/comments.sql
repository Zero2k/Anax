USE vib16;

SET NAMES utf8;

DROP TABLE IF EXISTS comments;
CREATE TABLE comments
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    /* userId INT NOT NULL */
    /* contentId INT NOT NULL */
    email VARCHAR(120),
    text VARCHAR(120),
    postedBy VARCHAR(120),

    published DATETIME DEFAULT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT NULL, --  ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN NOT NULL DEFAULT 0

    /* FOREIGN KEY (userId) REFERENCES users(id) */
) ENGINE INNODB CHARACTER SET utf8;

DELETE FROM comments;
INSERT INTO comments (email, text, postedBy) VALUES
    ('test@test.com', 'my first comment', 'Admin')
;
SELECT * FROM comments;
