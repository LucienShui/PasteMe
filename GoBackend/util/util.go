/*
@File: util.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-06-11 02:07  Lucien     1.0         Init
*/
package util

import (
	"errors"
	"math/rand"
	"regexp"
	"strconv"
	"strings"
)

var table = "qwertyuiopasdfghjklzxcvbnm0123456789"

func Parse(token string) (string, string) {
	buf := strings.Split(token, ",")
	if len(buf) == 1 {
		return buf[0], ""
	} else {
		return buf[0], buf[1]
	}
}

func ValidChecker(key string) (string, error) {
	if len(key) > 8 || len(key) < 3 {
		return "", errors.New("key's length show greater or equal than 3 and less or equal than 8: " + key)
	}
	flag, err := regexp.MatchString("^[0-9a-z]{3,8}$", key)
	if err != nil {
		return "", err
	}
	if !flag {
		return "", errors.New("key's format checking failed, should only contains digital or lowercase letters: " + key)
	}
	flag, err = regexp.MatchString("[a-z]", key)
	if err != nil {
		return "", err
	}
	if !flag { // only digit
		if key[0] == '0' {
			return "", errors.New("permanent key should not have leading zero: " + key)
		}
		return "permanent", nil
	}
	return "temporary", nil
}

func generator() (string, error) {
	for i := 0; i < 8; i++ {
		rand.Int()
		// TODO
	}
	return "", nil
}

func Generator() (string, error) {
	// TODO
	return "", nil
}

func Uint2string(value uint64) string {
	return strconv.FormatUint(value, 10)
}

func String2uint(value string) uint64 {
	ret, err := strconv.ParseUint(value, 10, 64)
	if err != nil {
		// TODO
		return 0
	}
	return ret
}
