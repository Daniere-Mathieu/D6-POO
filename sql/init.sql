-- ! create database
CREATE TABLE teacher (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE classroom (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE student (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    classroom INT NOT NULL,
    FOREIGN KEY (classroom) REFERENCES classroom(id)
) ENGINE = InnoDB;

CREATE TABLE task (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mark INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    deadline DATETIME NOT NULL
) ENGINE = InnoDB;

CREATE TABLE course_module (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    classroom INT NOT NULL,
    FOREIGN KEY (classroom) REFERENCES classroom(id)
) ENGINE = InnoDB;

-- ! many to many table
--
--
--
-- ! classroom table 
CREATE TABLE classroom_teacher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classroom INT NOT NULL,
    teacher INT NOT NULL,
    FOREIGN KEY (classroom) REFERENCES classroom(id),
    FOREIGN KEY (teacher) REFERENCES teacher(id)
) ENGINE = InnoDB;

--
-- ! course_module table
CREATE TABLE course_module_student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_module INT NOT NULL,
    student INT NOT NULL,
    is_validate BOOLEAN NOT NULL DEFAULT false,
    FOREIGN KEY (course_module) REFERENCES course_module(id),
    FOREIGN KEY (student) REFERENCES student(id)
) ENGINE = InnoDB;

CREATE TABLE course_module_teacher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_module INT NOT NULL,
    teacher INT NOT NULL,
    FOREIGN KEY (course_module) REFERENCES course_module(id),
    FOREIGN KEY (teacher) REFERENCES teacher(id)
) ENGINE = InnoDB;

--
-- ! task table 
CREATE TABLE task_teacher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task INT NOT NULL,
    teacher INT NOT NULL,
    FOREIGN KEY (task) REFERENCES task(id),
    FOREIGN KEY (teacher) REFERENCES teacher(id)
) ENGINE = InnoDB;

CREATE TABLE task_student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task INT NOT NULL,
    student INT NOT NULL,
    mark INT DEFAULT NULL,
    is_finish BOOLEAN NOT NULL DEFAULT false,
    comment VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (task) REFERENCES task(id),
    FOREIGN KEY (student) REFERENCES student(id)
) ENGINE = InnoDB;

CREATE TABLE task_course_module (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task INT NOT NULL,
    course_module INT NOT NULL,
    FOREIGN KEY (task) REFERENCES task(id),
    FOREIGN KEY (course_module) REFERENCES course_module(id)
) ENGINE = InnoDB;