package util

import (
	"fmt"
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
		{"asdfqwerasdf", "temporary"},
		{"1000000000", ""},
	}
	for i, TestCase := range TestCases {
		output, err := ValidChecker(TestCase.input)
		fmt.Printf("Test %d | input: %s, expected: %s, output: %s\n", i, TestCase.input, TestCase.expected, output)
		if output != TestCase.expected {
			fmt.Printf("Test %d | input: %s, expected: %s, output: %s\n", i, TestCase.input, TestCase.expected, output)
		}
		if err != nil {
			fmt.Printf("[%s]\n", err)
		}
	}
}
