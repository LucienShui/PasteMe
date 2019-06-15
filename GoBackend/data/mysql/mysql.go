/*
@File: mysql.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-06-11 18:25  Lucien     1.0         Init
2019-06-13 02:10  Lucien     1.1         Add abstract func
2019-06-13 15:24  Lucien     1.2         Complete func
*/
package mysql

import (
	"database/sql"
	"errors"
	"fmt"
	_ "github.com/go-sql-driver/mysql"
)

const (
	USERNAME = "username"
	PASSWORD = "password"
	NETWORK  = "tcp"
	SERVER   = "lucien.local"
	PORT     = 3306
	DATABASE = "pasteme"
)

func config() string {
	return fmt.Sprintf("%s:%s@%s(%s:%d)/%s", USERNAME, PASSWORD, NETWORK, SERVER, PORT, DATABASE)
}

var db = &sql.DB{}

func Create() error {
	var sqlSet = [...] string {
		"CREATE TABLE IF NOT EXISTS `temporary` ( " +
			"`key` VARCHAR(16) PRIMARY KEY, " +
			"`content` MEDIUMTEXT, " +
			"`lang` VARCHAR (16), " +
			"`password` VARCHAR (37), " +
			"`visible` BOOLEAN " +
		" )", "CREATE TABLE IF NOT EXISTS `permanent` ( " +
            "`key` BIGINT PRIMARY KEY, " +
            "`content` MEDIUMTEXT, " +
            "`lang` VARCHAR (16), " +
            "`password` VARCHAR (37), " +
            "`visible` BOOLEAN " +
        ")",
	}
	for _, statement := range sqlSet {
		fmt.Println(statement)
		_, err := db.Exec(statement)
		if err != nil {
			return err
		}
	}
	return nil
}

func Init() error {
	var err error
	db, err = sql.Open("mysql", config())
	return err
}

func Query(table string, key string) (string, string, string, bool, error) {
	row := db.QueryRow("SELECT `content`, `lang`, `password`, `visible` FROM `%s` where key = ?", table, key)
	var content, lang, password, visible string
	err := row.Scan(&content, &lang, &password, &visible)
	return content, lang, password, visible == "1", err
}

func InsertPermanent(content string, lang string, password string, visible bool) (int64, error) {
	result, err := db.Exec("INSERT INTO `permanent` (`content`, `lang`, `password`, `visible`) VALUES (?, ?, ?, ?, ?)", content, lang, password, visible)
	if err != nil {
		return -1, err
	}
	return result.LastInsertId()
}

func InsertTemporary(key string, content string, lang string, password string, visible bool) error {
	result, err := db.Exec("INSERT INTO `temporary` (`key`, `content`, `lang`, `password`, `visible`) VALUES (?, ?, ?, ?, ?, ?)", key, content, lang, password, visible)
	if err != nil {
		return err
	}
	count, err := result.RowsAffected()
	if err != nil {
		return err
	}
	if count == 0 {
		return errors.New("affect 0 row")
	}
	return nil
}

func Erase(key string) error {
	result, err := db.Exec("DELETE FROM `temporary` WHERE `key` = ?", key)
	if err != nil {
		return err
	}
	num, err := result.RowsAffected()
	if err != nil {
		return err
	}
	if num != 1 {
		return errors.New("affected 0 row")
	}
	return nil
}
