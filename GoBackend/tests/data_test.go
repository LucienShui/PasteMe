/*
@File: data_test.go.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-18 14:51  Lucien     1.0         Init
*/
package tests

import (
	"../data"
	"encoding/json"
	"fmt"
	"testing"
)

var key string

func TestInsert(t *testing.T) {
	var err error
	key, err = data.Insert("", "Hello World!", "plain", "")
	if err != nil {
		t.Error(err)
	}
	t.Log(key)
}

func TestQuery(t *testing.T) {
	object, err := data.Query(key)
	if err != nil {
		t.Error(err)
	}
	content, err := json.Marshal(object)
	if err != nil {
		t.Error(err)
	}
	fmt.Println(string(content))
}
