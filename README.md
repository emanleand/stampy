# stampy

## Instalation
### Create Database

```java
CREATE DATABASE IF NOT EXISTS stampy;
USE stampy;
```

### Create Table user

```java 
CREATE TABLE user(
	id int(255) auto_increment not null,
	first_name varchar(50) not null,
  last_name varchar(50) not null,
  username varchar(50) not null,
  email varchar(50) not null,
  password varchar(100) not null,
	create_at datetime DEFAULT CURRENT_TIMESTAMP,	
CONSTRAINT pk_task PRIMARY KEY(id)
)ENGINE =innoDb;
```

```java
CREATE UNIQUE INDEX idx_username
ON user (username);
```
```java
CREATE UNIQUE INDEX idx_email
ON user (email);
