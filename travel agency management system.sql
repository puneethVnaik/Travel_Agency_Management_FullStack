CREATE TABLE vehicle (
    vid INT PRIMARY KEY,
    vname VARCHAR(50),
    capacity INT,
    type VARCHAR(50),
    regno VARCHAR(20)
);

CREATE TABLE customer (
    id INT PRIMARY KEY,
    name VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    address VARCHAR(255)
);

CREATE TABLE trip (
    tid INT PRIMARY KEY,
    source VARCHAR(100),
    destination VARCHAR(100),
    sdate DATE,
    edate DATE
);

CREATE TABLE payment (
    id INT PRIMARY KEY,
    tid INT PRIMARY KEY,
    pdate DATE,
    distance travel DECIMAL(10,2),
    FOREIGN KEY (tid) REFERENCES trip(tid),
    FOREIGN KEY (id) REFERENCES customer(id)

);

CREATE TABLE booking (
    id INT PRIMARY KEY,
    vid INT PRIMARY KEY,
    tid INT PRIMARY KEY,
    bdate DATE,
    FOREIGN KEY (id) REFERENCES customer(id),
    FOREIGN KEY (vid) REFERENCES vehicle(vid),
    FOREIGN KEY (tid) REFERENCES trip(tid)
);