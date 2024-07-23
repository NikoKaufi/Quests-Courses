CREATE TABLE Profession (
    ID_Profession INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Bezeichnung VARCHAR(50) NOT NULL,
    Fähigkeiten TEXT
);

CREATE TABLE Skill (
    ID_Skill INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Skillbezeichnung VARCHAR(50) NOT NULL
);

CREATE TABLE Benutzer (
    ID_User INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Passwort VARCHAR(50) NOT NULL,
    Vorname VARCHAR(50) NOT NULL,
    Nachname VARCHAR(50) NOT NULL,
    E_Mail_Adresse VARCHAR(50),
    Geburtsdatum DATE,
    Rolle VARCHAR(50),
    Health_Points INT,
    Gesamtfortschritt INT,
    Profession INT(5) UNSIGNED,
    FOREIGN KEY (Profession) REFERENCES Profession(ID_Profession)
);

CREATE TABLE Kurs (
    ID_Kurs INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Kursbezeichnung VARCHAR(50) NOT NULL,
    Lernfeld VARCHAR(50),
    Kursmaterial TEXT,
    Verantwortlich INT(5) UNSIGNED,
    FOREIGN KEY (Verantwortlich) REFERENCES Benutzer(ID_User)
);

CREATE TABLE erworbeneSkills (
    Nr_User INT(5) UNSIGNED NOT NULL,
    Nr_Skill INT(5) UNSIGNED NOT NULL,
    aktuelleSkillpunkte INT,
    PRIMARY KEY (Nr_User, Nr_Skill),
    FOREIGN KEY (Nr_User) REFERENCES Benutzer(ID_User),
    FOREIGN KEY (Nr_Skill) REFERENCES Skill(ID_Skill)
);

CREATE TABLE belegte_Kurse (
    Kursnutzer INT(5) UNSIGNED NOT NULL,
    Nr_Kurs INT(5) UNSIGNED NOT NULL,
    Kursfortschritt INT,
    PRIMARY KEY (Kursnutzer, Nr_Kurs),
    FOREIGN KEY (Kursnutzer) REFERENCES Benutzer(ID_User),
    FOREIGN KEY (Nr_Kurs) REFERENCES Kurs(ID_Kurs)
);

CREATE TABLE SkillsProKurs (
    Nr_Kurs INT(5) UNSIGNED NOT NULL,
    Nr_Skill INT(5) UNSIGNED NOT NULL,
    erreichbareSkillpunkte INT,
    PRIMARY KEY (Nr_Kurs, Nr_Skill),
    FOREIGN KEY (Nr_Kurs) REFERENCES Kurs(ID_Kurs),
    FOREIGN KEY (Nr_Skill) REFERENCES Skill(ID_Skill)
);
