-- Data Set #1


-- add fairs
INSERT INTO Fair (FairName, Year) VALUES('Region 7 Upper Fair', 2018);
INSERT INTO Fair (FairName, Year) VALUES('Region 7 Lower Fair', 2018);

-- add schools
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Oxford High', 'Mr. Hurry', 'Oxford', 'Public');
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Lafayette High', 'Mrs. McBride', 'Oxford', 'Public');
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Oxford Middle', 'Mrs. Thurier', 'Oxford', 'Public');
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Oxford Intermediate', 'Mrs. Furlong', 'Oxford', 'Public');
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Lafayette Middle', 'Mrs. Brown', 'Oxford', 'Public');
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Oxford Elementary', 'Mrs. Holland', 'Oxford', 'Public');
INSERT INTO School (SName, KeyTeacher, City, Type) VALUES('Lafayette Elementary', 'Mrs. Eaton', 'Oxford', 'Public');


-- add Registrants/Students

-- Region 7 Upper Fair
INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Valentine', 'Bennett', 'Computer Stuff', 19, 'Male', 'Oxford', 'MS', 38655, 1, 1, 1100, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Willis', 'Hannah', 'Puppies', 18, 'Female', 'Oxford', 'MS', 38655, 1, 1, 600, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Caron', 'Josh', 'Marketing', 18, 'Male', 'Oxford', 'MS', 38655, 1, 2, 100, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Stanford', 'Matthew', 'Plants', 18, 'Male', 'Oxford', 'MS', 38655, 1, 2, 1300, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Luthy', 'Ryan', 'Better Computer Stuff', 17, 'Male', 'Oxford', 'MS', 38655, 1, 2, 1100, 11);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Dodd', 'Benton', 'Psychology', 17, 'Male', 'Oxford', 'MS', 38655, 1, 2, 100, 11);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Peckham', 'Turner', 'Stuff with Medicine', 16, 'Male', 'Oxford', 'MS', 38655, 1, 1, 700, 10);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Jones', 'Isaac', 'More Psychology', 16, 'Male', 'Oxford', 'MS', 38655, 1, 2, 100, 10);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Hardy', 'Hunter', 'Blah Blah', 15, 'Male', 'Oxford', 'MS', 38655, 1, 2, 100, 9);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Harper', 'Hannah', 'Something', 13, 'Female', 'Oxford', 'MS', 38655, 1, 3, 1000, 8);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Harper', 'Jack', 'More Something', 12, 'Male', 'Oxford', 'MS', 38655, 1, 3, 1000, 7);


-- Region 7 Lower Fair
INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Bob', 'Billy', 'Bugs', 9, 'Male', 'Oxford', 'MS', 38655, 2, 6, 600, 3);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Doe', 'John', 'Dirt', 8, 'Male', 'Oxford', 'MS', 38655, 2, 7, 500, 2);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Doe', 'Jane', 'Flowers', 7, 'Female', 'Oxford', 'MS', 38655, 2, 7, 1300, 1);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Manning', 'Eli', 'Football', 7, 'Male', 'Oxford', 'MS', 38655, 2, 6, 900, 1);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Manning', 'Peyton', 'More Football', 9, 'Male', 'Oxford', 'MS', 38655, 2, 6, 900, 3);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Turing', 'Alan', 'Computers can think', 8, 'Male', 'Oxford', 'MS', 38655, 2, 7, 1200, 2);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Keller', 'Timothy', 'Life', 11, 'Male', 'Oxford', 'MS', 38655, 2, 7, 100, 5);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Asato', 'Mateus', 'Guitar', 12, 'Male', 'Oxford', 'MS', 38655, 2, 6, 900, 6);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Trucks', 'Derek', 'Slide Guitar', 12, 'Male', 'Oxford', 'MS', 38655, 2, 7, 900, 6);

INSERT INTO Registration (LName, FName, ProjTitle, Age, Gender, City, State, Zip, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Mayer', 'John', 'Rythm Guitar', 7, 'Male', 'Oxford', 'MS', 38655, 2, 6, 900, 1);



-- add judges and add them to setjudge as well
INSERT INTO Judge (LName, FName, Email) VALUES('Valentine', 'Paul', 'pval@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 1, 900);

INSERT INTO Judge (LName, FName, Email) VALUES('Johnson', 'Eric', 'guitarshredder@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 2, 900);

INSERT INTO Judge (LName, FName, Email) VALUES('Augustine', 'Saint', 'idkemail@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 3, 100);

INSERT INTO Judge (LName, FName, Email) VALUES('Gladwell', 'Malcolm', 'whatthedogsaw@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 4, 100);

INSERT INTO Judge (LName, FName, Email) VALUES('Dog', 'Snoop', 'footballcoach@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 5, 1300);
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 5, 1300);

INSERT INTO Judge (LName, FName, Email) VALUES('Winograd', 'Terry', 'imnoteinstein@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 6, 1200);
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 6, 1100);

INSERT INTO Judge (LName, FName, Email) VALUES('Harper', 'Sadie', 'ilikesticks@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 7, 500);

INSERT INTO Judge (LName, FName, Email) VALUES('Caron', 'Brother', 'pleasepetme@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 8, 600);
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 8, 600);

INSERT INTO Judge (LName, FName, Email) VALUES('Willis', 'Peaches', 'takemeonwalk@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 9, 600);
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 9, 600);

INSERT INTO Judge (LName, FName, Email) VALUES('Wilkins', 'Dawn', 'dwilkins@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 10, 1100);

INSERT INTO Judge (LName, FName, Email) VALUES('Cunningham', 'Conrad', 'ccuninghaml@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 11, 1100);

INSERT INTO Judge (LName, FName, Email) VALUES('Sprout', 'Professor', 'psprout@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 12, 1300);
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 12, 1300);

INSERT INTO Judge (LName, FName, Email) VALUES('Harper', 'Julie', 'jharper@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 13, 700);

INSERT INTO Judge (LName, FName, Email) VALUES('House', 'Gregory', 'ghouse@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 14, 700);

INSERT INTO Judge (LName, FName, Email) VALUES('Dowling', 'Peter', 'pdowling@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 15, 1000);

INSERT INTO Judge (LName, FName, Email) VALUES('Biggs', 'David', 'dbiggs@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(1, 16, 1000);

INSERT INTO Judge (LName, FName, Email) VALUES('Harper', 'Murphy', 'mharper@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 17, 500);

INSERT INTO Judge (LName, FName, Email) VALUES('Robinson', 'John', 'jrobinson@gmail.com');
INSERT INTO SetJudge (FKFairID, FKJudgeID, FKCategoryID) VALUES(2, 18, 1200);








