-- Data Set #2


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
INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Valentine', 'Bennett', 'Computer Stuff', 'no', 0, 19, 'Male', 'Oxford', 'MS', 38655, 'Someone0', 'no', 1, 1, 1100, 12, 90, 92, 91.0);

INSERT INTO TeamMembers (LName, FName, Continuation, NumYears, Age, Gender, City, State, Zip, WheelchairAccess, FKClassID, FKRegistrationID) 
VALUES('Smart', 'Someone', 'no', 0, 19, 'Male', 'Oxford', 'MS', 38655, 'no', 12, 1);
INSERT INTO TeamMembers (LName, FName, Continuation, NumYears, Age, Gender, City, State, Zip, WheelchairAccess, FKClassID, FKRegistrationID) 
VALUES('ReallySmart', 'Someone', 'no', 0, 19, 'Female', 'Oxford', 'MS', 38655, 'no', 11, 1);


INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Willis', 'Hannah', 'Puppies', 'no', 0, 18, 'Female', 'Oxford', 'MS', 38655, 'Someone1', 'no', 1, 1, 600, 12, 95, 97, 96.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Caron', 'Josh', 'Marketing', 'no', 0, 18, 'Male', 'Oxford', 'MS', 38655, 'Someone2', 'no', 1, 2, 100, 12, 85, 90, 87.5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Stanford', 'Matthew', 'Plants', 'no', 0, 18, 'Male', 'Oxford', 'MS', 38655, 'Someone3', 'no', 1, 2, 1300, 12, 70, 80, 75.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Luthy', 'Ryan', 'Better Computer Stuff', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone4', 'no', 1, 2, 1100, 11, 80, 90, 85.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Dodd', 'Benton', 'Psychology', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone5', 'no', 1, 2, 100, 11, 88, 90, 89.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Peckham', 'Turner', 'Stuff with Medicine', 'yes', 2, 16, 'Male', 'Oxford', 'MS', 38655, 'Someone6', 'no', 1, 1, 700, 10, 60, 80, 70.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Jones', 'Isaac', 'More Psychology', 'yes', 1, 16, 'Male', 'Oxford', 'MS', 38655, 'Someone7', 'no', 1, 2, 100, 10, 82, 86, 84.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Hardy', 'Hunter', 'Blah Blah', 'no', 0, 15, 'Male', 'Oxford', 'MS', 38655, 'Someone8', 'no', 1, 2, 100, 9, 78, 84, 81.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Harper', 'Hannah', 'Something', 'no', 0, 13, 'Female', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 3, 1000, 8, 99, 99, 99.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Harper', 'Jack', 'More Something', 'no', 0, 12, 'Male', 'Oxford', 'MS', 38655, 'Someone10', 'no', 1, 3, 1000, 7, 99, 98, 98.5);


-- Region 7 Upper Fair
INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Bob', 'Billy', 'Bugs', 'yes', 2, 9, 'Male', 'Oxford', 'MS', 38655, 'Someone0', 'no', 1, 6, 600, 11, 55, 57, 56.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Doe', 'John', 'Dirt', 'no', 0, 8, 'Male', 'Oxford', 'MS', 38655, 'Someone1', 'no', 1, 7, 500, 12, 66, 68, 67.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Doe', 'Jane', 'Flowers', 'no', 0, 7, 'Female', 'Oxford', 'MS', 38655, 'Someone2', 'no', 1, 7, 1300, 11, 34, 35, 34.5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Manning', 'Eli', 'Football', 'no', 0, 7, 'Male', 'Oxford', 'MS', 38655, 'Someone3', 'no', 1, 6, 900, 12, 100, 99, 99.5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Manning', 'Peyton', 'More Football', 'yes', 2, 9, 'Male', 'Oxford', 'MS', 38655, 'Someone4', 'no', 1, 6, 900, 11, 100, 100, 100.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Turing', 'Alan', 'Computers can think', 'no', 0, 8, 'Male', 'Oxford', 'MS', 38655, 'Someone5', 'no', 1, 7, 1200, 12, 68, 70, 69.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Keller', 'Timothy', 'Life', 'yes', 4, 11, 'Male', 'Oxford', 'MS', 38655, 'Someone6', 'no', 1, 7, 100, 11, 91, 92, 91.5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Asato', 'Mateus', 'Guitar', 'yes', 5, 12, 'Male', 'Oxford', 'MS', 38655, 'Someone7', 'no', 1, 6, 900, 12, 70, 74, 72.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Trucks', 'Derek', 'Slide Guitar', 'no', 0, 12, 'Male', 'Oxford', 'MS', 38655, 'Someone8', 'no', 1, 7, 900, 11, 77, 80, 88.5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Mayer', 'John', 'Rythm Guitar', 'no', 0, 7, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 900, 12, 45, 55, 50.0);


INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person1', 'Johnson1', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 9, 66, 60, 63.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person2', 'Johnson2', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 10, 30, 40, 35.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person3', 'Johnson3', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 11, 71, 71, 71.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person4', 'Johnson4', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 12, 21, 25, 23.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person5', 'Johnson5', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 9, 99, 90, 94.5);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person6', 'Johnson6', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 10, 83, 83, 83.0);

INSERT INTO Registration (LName, FName, ProjTitle, Continuation, NumYears, Age, Gender, City, State, Zip, AdultSponsor, WheelchairAccess, FKFairID, FKSchoolID, FKCategoryID, FKClassID, Score1, Score2, Total)
VALUES('Person7', 'Johnson7', 'Generic Project', 'no', 0, 17, 'Male', 'Oxford', 'MS', 38655, 'Someone9', 'no', 1, 6, 1100, 11, 94, 95, 94.5);







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


