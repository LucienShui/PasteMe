/*
@File: data.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-18 14:40  Lucien     1.0         Init
*/
package data

import (
	"../util"
	"./permanent"
	"fmt"
	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/mysql"
	"time"
	"strconv"
)

const (
	username = "username"
	password = "password"
	network  = "tcp"
	server   = "lucien.local"
	port     = 3306
	database = "pasteme"
)

func format(
	username string,
	password string,
	network string,
	server string,
	port int,
	database string) string {
	return fmt.Sprintf("%s:%s@%s(%s:%d)/%s?parseTime=True&loc=Local", username, password, network, server, port, database)
}

type Paste struct {
	Key      string `json:"key"`
	Lang     string `json:"lang"`
	Content  string `json:"content"`
	Password string `json:"password"`
	CreateAt time.Time `json:"create_at"`
	DeleteAt time.Time `json:"delete_at"`
}

var db *gorm.DB

func init() {
	var err error
	db, err = gorm.Open("mysql", format(username, password, network, server, port, database))
	if err != nil {
		panic(err)
	}
	if !db.HasTable(&permanent.Permanent{}) {
		if err := db.Debug().Set("gorm:table_options", "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=200").CreateTable(&Permanent{}).Error; err != nil {
			panic(err)
		}
	}
}

func Insert(key string, lang string, content string, password string) (string, error) {
	var err error
	if key == "read_once" {
		// TODO
	} else if key == "" { // permanent
		if key, err = permanent.Insert(db, lang, content, password); err != nil {
			return "", err
		}
	} else { // temporary
		// TODO
	}
	return key, err
}

func Query(key string) (Paste, error) {
	table, err := util.ValidChecker(key)
	if err != nil {
		return Paste{}, err
	}
	if table == "permanent" {
		buf, err := strconv.ParseUint(key, 10, 64)
		if err != nil {
			return Paste{}, err
		}
		object, err := permanent.Query(db, buf)
		if err != nil {
			return Paste{}, err
		}
		return Paste{
			Key: string(object.Key),
		}, err
	} else { // temporary
		// TODO
	}
}
