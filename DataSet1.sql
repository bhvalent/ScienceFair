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
INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Valentine', 'Bennett', 'Computer Stuff', 'no', 0, 19, 'Male', 'Oxford', 'MS', 38655, 'Someone0', 1, 1, 1100, 12);

INSERT INTO TeamMember (LName, FName, Age, Gender, City, State, Zip, FKRegistrationID) 
VALUES('Smart', 'Someone', 19, 'Male', 'Oxford', 'MS', 38655, 1);
INSERT INTO TeamMember (LName, FName, Age, Gender, City, State, Zip, FKRegistrationID) 
VALUES('ReallySmart', 'Someone', 19, 'Female', 'Oxford', 'MS', 38655, 1);


INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Willis', 'Hannah', 'Puppies', 'no', 0, 18, 'Female', 'Oxford', 'MS', 38655, 'Someone1', 1, 1, 600, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Caron', 'Josh', 'Marketing', 'no', 0, 18, 'Male', 'Oxford', 'MS', 38655, 'Someone2', 1, 2, 100, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Stanford', 'Matthew', 'Plants', 'no', 0, 18, 'Male', 'Oxford', 'MS', 38655, 'Someone3', 1, 2, 1300, 12);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Luthy', 'Ryan', 'Better Computer Stuff', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone4', 'yes', 1, 2, 1100, 11);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Dodd', 'Benton', 'Psychology', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone5', 1, 2, 100, 11);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Peckham', 'Turner', 'Stuff with Medicine', 'yes', 2, 16, 'Male', 'Oxford', 'MS', 38655, 'Someone6', 1, 1, 700, 10);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Jones', 'Isaac', 'More Psychology', 'yes', 1, 16, 'Male', 'Oxford', 'MS', 38655, 'Someone7', 1, 2, 100, 10);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Hardy', 'Hunter', 'Blah Blah', 'no', 0, 15, 'Male', 'Oxford', 'MS', 38655, 'Someone8', 1, 2, 100, 9);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Harper', 'Hannah', 'Something', 'no', 0, 13, 'Female', 'Oxford', 'MS', 38655, 'Someone9', 1, 3, 1000, 8);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Harper', 'Jack', 'More Something', 'no', 0, 12, 'Male', 'Oxford', 'MS', 38655, 'Someone10', 1, 3, 1000, 7);


-- Region 7 Lower Fair
INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Bob', 'Billy', 'Bugs', 'yes', 2, 9, 'Male', 'Oxford', 'MS', 38655, 'Someone0', 2, 6, 600, 3);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Doe', 'John', 'Dirt', 'no', 0, 8, 'Male', 'Oxford', 'MS', 38655, 'Someone1', 2, 7, 500, 2);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Doe', 'Jane', 'Flowers', 'no', 0, 7, 'Female', 'Oxford', 'MS', 38655, 'Someone2', 2, 7, 1300, 1);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Manning', 'Eli', 'Football', 'no', 0, 7, 'Male', 'Oxford', 'MS', 38655, 'Someone3', 2, 6, 900, 1);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Manning', 'Peyton', 'More Football', 'yes', 2, 9, 'Male', 'Oxford', 'MS', 38655, 'Someone4', 2, 6, 900, 3);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Turing', 'Alan', 'Computers can think', 'no', 0, 8, 'Male', 'Oxford', 'MS', 38655, 'Someone5', 2, 7, 1200, 2);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Keller', 'Timothy', 'Life', 'yes', 4, 11, 'Male', 'Oxford', 'MS', 38655, 'Someone6', 2, 7, 100, 5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Asato', 'Mateus', 'Guitar', 'yes', 5, 12, 'Male', 'Oxford', 'MS', 38655, 'Someone7', 2, 6, 900, 6);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Trucks', 'Derek', 'Slide Guitar', 'no', 0, 12, 'Male', 'Oxford', 'MS', 38655, 'Someone8', 2, 7, 900, 6);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID)
VALUES('Mayer', 'John', 'Rythm Guitar', 'no', 0, 7, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 2, 6, 900, 1);



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








