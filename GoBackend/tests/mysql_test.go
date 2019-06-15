/*
@File: mysql_test.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-13 15:21  Lucien     1.0         Init
2019-06-13 21:54  Lucien     1.1         Implement
*/
package tests

import (
	"../data/mysql"
	"testing"
)

func TestCreateTable(t *testing.T) {
	err := mysql.Init()
	if err != nil {
		t.Error("Error when connect to mysql", err)
	}
	err = mysql.Create()
	if err != nil {
		t.Error("Error when create table: ", err)
	}
}

