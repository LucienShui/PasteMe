package tests

import (
	"github.com/LucienShui/PasteMe/GoBackend/util"
	"testing"
)

func TestValidChecker(t *testing.T) {
	var TestCases = []struct {
		input string
		expected string
	}{
		{"01234567", ""},
		{"12345678", "permanent"},
		{"asdfqwer", "temporary"},
		{"0asdf123", "temporary"},
		{"0", ""},
		{"a", ""},
		{"asdf", "temporary"},
		{"asd", "temporary"},
		{"asdfqwerasdf", ""},
		{"1000000000", ""},
	}
	for i, TestCase := range TestCases {
		output, err := util.ValidChecker(TestCase.input)
		if output != TestCase.expected {
			t.Errorf("Test %d | input: %s, expected: %s, output: %s\n", i, TestCase.input, TestCase.expected, output)
		}
		if err != nil {
			t.Logf("[%s]\n", err)
		}
	}
}
