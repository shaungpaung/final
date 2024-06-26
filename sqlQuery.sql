-- Create the branches table
CREATE TABLE branches (
    branchID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    address VARCHAR(255),
     VARCHAR(11)
);

-- Create the vehicles table
CREATE TABLE vehicles (
    vehicleID INT PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(50),
    maximumCarryingWeight INT,
    maximumAvailableSpace INT,
    homeBranchID INT,
    FOREIGN KEY (homeBranchID) REFERENCES branches(branchID)
);

-- Create the users table
CREATE TABLE users (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    password VARCHAR(255),
    
);

-- Create the jobs table
CREATE TABLE jobs (
    jobID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT,
    weight INT,
    size INT,
    hazardous BOOLEAN,
    startDate DATE,
    deadline DATE,
    jobVehicleID INT,
    originBranchID INT,
    destinationBranchID INT,
    status ENUM('completed', 'in progress'),
    FOREIGN KEY (jobVehicleID) REFERENCES vehicles(vehicleID),
    FOREIGN KEY (originBranchID) REFERENCES branches(branchID),
    FOREIGN KEY (destinationBranchID) REFERENCES branches(branchID)
);
