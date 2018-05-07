-- Basic Table data for Categories, Class (Class, Grade), and School needs to be added
USE bhvalent;

-- Login Table
INSERT INTO Login (Username, Password) VALUES('ScienceFair', 'olemiss2018');

-- Category Table
INSERT INTO Category VALUES(0100, 'Behavioral and Social Science');
INSERT INTO Category VALUES(0200, 'Biochemistry');
INSERT INTO Category VALUES(0300, 'Inorganic Chemistry');
INSERT INTO Category VALUES(0400, 'Organic Chemistry');
INSERT INTO Category VALUES(0500, 'Earth and Environmental Sciences');
INSERT INTO Category VALUES(0600, 'Animal Sciences');
INSERT INTO Category VALUES(0700, 'Medicine and Health');
INSERT INTO Category VALUES(0800, 'Microbiology');
INSERT INTO Category VALUES(0900, 'Physics and Astronomy');
INSERT INTO Category VALUES(1000, 'Engineering');
INSERT INTO Category VALUES(1100, 'Computer Science and Math');
INSERT INTO Category VALUES(1200, 'Robotics and Intelligent Machines');
INSERT INTO Category VALUES(1300, 'Botany');

-- Class Table
INSERT INTO Class (Class, Grade) VALUES(1, 1);
INSERT INTO Class (Class, Grade) VALUES(1, 2);
INSERT INTO Class (Class, Grade) VALUES(1, 3);
INSERT INTO Class (Class, Grade) VALUES(2, 4);
INSERT INTO Class (Class, Grade) VALUES(2, 5);
INSERT INTO Class (Class, Grade) VALUES(2, 6);
INSERT INTO Class (Class, Grade) VALUES(3, 7);
INSERT INTO Class (Class, Grade) VALUES(3, 8);
INSERT INTO Class (Class, Grade) VALUES(4, 9);
INSERT INTO Class (Class, Grade) VALUES(4, 10);
INSERT INTO Class (Class, Grade) VALUES(5, 11);
INSERT INTO Class (Class, Grade) VALUES(5, 12);

-- Need to add Schools