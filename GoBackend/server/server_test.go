package server

import (
	"encoding/json"
	"github.com/LucienShui/PasteMe/GoBackend/server/request"
	"testing"
)

func TestGet(t *testing.T) {
	uri := "/?token=100&browser="
	body := request.Get(uri, router)
	type JsonResponse struct {
		Content string `json:"content"`
		Lang string `json:"lang"`
	}
	response := &JsonResponse{}
	if err := json.Unmarshal(body, response); err != nil {
		t.Fatal(err)
	}
	content, err := json.Marshal(response)
	if err != nil {
		t.Fatal(err)
	}
	t.Log(string(content))
}
