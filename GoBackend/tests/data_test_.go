/*
@File: data_test_.go.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-16 03:18  Lucien     1.0         Init
*/
package tests

import (
	"../data"
	"fmt"
	"testing"
)

func _TestInsert(t *testing.T) {
	err := data.Init()
	if err != nil {
		t.Error("Error when connect to mysql", err)
	}
	var TestCases = []struct {
		key string
		expected string
	}{
		{"", "1"},
		{"asd", "asd"},
		{"", "2"},
	}
	for i, TestCase := range TestCases {
		output, err := data.Set(TestCase.key, "", "", "", true)
		if output != TestCase.expected {
			t.Errorf("Test %d | input: %s, expected: %s, output: %s\n", i, TestCase.key, TestCase.expected, output)
		}
		if err != nil {
			fmt.Printf("[ %s ]\n", err)
		}
	}
}
