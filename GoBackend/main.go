/*
@File: main.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-06-11 01:27  Lucien     1.0         Init
2019-06-13 01:59  Lucien     1.1         Split function, add mysql.Init()
*/
package main

import (
	"github.com/LucienShui/PasteMe/GoBackend/data"
	"github.com/LucienShui/PasteMe/GoBackend/mysql"
	"github.com/LucienShui/PasteMe/GoBackend/util"
	"github.com/gin-gonic/gin"
)

func main() {
	mysql.Init()
	server := gin.Default()
	server.GET("", doGet)
	server.POST("", doPost)
	err := server.Run("0.0.0.0:8080")
	if err != nil {
		// TODO
	}
}

func doGet(requests *gin.Context) {
	token := requests.DefaultQuery("token", "")
	if token == "" { // empty request
		requests.JSON(501, gin.H {
			"message": "Wrong params",
		})
	} else {
		key, password := util.Parse(token)
		object := data.Get(key, password)
		// TODO
		if object { // key and password (if exist) is right
			browser := requests.DefaultQuery("browser", "")
			if browser == "" { // API request
				requests.JSON(200, gin.H {
					"key": key,
					"password": password,
					// TODO
				})
			} else { // Browser request
				requests.JSON(200, gin.H {
					// TODO
				})
			}
		} else { // key not found or password wrong
			// TODO
		}
	}
}

func doPost(requests *gin.Context) {
	// TODO
}
