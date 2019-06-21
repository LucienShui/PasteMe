/*
@File: main.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-06-11 01:27  Lucien     1.0         Init
2019-06-13 01:59  Lucien     1.1         Split function, add mysql.Init()
2019-06-19 19:06  Irene      1.2         Fix package
*/
package main

import (
	"github.com/LucienShui/PasteMe/GoBackend/server"
)

func main() {
	server.Run()
}
