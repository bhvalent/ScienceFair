-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2018-04-08 19:14:38.605

USE bhvalent;

DROP TABLE IF EXISTS Category, Class, Fair, Judge, JudgeRegistrant, Registration, School, SetJudge, TeamMember;

-- tables
-- Table: Category
CREATE TABLE Category (
    CategoryID int NOT NULL,
    Description varchar(120) NOT NULL,
    CONSTRAINT Category_pk PRIMARY KEY (CategoryID)
);

-- Table: Class
CREATE TABLE Class (
    ClassID int NOT NULL AUTO_INCREMENT,
    Class int NOT NULL,
    Grade int NOT NULL,
    CONSTRAINT Class_pk PRIMARY KEY (ClassID)
);

-- Table: Fair
CREATE TABLE Fair (
    FairID int NOT NULL AUTO_INCREMENT,
    FairName varchar(45) NOT NULL,
    Year int NOT NULL,
    CONSTRAINT Fair_pk PRIMARY KEY (FairID)
);

-- Table: Judge
CREATE TABLE Judge (
    JudgeID int NOT NULL AUTO_INCREMENT,
    LName varchar(50) NOT NULL,
    FName varchar(50) NOT NULL,
    Email varchar(50) NOT NULL,
    CONSTRAINT Judge_pk PRIMARY KEY (JudgeID)
);

-- Table: JudgeRegistrant
CREATE TABLE JudgeRegistrant (
    FKSetJudgeID int NOT NULL,
    FKRegistrationID int NOT NULL,
    SetNumber int NOT NULL,
    CONSTRAINT JudgeRegistrant_pk PRIMARY KEY (FKSetJudgeID,FKRegistrationID)
);

-- Table: Registration
CREATE TABLE Registration (
    RegistrationID int NOT NULL AUTO_INCREMENT,
    LName varchar(50) NOT NULL,
    FName varchar(50) NOT NULL,
    ProjTitle varchar(255) NOT NULL,
    Continuation varchar(3) NOT NULL,
    NumYears int NOT NULL,
    Age int NOT NULL,
    Gender varchar(10) NOT NULL,
    City varchar(45) NOT NULL,
    State varchar(2) NOT NULL,
    Zip int NOT NULL,
    AdultSponsor varchar(100) NOT NULL,
    WheelchairAccess varchar(3) NULL,
    FKFairID int NOT NULL,
    FKSchoolID int NOT NULL,
    FKCategoryID int NOT NULL,
    FKClassID int NOT NULL,
    Score1 int NULL,
    Score2 int NULL,
    Total decimal(4,1) NULL,
    StanDev1 decimal(10,8) NULL,
    StanDev2 decimal(10,8) NULL,
    Rank int NULL,
    CONSTRAINT Registration_pk PRIMARY KEY (RegistrationID)
);

-- Table: School
CREATE TABLE School (
    SchoolID int NOT NULL AUTO_INCREMENT,
    SName varchar(100) NOT NULL,
    KeyTeacher varchar(100) NOT NULL,
    City varchar(50) NOT NULL,
    Type varchar(45) NOT NULL,
    CONSTRAINT School_pk PRIMARY KEY (SchoolID)
);

-- Table: SetJudge
CREATE TABLE SetJudge (
    SetJudgeID int NOT NULL AUTO_INCREMENT,
    FKFairID int NOT NULL,
    FKJudgeID int NOT NULL,
    FKCategoryID int NOT NULL,
    CONSTRAINT SetJudge_pk PRIMARY KEY (SetJudgeID)
);

-- Table: TeamMember
CREATE TABLE TeamMember (
    TeamMemberID int NOT NULL AUTO_INCREMENT,
    LName varchar(50) NOT NULL,
    FName varchar(50) NOT NULL,
    Age int NOT NULL,
    Gender varchar(10) NOT NULL,
    City varchar(45) NOT NULL,
    State varchar(2) NOT NULL,
    Zip int NOT NULL,
    WheelchairAccess varchar(3) NULL,
    FKRegistrationID int NOT NULL,
    CONSTRAINT TeamMember_pk PRIMARY KEY (TeamMemberID)
);

-- foreign keys
-- Reference: JudgeRegistrant_Registration (table: JudgeRegistrant)
ALTER TABLE JudgeRegistrant ADD CONSTRAINT JudgeRegistrant_Registration FOREIGN KEY JudgeRegistrant_Registration (FKRegistrationID)
    REFERENCES Registration (RegistrationID);

-- Reference: JudgeRegistrant_SetJudge (table: JudgeRegistrant)
ALTER TABLE JudgeRegistrant ADD CONSTRAINT JudgeRegistrant_SetJudge FOREIGN KEY JudgeRegistrant_SetJudge (FKSetJudgeID)
    REFERENCES SetJudge (SetJudgeID);

-- Reference: Registration_Category (table: Registration)
ALTER TABLE Registration ADD CONSTRAINT Registration_Category FOREIGN KEY Registration_Category (FKCategoryID)
    REFERENCES Category (CategoryID);

-- Reference: Registration_Class (table: Registration)
ALTER TABLE Registration ADD CONSTRAINT Registration_Class FOREIGN KEY Registration_Class (FKClassID)
    REFERENCES Class (ClassID);

-- Reference: Registration_Fair (table: Registration)
ALTER TABLE Registration ADD CONSTRAINT Registration_Fair FOREIGN KEY Registration_Fair (FKFairID)
    REFERENCES Fair (FairID);

-- Reference: Registration_School (table: Registration)
ALTER TABLE Registration ADD CONSTRAINT Registration_School FOREIGN KEY Registration_School (FKSchoolID)
    REFERENCES School (SchoolID);

-- Reference: SetJudge_Category (table: SetJudge)
ALTER TABLE SetJudge ADD CONSTRAINT SetJudge_Category FOREIGN KEY SetJudge_Category (FKCategoryID)
    REFERENCES Category (CategoryID);

-- Reference: SetJudge_Fair (table: SetJudge)
ALTER TABLE SetJudge ADD CONSTRAINT SetJudge_Fair FOREIGN KEY SetJudge_Fair (FKFairID)
    REFERENCES Fair (FairID);

-- Reference: SetJudge_Judge (table: SetJudge)
ALTER TABLE SetJudge ADD CONSTRAINT SetJudge_Judge FOREIGN KEY SetJudge_Judge (FKJudgeID)
    REFERENCES Judge (JudgeID);

-- Reference: TeamMember_Registration (table: TeamMember)
ALTER TABLE TeamMember ADD CONSTRAINT TeamMember_Registration FOREIGN KEY TeamMember_Registration (FKRegistrationID)
    REFERENCES Registration (RegistrationID);

-- End of file.

