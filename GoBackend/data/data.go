/*
@File: data.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-06-11 03:10  Lucien     1.0         Init
2019-06-13 02:08  Lucien     1.1         Add abstract func
*/
package data

import (
	"./mysql"
)

type Paste struct {
	key      string
	content  string
	lang     string
	password string
	visible  bool
}

func (paste *Paste) get(table string, key string, password string) error {
	var err error
	paste.content, paste.lang, paste.password, paste.visible, err = mysql.Query(table, key)
	return err
}

func Init() error {
	return mysql.Init()
}

func Get(key string, password string) (Paste, error) {
	// TODO
	return Paste{}, nil
}

func Set(key string, lang string, password string, content string) error {
	// TODO
	return nil
}

func erase(key string) error {
	return mysql.Erase(key)
}

func GetPermanent(key string, password string) (Paste, error) {
	paste := Paste{}
	err := paste.get("permanent", key, password)
	if err != nil {
		return Paste{}, err
	}
	return paste, err
}

func GetTemporary(key string, password string) (Paste, error) {
	paste := Paste{}
	err := paste.get("temporary", key, password)
	if err != nil {
		return Paste{}, err
	}
	err = erase(key)
	return paste, err
}

func SetPermanent(lang string, password string, content string) {
	// TODO
}

func SetTemporary(key string, lang string, password string, content string) {
	// TODO
}
