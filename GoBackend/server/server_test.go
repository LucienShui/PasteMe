/*
@File: server_test.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-21 08:37  Lucien     1.0         Init
*/
package server

import (
	"encoding/json"
	"github.com/LucienShui/PasteMe/GoBackend/server/request"
	"testing"
)

var key string

func TestPost(t *testing.T) {
	body := request.Set(
		t,
		router,
		"",
		"plain",
		"HelloWorld!",
		"")

	type JsonResponse struct {
		Key string `json:"key"`
	}

	response := JsonResponse{}
	if err := json.Unmarshal(body, &response); err != nil {
		t.Fatal(err)
	}

	key = response.Key

	content, err := json.Marshal(response)
	if err != nil {
		t.Fatal(err)
	}
	t.Log(string(content))
}

func TestGet(t *testing.T) {
	body := request.Get(t, router, key, "")

	type JsonResponse struct {
		Content string `json:"content"`
		Lang string `json:"lang"`
	}

	response := &JsonResponse{}
	if err := json.Unmarshal(body, &response); err != nil {
		t.Fatal(err)
	}

	content, err := json.Marshal(response)
	if err != nil {
		t.Fatal(err)
	}
	t.Log(string(content))
}
